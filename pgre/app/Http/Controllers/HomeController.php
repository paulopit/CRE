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

        $expire_requisition = Requisition::where('end_date',  '<', Carbon::now()->addDays(2))
                            ->where('end_date', '>', Carbon::now())
                            ->where('request_user_id', $user->id)
                            ->get();


        $all_requisitions = Requisition::all();

        $requisition = Requisition::all();



        return view('dashboard', ['requisitions' => $all_requisitions, 'expire_requisition' => $expire_requisition, 'requisition' => $requisition]);
    }








}
