<?php

namespace App\Http\Controllers;

use App\Equipment_model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function index()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment_model  $equipment_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment_model $equipment_model)
    {
        //
    }
}
