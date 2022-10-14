<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function testemail()
    {
        $details = [
            'title' => 'Email de teste GRE',
            'body' => 'Envio de email de teste do GRE'
        ];
        Mail::to('salter.sfernandes@gmail.com')->send(new MailSender($details));
    }
}
