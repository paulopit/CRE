<?php

namespace App\Http\Controllers;

use App\App_config;
use App\Requisition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public static function Check_expired_requisitions(){
        $expired_requisitions = Requisition::where('end_date', '<', now())
                                ->where('level_id',4) //4 - Requisitado
                                ->get();

        foreach($expired_requisitions as $requisition){

            $email_params = [
                'title' => 'Prazo de devolução de requisição expirado',
                'subject' => 'Requisição - '. $requisition->tag,
                'body' => 'Olá ' . $requisition->request_user->name . ', a sua requisição encontra-se expirada desde ' .$requisition->end_date .' ! Proceda à sua devolução assim que possivel.' ,
                'link-url'=> env('APP_URL') .'/requisitions/details/' . $requisition->id,
                'link-text' =>'Visualizar'
            ];

            if($requisition->last_alert != null){
                if(!Carbon::parse($requisition->last_alert)->isToday()){ //apenas vamos enviar um alerta por dia.

                    MailController::SendEmail($requisition->request_user->email,$email_params,true );
                    $requisition->last_alert = now();
                    $requisition->save();
                }
            }else{
                    MailController::SendEmail($requisition->request_user->email,$email_params, true);
                    $requisition->last_alert = now();
                    $requisition->save();
            }
        }
    }



    public function check_alerts()
    {
        $this->Check_expired_requisitions();

        return redirect('/dashboard')->with('success','Alertas processados com sucesso!');
    }
}
