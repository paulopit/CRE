<?php

namespace App\Http\Controllers;

use App\Equipment_model;
use App\Brand;
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
        $this->validate($request, [
            'model_name' => 'required',

        ]);

        $equipment_models = new Equipment_model();
        $equipment_models->name         = $request->model_name;
        $equipment_models->brand_id     = $request->model_brand;
        $equipment_models->save();

        return redirect('equip-management/models')->with('success','Modelo criada com sucesso!');
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
    public function update(Request $request, Equipment_model $model)
    {
        $this->validate($request, [
            'model_name' => 'required',

        ]);
//        dd($model);
        $equipment_model = Equipment_model::find($model->id);
        $equipment_model->name          = $request->model_name;
        $equipment_model->brand_id      = $request->model_brand;

        $equipment_model->save();
//        dd($equipment_model);
        return redirect('equip-management/models')->with('success','Marca editada com sucesso!');
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
