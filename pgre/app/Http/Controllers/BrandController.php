<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('equip.brands.list', ['brands' => $brands]);
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
            'brand_name' => 'required'
        ]);

        $brand = new Brand();
        $brand->name = $request->brand_name;
        $brand->save();

        return redirect('equip-management/brands')->with('success','Marca criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'brand_name' => 'required'
        ]);

        $brand = Brand::find($brand->id);
        $brand->name = $request->brand_name;
        $brand->save();
        return redirect('equip-management/brands')->with('success','Marca editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        // ddd(count($brand->equipment_models));
        // ddd('teste');
        if(count($brand->equipment_models) == 0){
            $brand->delete();
            return redirect('equip-management/brands')->with('success','Marca eliminada com sucesso!');
        }else{
            return redirect('equip-management/brands')->with('error','Marca não pode ser eliminada pois contem modelos associados!');
        }


    }
}
