<?php

namespace App\Http\Controllers;

use App\App_config;
use App\Equipment;
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

    public static function check_low_stock($reference){
        $AppConfiguration = App_config::GetAppConfig();
        if(!$AppConfiguration->conf_low_stock_percentage_check) //se nao tiver checked para validar stock baixo
            return false;
        if($AppConfiguration->conf_low_stock_percentage == 0) //se nao percentagem 0 nao valida
            return false;
        $reference_total = Equipment::where('reference', $reference)->count();
        $reference_in_stock = Equipment::where('reference', $reference)->where('in_stock',1) ->count();
        if($reference_total == 0)
            return false;
        $perc_stock = ( $reference_in_stock / $reference_total) * 100 ;
        if($perc_stock < $AppConfiguration->conf_low_stock_percentage){
            $email_params = [
                'title' => 'Alerta de stock baixo',
                'subject' => 'Stock baixo da Referência  - '. $reference,
                'body' => 'A referência  ' .$reference . ' encontra-se com stock baixo (' . $reference_in_stock . '/'. $reference_total .' un), abaixo do limite de alerta definido ('.$AppConfiguration->conf_low_stock_percentage .'%).' ,
                'link-url'=> env('APP_URL') .'/equip-management/equipments',
                'link-text' =>'Equipamentos'
            ];
            MailController::SendAdministrationEmail($email_params);
            return true;
        }
        return false;
    }


    public function check_alerts()
    {
        $this->Check_expired_requisitions();

        return redirect('/dashboard')->with('success','Alertas processados com sucesso!');
    }
}
