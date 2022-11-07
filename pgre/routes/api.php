<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/alerts', 'ApiController@alerts');
Route::post('/requisitions', 'ApiController@requisitions_list');
Route::post('/requisitions/Tag', 'ApiController@requisitions_tag');


Route::post('/models/add', 'ApiController@models_create');






