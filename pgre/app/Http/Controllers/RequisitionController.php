<?php

namespace App\Http\Controllers;

use App\App_config;
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

    private function CancelRequisition($requisition, $level_id){
        //validar se tem equipamentos associados para remover das linhas e atualizar o stock.
        foreach ($requisition->lines as $line){
            //atualizar stock do equipamento
            $equip_rec = Equipment::find($line->equipment_id);
            $equip_rec->in_stock = 1;
            $equip_rec->save();
            $line->is_active = 0;
            $line->save();
        }
        $requisition->level_id =$level_id;
        $requisition->closed_by = Auth::user()->id;
        $requisition->closed_at = now();
        $requisition->save();
        if($requisition->level_id == 5) //5- Expirado
            $requisition->delete();
    }


    private function Check_outdated_requisitions(){
        $expDate = Carbon::now()->subMinutes(30); //requisicões com mais de 30min

        //validar se existe override de timer de requisições expiradas.
        $AppConfiguration = App_config::GetAppConfig();
        if($AppConfiguration->conf_default_expire_minutes_check && is_numeric($AppConfiguration->conf_default_expire_minutes)){
            $expDate = Carbon::now()->subMinutes($AppConfiguration->conf_default_expire_minutes);
        }
        $outdated = Requisition::where('level_id','=', 1)
            ->where('updated_at', '<' , $expDate)
            ->get();
        foreach($outdated as $req){
            $req->canceled_at = now();
            $req->canceled_by = 1;
            $req->canceled_obs = "Requisição expirada";
            $this->CancelRequisition($req, 5); //5- Expirado
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
        if($request->req_days < 1) $request->req_days = 1;
        $requisition->request_days = $request->req_days;
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
        if($request->req_days < 1) $request->req_days = 1;
        $requisition->request_days = $request->req_days;
        $requisition->save();

        return response()->json(['success'=>'Fields updated successfully!']);
    }

    public function pending()
    {
        $user = Auth::user();
        $pending_req = Requisition::where('request_user_id', $user->id)
                                    ->whereIn('level_id', [2,3])
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

    public function manage_deliver()
    {
        $deliver_req = Requisition::where('level_id', 3) //Aguarda Levantamento
            ->get()
            ->sortBy('requested_at');
        return view('requisition.management.filters.deliver',['deliver_req' => $deliver_req]);
    }

    public function manage_active()
    {
        $active_req= Requisition::where('level_id', 4) //Requisitado
        ->get()
            ->sortBy('requested_at');
        return view('requisition.management.filters.active',['active_req' => $active_req]);
    }

    public function manage_closed()
    {
        $closed_req= Requisition::whereIn('level_id', array(6,7, 8)) //6-Cancelado /7-Rejeitado /8-Devolvido
        ->get()
            ->sortByDesc('closed_at');
        return view('requisition.management.filters.closed',['closed_req' => $closed_req]);
    }


    public function active()
    {
        $user = Auth::user();
        $active_req = Requisition::where('request_user_id', $user->id)
            ->where('level_id', 4) //Requisição Activa
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
        $req_record->canceled_at = now();
        $req_record->canceled_by = $user->id;
        $req_record->canceled_obs = "Cancelada pelo User " . $user->name;
        $this->CancelRequisition($req_record, 6); // 6- cancelado
        return redirect('/requisitions/pending')->with('success','Requisição cancelada com sucesso!');
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

        $email_params = [
            'title' => 'Requisição Aceite',
            'subject' => 'Requisição - '. $req_record->tag,
            'body' => 'Olá ' . $req_record->request_user->name . ', a sua requisição foi aceite! Pode proceder ao seu levantamento.' ,
            'link-url'=> env('APP_URL') .'/requisitions/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];

        MailController::SendEmail($req_record->request_user->email,$email_params);

        return redirect('/requisition-management/pending')->with('success','Requisição aprovada com sucesso!');
    }

    public function managementDeny(Request $request)
    {
        $manager = Auth::user();
        $req_record =  Requisition::find($request->req_id);
        $req_record->canceled_at = now();
        $req_record->canceled_by = $manager->id;
        $req_record->canceled_obs = $request->deny_rec_obs;

        $this->CancelRequisition($req_record, 7); //7 - Rejeitado
        $req_record->save();

        $email_params = [
            'title' => 'Requisição Rejeitada',
            'subject' => 'Requisição - '. $req_record->tag,
            'body' => 'Olá ' . $req_record->request_user->name . ', a sua requisição foi rejeitada! Motivo: ' . $request->deny_rec_obs ,
            'link-url'=> env('APP_URL') .'/requisitions/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];

        MailController::SendEmail($req_record->request_user->email,$email_params);
        return redirect('/requisition-management/pending')->with('success','Requisição rejeitada com sucesso!');
    }


    public function registerDelivery(Request $request){

        $manager = Auth::user(); //user logado

        $req_record = Requisition::find($request->req_id); //requisição a alterar
        $req_days = 1;
        if(is_numeric($request->req_days)) //validar se é numerico, caso seja preenche com o valor, senao insere sempre o valor 1
            $req_days = $request->req_days;
        $req_record->request_days =  $req_days; //valor de dias preenchido no form
        $req_record->picked_up_by =  $request->req_pickup_name; //nome preenchido no form - quem levantou
        $req_record->picked_up_at = now(); // hora atual
        $req_record->delivered_by = $manager->id; // utilizador logado - quem entregou
        $req_record->delivered_at = now();
        $req_record->level_id = 4; // 4- Requisitado
        //vamos calcular a data limite da requisição.
        $limit_date = Carbon::now()->addDays($req_days); //vamos criar a data limite
        $req_record->end_date = $limit_date->setTime(23,59,59); //vamos fixar a data limite ás 23:59:59 sempre.
        $req_record->save();

        foreach($req_record->lines as $line){ //percorrer todas as linhas ( ou seja, todos os equipamentos desta requisição)
            if(isset($request['equipment_status_' . $line->equipment_id])){ //validar se no request foi selecionado OK.
                $line->equipment->status_ok = 1;
            }else{ //nao veio no request, logo estava marcado NOK
                $line->equipment->status_ok = 0;
            }
            //vamos registar o estado de entrega do equipamento na nossa linha.
            $line->delivery_status = $line->equipment->status_ok;
            $line->save();
            $line->equipment->save();
        }

        $email_params = [
            'title' => 'Requisição Entregue',
            'subject' => 'Requisição - '. $req_record->tag,
            'body' => 'Olá ' . $req_record->request_user->name . ', a sua requisição foi entregue a ' . $request->req_pickup_name .'. A devolução deve ser efetuada até dia ' . $req_record->end_date->format('d-m-Y') ,
            'link-url'=> env('APP_URL') .'/requisitions/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];

        MailController::SendEmail($req_record->request_user->email,$email_params);
        return redirect('/requisition-management/deliver')->with('success','Requisição entregue com sucesso!');
    }


    public function registerReturn(Request $request){

        $manager = Auth::user();
        $req_record = Requisition::find($request->req_id);
        $req_record->returned_by =  $request->req_return_name;
        $req_record->returned_at = now();
        $req_record->closed_by = $manager->id;
        $req_record->closed_at = now();
        $req_record->level_id = 8; // 8- Devolvido
        $req_record->save();

        foreach($req_record->lines as $line){
            $line->is_active = 0; // inativar todas as linhas da requisição.
            $line->equipment->in_stock = 1; //voltar a colocar os equipamentos em stock.
            if(isset($request['equipment_status_' . $line->equipment_id])){
                $line->equipment->status_ok = 1;
            }else{
                $line->equipment->status_ok = 0;
            }
            $line->return_status = $line->equipment->status_ok;
            $line->save();
            $line->equipment->save();
        }

        $email_params = [
            'title' => 'Requisição Devolvida',
            'subject' => 'Requisição - '. $req_record->tag,
            'body' => 'Olá ' . $req_record->request_user->name . ', a sua requisição foi devolvida por ' . $request->req_return_name . '. Obrigado' ,
            'link-url'=> env('APP_URL') .'/requisitions/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];
        MailController::SendEmail($req_record->request_user->email,$email_params);

        return redirect('/requisition-management/active')->with('success','Requisição devolvida com sucesso!');
    }


    public function extendRequisition(Request $request){
        $req_record = Requisition::find($request->req_id); //vamos ler o nosso registo a alterar.

        $old_date = Carbon::parse($req_record->end_date);
        $new_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_date . ' 23:59:59');

        //validar se a data pedida é superior a data existente
        if($old_date->gt($new_date))
            return redirect('/requisition-management/details/'. $request->req_id)->with('error','A nova data não pode ser inferior a data atual!');
        $req_record->end_date = $request->end_date;
        $req_record->save();

        //enviar um email.
        $email_params = [
            'title' => 'Requisição Extendida',
            'subject' => 'Requisição - '. $req_record->tag,
            'body' => 'Olá ' . $req_record->request_user->name . ', o prazo de entrega da sua requisição foi extendido até ao dia ' . $new_date->format('d-m-Y')  . '. Obrigado' ,
            'link-url'=> env('APP_URL') .'/requisitions/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];
        MailController::SendEmail($req_record->request_user->email,$email_params);

        return redirect('/requisition-management/details/'. $request->req_id)->with('success','Prazo de entrega da requisição prolongado com sucesso!');
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

        $email_params = [
            'title' => 'Submetida Nova Requisição',
            'subject' => 'Submetida nova requisição - '. $req_info->tag,
            'body' => 'Foi efetuada uma nova requisição pelo utilizador ' .$user->name ,
            'link-url'=> env('APP_URL') .'/requisition-management/details/' . $request->req_id,
            'link-text' =>'Visualizar'
        ];
        MailController::SendAdministrationEmail($email_params);

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
        $req =  Requisition::find($requisition->id);
        return view('requisition.management.filters.edit_pending',['req' => $req]);
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

        $req = Requisition::find($requisition->id);
        //dd($req);

        $req->course                                    = $request->req_course;
        $req->class                                    = $request->req_class;
        $req->ufcd                                      = $request->req_ufcd;
        $req->teacher                                   = $request->req_teacher;
        $req->obs                                       = $request->req_obs;

        //dd($req);

        $req->save();

        return redirect('/requisition-management/pending')->with('success','Requisição Editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
            $req_details =  Requisition::find($requisition->id);

    }

}
