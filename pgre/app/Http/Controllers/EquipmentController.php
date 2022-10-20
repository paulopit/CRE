<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Equipment;
use App\Equipment_model;
use App\Equipment_type;
use App\Requisition_line;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        //Obter todos os equipamentos do tipo de equipamento pedido, mas que se encontrem em stock,
        $equip_data['data'] = Equipment::orderby("equipment.reference","asc")
            ->select('equipment.id','equipment.reference','equipment.description')
            ->where('equipment.equipment_type_id',$type_id)
            ->where('equipment.in_stock', 1)
            ->get();
        return response()->json($equip_data);
    }

    public function getEquipmentsByRef($ref=""){
        $equip_data['data'] = Equipment::orderby("equipment.reference","asc")
            ->select('equipment.id','equipment.reference','equipment.description')
            ->where('equipment.reference','=',$ref)
            ->where('equipment.in_stock', 1)
            ->get();
        return response()->json($equip_data);
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
        $this->validate($request, [
            'description' => 'required',
            'equipment_type' => 'required',
            'models_select' => 'required',
            ]);

        $equipment = new Equipment();
        $equipment->description = $request->description;
        $equipment->equipment_type_id = $request->equipment_type;
        $equipment->equipment_model_id = $request->models_select;
        $equipment->serial_number = $request->serial_number;
        $equipment->obs = $request->obs;
        $equipment->reference = $request->reference ?? $this->GenerateReference();
        $equipment->save();

        return redirect('/equip-management/equipments')->with('success','Equipamento criada com sucesso!');

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

        return redirect('requisitions/new')->with('success','Equipamento removido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        $this->validate($request, [
            'description' => 'required',
            'reference' => 'required',
            'description' => 'required',
            'equipment_type_id' => 'required',
            'equipment_model_id' => 'required'
        ]);

        $equipment= new Equipment();
        $equipment->description = $request->description;
        $equipment->serial_number = $request->serial_number;
        $equipment->equipment_type_id = $request->equipment_type_id;
        $equipment->equipment_model_id = $request->equipment_model_id;
        $equipment->reference = $request->reference;
        $equipment->obs = $request->obs;
        $equipment->save();

        return redirect('equip-management/equipments')->with('success','Equipamento criado com sucesso!');
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
        //
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
