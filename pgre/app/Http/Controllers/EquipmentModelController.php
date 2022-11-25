<?php

namespace App\Http\Controllers;

use App\Equipment_model;
use App\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\AssignOp\Mod;

class EquipmentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getModels(Request $request)
    {
        $brand_id = $request->brand_id;
        $models = Equipment_model::where('brand_id', $brand_id)
            ->select('id', 'name')
            ->get();

        return response()->json($models);
    }


    public function download_template()
    {
        return response()->download(storage_path('app\public\templates\import_models_template.xlsx'));
    }

    public static function create_model($brand, $model)
    {
//        if(trim($brand) == "" || trim($model) == "")
//            return 1;
        $brand_id = Brand::where('name', $brand)->pluck('id')->first();
        if($brand_id == null){ //criar marca
            $new_brand = new Brand();
            $new_brand->name = $brand;
            $new_brand->save();
            $brand_id = $new_brand->id;
        }
        //validar modelo
        $check_model = Equipment_model::where('name', $model)->where('brand_id',$brand_id)->first();
        if($check_model != null)
            return $check_model->id; //repetido, ignora e responde com o registo ja existente.

        $new_model = new Equipment_model();
        $new_model->brand_id = $brand_id;
        $new_model->name = $model;
        $new_model->save();
        return $new_model->id;
    }

    public function excel_import(Request $request)
    {
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
                if(strtoupper($line[0]) != "MARCA")
                    return redirect('equip-management/models')
                        ->with('error', $line[0] . ' inválido para cabeçalho da primeira coluna');

                if(strtoupper($line[1]) != "MODELO")
                    return redirect('equip-management/models')
                        ->with('error', $line[1] . ' inválido para cabeçalho da segunda coluna');
            }else{
                try{
                    $this->create_model($line[0], $line[1]);
                }catch (QueryException $ex){
                    return redirect('equip-management/models')
                        ->with('error', $line[1] . 'Linha ' .$key . ' - Erro ao criar marcas e modelo');
                }

            }
        }
        return redirect('equip-management/models')->with('success','Ficheiro excel importado com  sucesso!');
    }




    public function index()
    {
        $equipment_models = Equipment_model::all();
        $brands = Brand::all();
        return view ('equip.models.list', ['equipment_models' => $equipment_models, 'brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'model_name' => 'required',
            'brand' => 'required'
        ]);




        if ($validator->fails()) {
            return redirect('equip-management/models')
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $check = Equipment_model::where('brand_id',$request->brand)->where('name',$request->model_name)->count();
        if($check == 0){
            $equipment_models = new Equipment_model();
            $equipment_models->name         = $request->model_name;
            $equipment_models->brand_id     = $request->brand;
            $equipment_models->save();

            return redirect('equip-management/models')->with('success','Modelo criado com sucesso!');
        }else{
            return redirect('equip-management/models')->with('error','Modelo já existe!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment_model  $equipment_model
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment_model $equipment_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment_model  $equipment_model
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment_model $equipment_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment_model  $equipment_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment_model $equipment_model)
    {
        $this->validate($request, [
            'model_name' => 'required',

        ]);
//        dd($model);
        $check = Equipment_model::where('brand_id',$request->brand)->where('name',$request->model_name)->count();
        if($check == 0){
            $equipment_model = Equipment_model::find($equipment_model->id);
            $equipment_model->name          = $request->model_name;
            $equipment_model->brand_id      = $request->brand;
            $equipment_model->save();
//        dd($equipment_model);
            return redirect('equip-management/models')->with('success','Modelo editado com sucesso!');
        }else{
            return redirect('equip-management/models')->with('error','Modelo já existe!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment_model  $equipment_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment_model $equipment_model)
    {
        if(count($equipment_model->equipments) == 0){
            $equipment_model->delete();
            return redirect('equip-management/models')->with('success','Modelo eliminado com sucesso!');
        }else{
            return redirect('equip-management/models')->with('error','Modelo não pode ser eliminado pois está associado a um ou mais equipamentos!');
        }

    }
}
