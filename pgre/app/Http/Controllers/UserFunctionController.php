<?php

namespace App\Http\Controllers;

use App\User_function;
use Cassandra\Type\UserType;
use Illuminate\Http\Request;

class UserFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_functions = User_function::all();
        return view('user.functions.list', ['user_functions' => $user_functions]);
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
            'function_name' => 'required'
        ]);
        $user_function = new User_function();
        $user_function->function_name = $request->function_name;
        $user_function->save();
        return redirect('user-management/functions')->with('success','Função criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_function  $user_function
     * @return \Illuminate\Http\Response
     */
    public function show(User_function $user_function)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_function  $user_function
     * @return \Illuminate\Http\Response
     */
    public function edit(User_function $user_function)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_function  $user_function
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_function $user_function)
    {
        $this->validate($request, [
            'function_name' => 'required'
        ]);
        $user_function = User_function::find($user_function->id);
        $user_function->function_name = $request->function_name;
        $user_function->save();
        return redirect('user-management/functions')->with('success','Função editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_function  $user_function
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_function $user_function)
    {
        $user_function = User_function::find($user_function->id);
        if(count($user_function->users) > 0){
            return redirect('user-management/functions')->with('error','Este registo está associado a um ou mais utilizadores, não é possivel apagar!');
        }
        $user_function->delete();
        return redirect('user-management/functions')->with('success','Função eliminada com sucesso!');
    }
}
