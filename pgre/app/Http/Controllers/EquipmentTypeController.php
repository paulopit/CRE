<?php

namespace App\Http\Controllers;

use App\Equipment_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_type($type_name) //usado para importação via excel
    {
        if(trim($type_name) == "")
            return 1;
        $check_type = Equipment_type::where('type', $type_name)->pluck('id')->first();
        if($check_type == null){
            $new_type = new Equipment_type();
            $new_type->type = $type_name;
            $new_type->save();
            return $new_type->id;
        }else{
            return $check_type;
        }
    }


    public function index()
    {
        $equipment_types = Equipment_type::all();
        return view('equip.types.list', ['equipment_types' => $equipment_types]);
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
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('equip-management/types')
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        //Valida se já existe um tipo igual
        $validate_rec = Equipment_type::where('type', $request->type)->first();
        if(isset($validate_rec))
            return redirect('/equip-management/types')->with('error','Já existe um registo com o tipo ' . $request->type .'!');

        $equipment_type = new Equipment_type();
        $equipment_type->type = $request->type;
        $equipment_type->save();

        return redirect('/equip-management/types')->with('success','Tipo de Equipamento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment_type $equipment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment_type $equipment_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment_type $type)
    {
        $this->validate($request, [
            'type_name' => 'required',
        ]);
//        dd($type);

        //Valida se já existe um tipo igual
        $validate_rec = Equipment_type::where('type', $request->type_name)->first();
        if(isset($validate_rec))
            return redirect('/equip-management/types')->with('error','Já existe um registo com o tipo ' . $request->type_name .'!');

        $equipment_type = Equipment_type::find($type->id);
        $equipment_type->type          = $request->type_name;
        $equipment_type->save();
//        dd($equipment_type);
        return redirect('equip-management/types')->with('success','Tipo de equipamento editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment_type  $equipment_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment_type $type)
    {
        $equip_type = Equipment_type::find($type->id);
        if(count($equip_type->equipments) > 0){
            return redirect('equip-management/types')->with('error','Este registo está associado a um ou mais equipamentos, não é possivel apagar!');
        }
        $equip_type->delete();
        return redirect('equip-management/types')->with('success','Tipo de equipamento eliminado com sucesso!');
    }
}
