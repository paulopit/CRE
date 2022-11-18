<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Equipment;
use App\Equipment_model;
use App\Equipment_type;
use App\Requisition_line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function ValidateSerialNumber($serialnumber, $equip_id = 0 )
    {
       $checkserial = Equipment::where('serial_number', $serialnumber)
           ->where('id', '!=', $equip_id)
           ->get();
       if(count($checkserial) > 0)
           return false;
       return true;
    }

    private function GenerateReference($length = 15)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getEquipmentsByType($type_id=0){

        $equip_data['data'] = [];
            $reference_list =Equipment::where("equipment_type_id",$type_id)
            ->where('equipment.in_stock', 1)
            ->groupBy('reference')
            ->pluck('reference');
            foreach ($reference_list as $ref){
                $record = Equipment::where('reference', $ref)
                    ->where('equipment.in_stock', 1)
                    ->get(['id','reference','description'])
                    ->first();
                $record['total'] = Equipment::where('reference', $ref)->where('equipment.in_stock', 1)->count();
                array_push($equip_data['data'],$record);
            }
        return response()->json($equip_data);
    }

    public function getEquipmentsByRef($ref=""){
        $equip_data['data'] = [];
            $record = Equipment::where('reference', $ref)
                ->where('equipment.in_stock', 1)
                ->get(['id','reference','description'])
                ->first();
            $record['total'] = Equipment::where('reference', $ref)->where('equipment.in_stock', 1)->count();
            array_push($equip_data['data'],$record);
        return response()->json($equip_data);
    }

    public function download_template()
    {
        return response()->download(storage_path('app\public\templates\import_equipments_template.xlsx'));
    }

    public function excel_import(Request $request)
    {
        $error_log = [];

        $validator = Validator::make($request->all(), [
            'import_file' => ['required','mimes:xls,xlsx','max:4096'],
        ]);

        if ($validator->fails()) {
            return redirect('equip-management/models')
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $excel_data = Excel::toArray([], $request->file('import_file'));
        foreach ($excel_data[0] as $key=>$line){
            if($key == 0){ //valida cabeçalho
                if(strtoupper($line[0]) != "REFERENCIA")
                    return redirect('equip-management/equipments')->with('error', $line[0] . ' inválido para cabeçalho da primeira coluna');
                if(strtoupper($line[1]) != "DESCRICAO")
                    return redirect('equip-management/equipments')->with('error', $line[1] . ' inválido para cabeçalho da segunda coluna');
                if(strtoupper($line[2]) != "NUMERO SERIE")
                    return redirect('equip-management/equipments')->with('error', $line[2] . ' inválido para cabeçalho da terceira coluna');
                if(strtoupper($line[3]) != "TIPO EQUIPAMENTO")
                    return redirect('equip-management/equipments')->with('error', $line[3] . ' inválido para cabeçalho da quarta coluna');
                if(strtoupper($line[4]) != "MARCA")
                    return redirect('equip-management/equipments')->with('error', $line[4] . ' inválido para cabeçalho da quinta coluna');
                if(strtoupper($line[5]) != "MODELO")
                    return redirect('equip-management/equipments')->with('error', $line[5] . ' inválido para cabeçalho da sexta coluna');
                if(strtoupper($line[6]) != "URL IMAGEM")
                    return redirect('equip-management/equipments')->with('error', $line[6] . ' inválido para cabeçalho da sétima coluna');
                if(strtoupper($line[7]) != "OBSERVACOES")
                    return redirect('equip-management/equipments')->with('error', $line[7] . ' inválido para cabeçalho da oitava coluna');
            }else{
                $new_equip = new Equipment();
                if($line[0] == ""){
                    $new_equip->reference = $this->GenerateReference();
                }else{
                    $new_equip->reference = $line[0];
                }
                $model_id = (new EquipmentModelController)->create_model($line[4], $line[5]);
                $equip_type_id = (new EquipmentTypeController)->create_type($line[3]);

                $new_equip->description = $line[1];

                if($line[2] != ""){
                    if($this->ValidateSerialNumber($line[2])){
                        $new_equip->serial_number = $line[2];

                    }else{
                        array_push($error_log,'Linha ' . $key . ' - numero de série já pertence a outro equipamento.');
                        continue;
                    }
                }

                $new_equip->status_ok = true;
                $new_equip->in_stock = true;
                $new_equip->equipment_model_id = $model_id;
                $new_equip->equipment_type_id = $equip_type_id;
                $new_equip->obs = $line[7];

                if($line[6] != ""){
                    $context = stream_context_create(array(
                        'http' => array('ignore_errors' => true),
                    ));
                    $contents = @file_get_contents($line[6], false,$context);
                    $name = substr($line[6], strrpos($line[6], '/') + 1);
                    $location = 'images/equipment/' .$name;
                    Storage::put('public/'.$location, $contents);
                    $new_equip->image_url = $location;
                }
                $new_equip->save();
            }
        }
        if(count($error_log) == 0){
            return redirect('equip-management/equipments')->with('success','Ficheiro excel importado com  sucesso!');
        }else{
            return redirect('equip-management/equipments')
                ->with('errorImport', $error_log);
        }
    }



    public function getEquipData(Request $request)
    {
        $record = Equipment::with('equipment_model')->where('reference',$request->reference)->first();
        //dd($record);
        return response()->json($record);
    }



    public function index()
    {
        $equipments = Equipment::all();
        $brands = Brand::all();
        $equipment_types = Equipment_type::all();
        $equipment_models = Equipment_model::all();
        return view('equip.management.list', ['equipments' => $equipments, 'equipment_types' => $equipment_types, 'equipment_models' => $equipment_models, 'brands' => $brands]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'equipment_type' => 'required',
            'models_select' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('equip-management/equipments')
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        //vamos validar se já existem registos desta ref.
        $validate_ref = Equipment::where('reference',$request->reference)->first();
        if($validate_ref != null){ //quer dizer que existe pelo menos 1 registo com esta ref.
            //vamos validar se os campos estão iguais
            if($validate_ref->description != $request->description)
                return redirect('equip-management/equipments')->with('error','Refência já existente, com descrição diferente!')->withInput();
            if($validate_ref->equipment_type_id != $request->equipment_type)
                return redirect('equip-management/equipments')->with('error','Refência já existente, com o tipo de equipamento diferente!')->withInput();
            if($validate_ref->equipment_model_id != $request->models_select)
                return redirect('equip-management/equipments')->with('error','Refência já existente, com o modelo de equipamento diferente!')->withInput();
        }

        $equipment = new Equipment();
        if ($request->file('equip_image')) {
            // Get Image File
            $imagePath = $request->file('equip_image');
            // Define Image Name
            $imageName = $request->reference . '' . time() . '' . $imagePath->getClientOriginalName();
            // Save Image on Storage
            $path = $request->file('equip_image')->storeAs('images/equipment' , $imageName, 'public');
            //Save Image Path
            $equipment->image_url = $path;
        }
        $equipment->description = $request->description;
        $equipment->equipment_type_id = $request->equipment_type;
        $equipment->equipment_model_id = $request->models_select;
        if($request->serial_number != ""){
            if(!$this->ValidateSerialNumber($request->serial_number)){
                return redirect('equip-management/equipments')->with('error','Número de Série já existe');
            }else{
                $equipment->serial_number = $request->serial_number;
            }
        }
        $equipment->obs = $request->obs;
        $equipment->reference = $request->reference ?? $this->GenerateReference();
        $equipment->save();
        return redirect('/equip-management/equipments')->with('success','Equipamento criado com sucesso!');
    }


    public function add(Request $request){

        $new_line = new Requisition_line();
        $new_line->requisition_id = $request->req_id;
        $new_line->equipment_id = $request->equip_id;
        $new_line->save();

        //tira equipamento de stock
        $equip = Equipment::find($request->equip_id);
        $equip->in_stock = false;
        $equip->save();
        AlertController::check_low_stock($equip->reference);
        return response()->json('sucesso');
    }

    public function remove(Requisition_line $line){

        //delete requisition line
        $record = Requisition_line::find($line->id);
        $record->delete();

        //update equip stock
        $equip_id = $line->equipment_id;
        $equip_rec = Equipment::find($equip_id);
        $equip_rec->in_stock = 1;
        $equip_rec->save();

        return back()->with('success','Equipamento removido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $this->validate($request, [
            'equip_description' => 'required'
        ]);
        //validar serials repetidos ou referencias
        $equipment = Equipment::find($equipment->id);

        //vamos validar que a referencia nao foi alterada.
        if($request->equip_reference != $equipment->reference)
            return redirect('equip-management/equipments')->with('error','Desculpe, mas não pode editar a referência');


        if ($request->file('equip_image')) {

            Storage::delete('public/'.$equipment->image_url);
            // Get Image File
            $imagePath = $request->file('equip_image');
            // Define Image Name
            $imageName = $request->reference . '' . time() . '' . $imagePath->getClientOriginalName();
            // Save Image on Storage
            $path = $request->file('equip_image')->storeAs('images/equipment' , $imageName, 'public');
            //Save Image Path
            $equipment->image_url = $path;
        }

        $equipment->description = $request->equip_description;
        if($request->equip_serialnumber != ""){
            if(!$this->ValidateSerialNumber($request->equip_serialnumber, $equipment->id)){
                return redirect('equip-management/equipments')->with('error','Número de Série já existe');
            }else{
                $equipment->serial_number = $request->equip_serialnumber;
            }
        }

        $equipment->status_ok = boolval($request['equip_status_ok_'.$equipment->id]);
        $equipment->equipment_type_id = $request->equip_type;
        $equipment->equipment_model_id = $request->equip_model;
        $equipment->reference = $request->equip_reference;
        $equipment->obs = $request->equip_obs;
        $equipment->is_active = boolval($request['equip_is_active'.$equipment->id]);
        $equipment->save();

        //Atualizar os restantes equipamentos da mesma ref com os dados atualizados.
        $Ref_equips = Equipment::where('reference', $equipment->reference)->get();
        foreach ($Ref_equips as $equip) {
            $equip->description = $equipment->description;
            $equip->equipment_type_id = $equipment->equipment_type_id;
            $equip->equipment_model_id = $equipment->equipment_model_id;
            $equip->save();
        }

        return redirect('equip-management/equipments')->with('success','Equipamento editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }

}
