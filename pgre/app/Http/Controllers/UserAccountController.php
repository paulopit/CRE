<?php

namespace App\Http\Controllers;

use App\User;
use App\User_function;
use App\User_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    public function index()
    {
        $users = User::all();
        $user_functions = User_function::all();
        $user_types = User_type::all();
        return view('user.management.users-table', ['users' => $users, 'user_functions' => $user_functions, 'user_types' => $user_types]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'user_name' => 'required'
        ]);

        $user_info = User::find($user->id);
        $user_info->name = $request->user_name;
        $user_info->birth_date = $request->user_birth_date ?? carbon::createFromDate(1900, 1, 1);
        $user_info->phone = $request->user_phone;
        $user_info->user_function_id = $request->user_function;
        if(isset( $request->user_type))
            $user_info->user_type_id = $request->user_type;
        $user_info->is_active = (boolean)json_decode(strtolower($request['user_active_' . $user->id])) ?? 1;

        $user_info->save();
        return redirect('user-management/users')->with('success','Conta de utilizador atualizada com sucesso!');
    }
}
