<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Equipment_type;
use App\Requisition;
use App\Requisition_line;
use App\User;
use App\User_function;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    private function GetTempAdminRequisition(){
        //Valida se já existe alguma requisição em estado 1 (Temporário) criada por este user.
        $TempReq = Requisition::where('level_id', 1)
            ->where('created_by', Auth::user()->id)
            ->first();
        return $TempReq;
    }

    private function GetTempRequisition(){
        //Valida se já existe alguma requisição em estado 1 (Temporário) para este user.
        $TempReq = Requisition::where('level_id','=', 1)
            ->where('request_user_id', '=' , Auth::user()->id)
            ->first();
        return $TempReq;
    }

    private function CancelRequisition($requisition, $expired = false){
        //validar se tem equipamentos associados para remover das linhas e atualizar o stock.
        foreach ($requisition->lines as $line){
            //atualizar stock do equipamento
            $equip_rec = Equipment::find($line->equipment_id);
            $equip_rec->in_stock = 1;
            $equip_rec->save();
            //remover linha
            //$line->delete();
        }
        if($expired){
            $requisition->level_id =5; //mudar para estado expirado
        }else{
            $requisition->level_id =6; //mudar para estado cancelado
        }
        $requisition->save();
    }


    private function Check_outdated_requisitions(){

        $expDate = Carbon::now()->subMinutes(30); //requisicões com mais de 30min
        $outdated = Requisition::where('level_id','=', 1)
            ->where('updated_at', '<' , $expDate)
            ->get();

        foreach($outdated as $req){
            $this->CancelRequisition($req, true);
        }
    }

    public function new()
    {
        $this->Check_outdated_requisitions();
        $TempReq = $this->GetTempRequisition();

        if(empty($TempReq)){
            //vamos criar um registo temporario novo.
            $new_req = new Requisition();
            $new_req->tag = $this->GenerateRequisition();
            $new_req->request_user_id = Auth::user()->id;
            $new_req->created_by = Auth::user()->id;
            $new_req->level_id =1;
            $new_req->save();

            $TempReq = $new_req;
        }else{//senão, já existe um registo temporário, vamos atualizar a data de update.
            $TempReq->updated_at = now();
            $TempReq->save();
        }


        $user_req = Auth::user();
        $user_func = User_function::all();
        //listar apenas tipos de equipamentos que estão a ser utilizados.
        $equip_types = Equipment_type::select('equipment_types.id', 'equipment_types.type')
                                        ->join('equipment','equipment.equipment_type_id', '=', 'equipment_types.id')
                                        ->where('equipment.in_stock', 1)
                                        ->groupBy('equipment_types.type','equipment_types.id')
                                        ->get();


        return view('requisition.new.details',['temp_req' => $TempReq, 'user_req' => $user_req, 'user_func' => $user_func,'equip_types' => $equip_types]);
    }

    public function manage_new()
    {
        $this->Check_outdated_requisitions();
        $TempReq = $this->GetTempAdminRequisition();




        if(empty($TempReq)){
            //vamos criar um registo temporario novo.
            $new_req = new Requisition();
            $new_req->tag = $this->GenerateRequisition();
            $new_req->created_by = Auth::user()->id;
            $new_req->level_id =1;
            $new_req->save();

            $TempReq = $new_req;
        }else{//senão, já existe um registo temporário, vamos atualizar a data de update.
            $TempReq->updated_at = now();
            $TempReq->save();
        }
        $user_req = Auth::user();
        $user_func = User_function::all();
        $user_list = User::where('user_type_id', 3)
                            ->where('is_active', 1)
                            ->get();
        $assigned_usr = User::find($TempReq->request_user_id);


        //listar apenas tipos de equipamentos que estão a ser utilizados.
        $equip_types = Equipment_type::select('equipment_types.id', 'equipment_types.type')
            ->join('equipment','equipment.equipment_type_id', '=', 'equipment_types.id')
            ->where('equipment.in_stock', 1)
            ->groupBy('equipment_types.type','equipment_types.id')
            ->get();

        return view('requisition.management.new.new',['assigned_usr'=> $assigned_usr, 'temp_req' => $TempReq, 'user_req' => $user_req, 'user_list' => $user_list,'equip_types' => $equip_types]);
    }


    public function getUserInfo(Request $request)
    {
        $user_id = $request->user_id;
        $user_info = User::Join('user_functions','user_functions.id', '=', 'users.user_function_id')
                            ->select('user_functions.function_name', 'users.phone', 'users.email')
                            ->where('users.id',$user_id)
                            ->get();
        return response()->json(['user_info' => $user_info]);
    }


    public function updateFields(Request $request)
    {
        $requisition = Requisition::find($request->req_id);
        $requisition->course = $request->req_course;
        $requisition->class = $request->req_class;
        $requisition->ufcd = $request->req_ufcd;
        $requisition->teacher = $request->req_teacher;
        $requisition->obs = $request->req_obs;
        $requisition->save();

        return response()->json(['success'=>'Fields updated successfully!']);
    }

    public function manage_updateFields(Request $request)
    {
        $requisition = Requisition::find($request->req_id);
        $requisition->course = $request->req_course;
        $requisition->request_user_id = $request->user_id;
        $requisition->class = $request->req_class;
        $requisition->ufcd = $request->req_ufcd;
        $requisition->teacher = $request->req_teacher;
        $requisition->obs = $request->req_obs;
        $requisition->save();

        return response()->json(['success'=>'Fields updated successfully!']);
    }

    public function pending()
    {
        $user = Auth::user();
        $pending_req = Requisition::where('request_user_id', $user->id)
                                    ->where('level_id', 2)
                                    ->get()
                                    ->sortBy('requested_at');
        return view('requisition.list.pending',['pending_req' => $pending_req]);
    }

    public function manage_pending()
    {
        $pending_req = Requisition::where('level_id', 2)
            ->get()
            ->sortBy('requested_at');
        return view('requisition.management.filters.pending',['pending_req' => $pending_req]);
    }



    public function active()
    {
        $user = Auth::user();
        $active_req = Requisition::where('request_user_id', $user->id)
            ->where('level_id', 3) //Aguarda levantamento
            ->get()
            ->sortBy('requested_at');
        return view('requisition.list.active',['active_req' => $active_req]);
    }

    public function closed()
    {
        $user = Auth::user();
        $closed_req = Requisition::where('request_user_id', $user->id)
                                    ->whereIn('level_id', [6,7,8])
                                    ->get()
                                    ->sortBy('requested_at');
        return view('requisition.list.closed',['closed_req' => $closed_req]);
    }

    public function cancel(Requisition $requisition)
    {
        $req_record =  Requisition::find($requisition->id);
        $user = Auth::user();

        if($req_record->request_user_id != $user->id){
            return redirect('/requisitions/pending')->with('error','Não tem permissões para cancelar esta requisição.');
        }
        $this->CancelRequisition($req_record);

        return redirect('/requisitions/pending')->with('success','Requisição cancelacd da com sucesso!');
    }

    public function managementDetails(Requisition $requisition)
    {
        $req_details =  Requisition::find($requisition->id);
        return view('requisition.management.details.details',['req_details' => $req_details]);
    }

    public function managementConfirm(Request $request)
    {
        $manager = Auth::user();
        $req_record =  Requisition::find($request->req_id);
        $req_record->level_id = 3; //Aguarda Levantamento
        $req_record->approved_at = now();
        $req_record->approved_by = $manager->id;
        $req_record->save();
        return redirect('/requisition-management/pending')->with('success','Requisição aprovada com sucesso!');
    }

    public function managementDeny(Request $request)
    {
        $manager = Auth::user();
        $req_record =  Requisition::find($request->req_id);
        $req_record->level_id = 6; //Cancelado
        $req_record->canceled_at = now();
        $req_record->canceled_by = $manager->id;
        $req_record->canceled_obs = $manager->deny_rec_obs;
        $this->CancelRequisition($req_record);
        $req_record->save();
        return redirect('/requisition-management/pending')->with('success','Requisição cancelada com sucesso!');
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
    public function create(Request $request)
    {
        $user = Auth::user();
        $req_info = Requisition::find($request->req_id);
        $req_info->level_id = 2; //estado submetido
        $req_info->requested_at = now();
        $req_info->requested_by = $user->id;
        $req_info->save();
        return response()->json(['success' => 'Requisição submetida com sucesso!']);
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
        $req_details =  Requisition::find($requisition->id);
        return view('requisition.details.detail',['req_details' => $req_details]);
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
