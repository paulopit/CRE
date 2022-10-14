<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_config extends Model
{
    protected $fillable = [
        'conf_alert_emails', 'conf_alert_emails_check',
        'conf_low_stock_percentage','conf_low_stock_percentage_check',
        'conf_default_req_days','conf_default_req_days_check'
    ];

    public static function GetAppConfig()
    {
        return App_config::find(1);
    }
}
