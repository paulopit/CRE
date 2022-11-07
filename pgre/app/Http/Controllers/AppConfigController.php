<?php

namespace App\Http\Controllers;

use App\App_config;
use Illuminate\Http\Request;

class AppConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_config = App_config::find(1);
        return view('app.configuration.parameters', ['app_config' => $app_config]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\App_config  $app_config
     * @return \Illuminate\Http\Response
     */
    public function show(App_config $app_config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\App_config  $app_config
     * @return \Illuminate\Http\Response
     */
    public function edit(App_config $app_config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\App_config  $app_config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $app_config = App_config::find(1);
        $app_config->conf_api_key = $request->conf_api_key;
        $app_config->conf_alert_emails = $request->conf_alert_emails;
        $app_config->conf_low_stock_percentage = $request->conf_low_stock_value;
        $app_config->conf_default_req_days = $request->conf_default_req_days;
        $app_config->conf_default_expire_minutes = $request->conf_default_expire_minutes;
        $app_config->conf_alert_emails_check = (boolean)json_decode(strtolower($request->conf_alert_emails_check)) ?? 0;
        $app_config->conf_low_stock_percentage_check = (boolean)json_decode(strtolower($request->conf_low_stock_check)) ?? 0;
        $app_config->conf_default_req_days_check = (boolean)json_decode(strtolower($request->conf_default_req_days_check)) ?? 0;
        $app_config->conf_default_expire_minutes_check = (boolean)json_decode(strtolower($request->conf_default_expire_minutes_check)) ?? 0;
        $app_config->save();
        return redirect('admin/app-config')->with('success','Configurações alteradas com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\App_config  $app_config
     * @return \Illuminate\Http\Response
     */
    public function destroy(App_config $app_config)
    {
        //
    }
}
