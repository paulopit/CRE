<?php

namespace App\Http\Controllers;

use App\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SweetAlert;

class SearchController extends Controller
{
    public function showNavbarSearchResults(Request $request)
    {
        $user_info = Auth::user();
        if (! $request->filled('searchVal')) {
            return back();
        }
        $keyword = $request->input('searchVal');
        $requisition = Requisition::where('tag',$keyword)->first();
        if($requisition != null){
            if($user_info->isManager())
                return redirect('/requisition-management/details/' .$requisition->id);
            else if($user_info->id == $requisition->request_user_id)
                return redirect('/requisitions/details/' .$requisition->id);
            else return redirect('/dashboard')->with('error','Nenhum resultado encontrado!');
        }else{
            return redirect('/dashboard')->with('error','Nenhum resultado encontrado!');
        }
    }
}
