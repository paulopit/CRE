<?php

namespace App\Http\Controllers;

use App\User;
use App\Requisition;
use App\User_function;
use App\User_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        //$check = Requisition::where('request_user_id', '=', $user->id)
          //  ->where('level_id', '!=', 7)
            //->where('level_id', '!=', null)
            //->get();




            $user_info = User::find($user->id);
            $user_info->name = $request->user_name;
            $user_info->birth_date = $request->user_birth_date ?? carbon::createFromDate(1900, 1, 1);
            $user_info->phone = $request->user_phone;
            $user_info->user_function_id = $request->user_function;
            if(isset( $request->user_type))
                $user_info->user_type_id = $request->user_type;

            if($user->id != 1){
                $user_info->is_active = (boolean)json_decode(strtolower($request['user_active_' . $user->id])) ?? 0;
                if(!$user_info->is_active){
                    $check = Requisition::join('requisition_levels', 'requisitions.level_id', '=', 'requisition_levels.id')
                        ->where('requisitions.request_user_id', '=', $user->id)
                        ->where('requisition_levels.close_type', '=', 0)
                        ->count();
                    if($check > 0){
                        return redirect('user-management/users')->with('error','Conta de utilizador com requisições em aberto!');
                    }else{
                        $user_info->save();
                        return redirect('user-management/users')->with('success','Conta de utilizador atualizada com sucesso!');
                    }
                }
            }
                $user_info->save();
            return redirect('user-management/users')->with('success','Conta de utilizador atualizada com sucesso!');
    }
}
