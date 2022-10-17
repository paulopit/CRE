<?php

namespace App\Http\Controllers;

use App\Requisition;
use App\User_function;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function GenerateRequisition($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function GetTempRequisition(){
        //Valida se já existe alguma requisição em estado 1 (Temporário) para este user.
        $TempReq = Requisition::where('status_id','=', 1)
            ->where('request_user_id', '=' , Auth::user()->id)
            ->first();
        return $TempReq;
    }

    private function Remove_outdated_temp_requisitions(){

        $expDate = Carbon::now()->subHours(1); //requisicões com mais de 1h
        $outdated = Requisition::where('status_id','=', 1)
            ->where('created_date', '<' , $expDate)
            ->get();

        //mudar para estado cancelado
        return true;
    }


    public function new()
    {
        $TempReq = $this->GetTempRequisition();

        if(empty($TempReq)){
            //vamos criar um registo temporario novo.

            $new_req = new Requisition();
            $new_req->Tag = $this->GenerateRequisition();
            $new_req->request_user_id = Auth::user()->id;
            $new_req->status_id =1;
            $new_req->save();

            $TempReq = $new_req;
        }//senão, já existe um registo temporário, vamos retornar os dados desse registo.



        $user_req = Auth::user();
        $user_func = User_function::all();
        return view('requisition.new',['$temp_req' => $TempReq, 'user_req' => $user_req, 'user_func' => $user_func]);
    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }

}
