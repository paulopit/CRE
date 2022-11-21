<?php

namespace App\Http\Controllers;

use App\User_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_types = User_type::all();
        return view('user.types.list', ['user_types' => $user_types]);
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
            'type_name' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect('user-management/types')
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $check = User_type::where('type_name',$request->type_name)->count();
        if($check == 0) {
            $user_type = new User_type();
            $user_type->type_name = $request->type_name;
            $user_type->save();
            return redirect('user-management/types')->with('success', 'Tipo de utilizador criado com sucesso!');
        }else{
            return redirect('user-management/types')->with('error', 'Tipo de utilizador já existe!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_type  $user_type
     * @return \Illuminate\Http\Response
     */
    public function show(User_type $user_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_type  $user_type
     * @return \Illuminate\Http\Response
     */
    public function edit(User_type $user_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_type  $user_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_type $user_type)
    {
        $this->validate($request, [
            'type_name' => 'required'
        ]);
        $check = User_type::where('type_name',$request->type_name)
            ->where('id','!=',$user_type->id)
            ->count();
        if($check == 0) {
            $user_type = User_type::find($user_type->id);
            $user_type->type_name = $request->type_name;
            $user_type->save();
            return redirect('user-management/types')->with('success', 'Tipo de utilizador editado com sucesso!');
        }else{
            return redirect('user-management/types')->with('error', 'Tipo de utilizador já existe!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_type  $user_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_type $user_type)
    {
        if($user_type->id < 4){
            return redirect('user-management/types')->with('error','Este registo é nativo da aplicação, não pode ser apagado!');
        }else{
            $user_type = User_type::find($user_type->id);
            if(count($user_type->users) > 0)
                return redirect('user-management/types')->with('error','Este registo está associado a um ou mais utilizadores, não é possivel apagar!');
            $user_type->delete();
            return redirect('user-management/types')->with('success','Função eliminada com sucesso!');
        }
    }
}
