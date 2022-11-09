<?php

namespace App\Http\Controllers;

use App\App_config;
use App\Mail\MailSender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function testemail()
    {
        $details = [
            'title' => 'Email de teste GRE',
            'body' => 'Envio de email de teste do GRE - teste!'
        ];
        Mail::to('salter.sfernandes@gmail.com')->send(new MailSender($details));
    }

    public static function SendEmail($to, $params,$bcc_admin = false){
        $bcc = array();

        if($bcc_admin){
            $AppConfiguration = App_config::GetAppConfig();
            if($AppConfiguration->conf_alert_emails_check && $AppConfiguration->conf_alert_emails != null && $AppConfiguration->conf_alert_emails != ""){
                array_push($bcc,$AppConfiguration->conf_alert_emails);
            }else{
                $tech_users = User::where('user_type_id',2)->get();
                foreach($tech_users as $user){
                    if($user->email != null && $user->email != "")
                    {
                        array_push($bcc,$user->email);
                    }
                }
            }
        }
        Mail::to($to)->bcc($bcc ?: [])->send(new MailSender($params['subject'],$params));
    }

    public static function SendAdministrationEmail($params){

        $to = array();
        $AppConfiguration = App_config::GetAppConfig();
        if($AppConfiguration->conf_alert_emails_check && $AppConfiguration->conf_alert_emails != null && $AppConfiguration->conf_alert_emails != ""){
            array_push($to,$AppConfiguration->conf_alert_emails);
            //$to = $AppConfiguration->conf_default_expire_minutes;
        }else{
            $tech_users = User::where('user_type_id',2)->get();
            foreach($tech_users as $user){
                if($user->email != null && $user->email != "")
                {
                    array_push($to,$user->email);
                }
            }
        }

        Mail::to($to)->send(new MailSender($params['subject'],$params));
    }


}
