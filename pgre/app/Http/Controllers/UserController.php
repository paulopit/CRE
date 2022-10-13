<?php

namespace App\Http\Controllers;

use App\User;
use App\User_function;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $userinfo = User::find(Auth::user()->id);
        $user_functions = User_function::all();
        return view('user.my-account', ['userinfo' => $userinfo, 'user_functions' =>$user_functions]);
    }

    public function show(User $user)
    {

        return view('user.my-account');
    }
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'user_name' => 'required'
        ]);

        $user_info = User::find($user->id);
        $user_info->name = $request->user_name;
        $user_info->birth_date = $request->user_birth_date;
        $user_info->user_function_id = $request->user_function;

        if(isset($request->user_password) && isset($request->user_password2)){
            if($request->user_password == $request->user_password2){
                $user_info->password = Hash::make($request->user_password);
            }else{
                return redirect('user/settings')->with('error','Erro ao alterar password: As passwords não coincidem');
            }
        }
        $user_info->save();
        return redirect('user/settings')->with('success','Dados pessoais alterados com sucesso!');
    }
}
