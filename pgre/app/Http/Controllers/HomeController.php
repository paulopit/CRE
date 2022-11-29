<?php

namespace App\Http\Controllers;

use App\Requisition;
use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        $user = Auth::user();

        //Requisições que expiram em menos de 2 dias
        $expiring_requisition = Requisition::join('requisition_levels', 'requisition_levels.id', '=', 'requisitions.level_id')
            ->where('end_date',  '<', Carbon::now()->addDays(2))
            ->where('end_date', '>', Carbon::now())
            ->where('request_user_id', $user->id)
            ->where('requisition_levels.close_type', '!=' ,'1')
            ->get();


        //Requisições que já expiraram
        $expired_requisition = Requisition::join('requisition_levels', 'requisition_levels.id', '=', 'requisitions.level_id')
                            ->where('end_date',  '<', Carbon::now())
                            ->where('request_user_id', $user->id)
                            ->where('requisition_levels.close_type', '!=' ,'1')
                            ->get();


        $all_requisitions = Requisition::all();

        $requisition = Requisition::all();



        $notification_text = "";


        if(count($expiring_requisition) > 0){
            $notification_text .= "<h5> Requisições a expirar!</h5>";
            foreach ($expiring_requisition as $expiring){
                $notification_text .= "<p> ". $expiring->tag . "</p>";
            }
        }

        if(count($expired_requisition) > 0){
            $notification_text .= "<h5> Requisições expiradas!</h5>";
            foreach ($expired_requisition as $expired){
                $notification_text .= "<p>". $expired->tag . "</p>";
            }
        }



        return view('dashboard', ['notification_text' => $notification_text, 'requisitions' => $all_requisitions, 'expiring_requisition' => $expiring_requisition, 'expired_requisition' => $expired_requisition, 'requisition' => $requisition]);
    }








}
