<?php

namespace App\Http\Controllers;

use App\Api_requisition;
use App\App_config;
use App\Requisition;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class ApiController extends Controller
{
    private function api_key_validation($api_key){
        $AppConfiguration = App_config::GetAppConfig();
        return $AppConfiguration->conf_api_key == $api_key;
    }

    public function alerts(){
        try
        {
            AlertController::Check_expired_requisitions();
            return response()->json(['result' => 'Alertas executados com sucesso!'], 200);
        }catch (Exception $exception){
            return response()->json(['error' => $exception], 500);
        }
    }

    public function requisitions_all(Request $request){
        //validate API Key
        if(!isset($request->Api_key))
            return response()->json(['error' => 'Api_key is missing!'], 500);
        if(!$this->api_key_validation($request->Api_key))
            return response()->json(['error' => 'Invalid Api_key'], 500);
        $all_req = Requisition::where('level_id','!=',1)->get(); //ignorar as temporárias

        $response = new stdClass();
        $response_list = [];
        foreach ($all_req as $req){
            array_push($response_list, new Api_requisition($req));
        }

        $response->total = count($all_req);
        $response->results = $response_list;
        return response()->json($response, 200);
    }




}
