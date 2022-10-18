<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Requisition_line;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

        //
        //return redirect('user-management/types')->with('success','Tipo de utilizador criado com sucesso!');
    }

    public function add($req_id=0, $equip_id=0){

        $new_line = new Requisition_line();
        $new_line->requisition_id = $req_id;
        $new_line->equipment_id = $equip_id;
        $new_line->save();

        //tira equipamento de stock
        $equip = Equipment::find($equip_id);
        $equip->in_stock = false;
        $equip->save();
        return response()->json('sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
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
