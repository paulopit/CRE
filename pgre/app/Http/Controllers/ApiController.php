<?php

namespace App\Http\Controllers;

use App\Api_requisition;
use App\App_config;
use App\Equipment_model;
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

    public function requisitions_list(Request $request){
        //validate API Key
        if(!isset($request->Api_key))
            return response()->json(['error' => 'Api_key is missing!'], 500);
        if(!$this->api_key_validation($request->Api_key))
            return response()->json(['error' => 'Invalid Api_key'], 500);

        $all_req = Requisition::with(['requisition_level:id,name', 'request_user:id,name','lines.equipment'])
                            ->where('level_id','!=',1)
                            ->get(); //ignorar as temporárias

        return response()->json($all_req, 200);
    }

    public function requisitions_tag(Request $request){
        //validate API Key
        if(!isset($request->Api_key))
            return response()->json(['error' => 'Api_key is missing!'], 500);
        if(!$this->api_key_validation($request->Api_key))
            return response()->json(['error' => 'Invalid Api_key'], 500);
        $req_record = Requisition::with(['requisition_level:id,name', 'request_user:id,name','lines.equipment'])
            ->where('tag', $request->Tag)
            ->get();
        return response()->json($req_record, 200);
    }

    public function models_create(Request $request){
        if(!isset($request->Api_key))
            return response()->json(['error' => 'Api_key is missing!'], 500);
        if(!$this->api_key_validation($request->Api_key))
            return response()->json(['error' => 'Invalid Api_key'], 500);

        if(!isset($request->brand_name) || !isset($request->model_name)){
            return response()->json(['error' => 'Brand or Model name is missing!'], 500);
        }
        $model_id = EquipmentModelController::create_model($request->brand_name,$request->model_name);
        $model_info = Equipment_model::with(['brand:id,name'])
                        ->where('id', $model_id)
                        ->first();
        return response()->json($model_info, 200);
    }

    //Criar equipamentos completos



}
