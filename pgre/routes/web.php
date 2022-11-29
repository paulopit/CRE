<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});


/*Auth::routes();*/

Route::get('/test-email', 'MailController@testemail');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/checkalerts', 'AlertController@check_alerts')->name('check-alerts');



Route::group(['middleware' => 'management'], function () {



    // ##Brand management
    Route::get('/equip-management/brands', 'BrandController@index');
    Route::post('/equip-management/brands/add', 'BrandController@store');
    Route::delete('/equip-management/brands/{brand}', 'BrandController@destroy');
    Route::put('/equip-management/brands/{brand}', 'BrandController@update');

    // ##Equipment management
    Route::get('/equip-management/equipments', 'EquipmentController@index');
    Route::post('/equip-management/equipments/add', 'EquipmentController@store');
    Route::delete('/equip-management/equipments/{brand}', 'EquipmentController@destroy');
    Route::put('/equip-management/equipments/{equipment}', 'EquipmentController@update');
    Route::get('/get-models', 'EquipmentModelController@getModels')->name('get_models_info');
    Route::get('/equip-management/equipments/import-template', 'EquipmentController@download_template');
    Route::post('/equip-management/equipments/excel-import', 'EquipmentController@excel_import');

    // ##Model management
    Route::get('/equip-management/models', 'EquipmentModelController@index');
    Route::post('/equip-management/models/add', 'EquipmentModelController@store');
    Route::delete('/equip-management/models/{equipment_model}', 'EquipmentModelController@destroy');
    Route::put('/equip-management/models/{equipment_model}', 'EquipmentModelController@update');
    Route::get('/equip-management/models/import-template', 'EquipmentModelController@download_template');
    Route::post('/equip-management/models/excel-import', 'EquipmentModelController@excel_import');

    Route::get('/equip-management/get-equipment-data', 'EquipmentController@getEquipData')->name('get_equip_data');


    // ##type management
    Route::get('/equip-management/types', 'EquipmentTypeController@index');
    Route::post('/equip-management/types/add', 'EquipmentTypeController@store');
    Route::delete('/equip-management/types/{type}', 'EquipmentTypeController@destroy');
    Route::put('/equip-management/types/{type}', 'EquipmentTypeController@update');



    Route::get('/requisition-management/new', 'RequisitionController@manage_new');
    Route::post('/requisition-management/update-req-fields', 'RequisitionController@manage_updateFields')->name('manage_update_req_fields');
    Route::get('/requisition-management/pending', 'RequisitionController@manage_pending');
    Route::get('/requisition-management/deliver', 'RequisitionController@manage_deliver');
    Route::get('/requisition-management/active', 'RequisitionController@manage_active');
    Route::get('/requisition-management/closed', 'RequisitionController@manage_closed');

    Route::get('/requisition-management/details/{requisition}', 'RequisitionController@managementDetails');
    Route::get('/requisition-management/show/{requisition}', 'RequisitionController@edit');
    Route::put('/requisition-management/show/edit/{requisition}', 'RequisitionController@update');
    Route::post('/requisition-management/confirm', 'RequisitionController@managementConfirm');
    Route::post('/requisition-management/deny', 'RequisitionController@managementDeny');
    Route::post('/requisition-management/register_delivery', 'RequisitionController@registerDelivery');
    Route::post('/requisition-management/register_return', 'RequisitionController@registerReturn');
    Route::post('/requisition-management/extend_requisition', 'RequisitionController@extendRequisition');




});


Route::group(['middleware' => 'admin'], function () {

    // ##App Config
    Route::get('/admin/app-config', 'AppConfigController@index');
    Route::put('/admin/app-config', 'AppConfigController@update');

    // ##User Management
    Route::get('/user-management/users', 'UserAccountController@index');
    Route::put('/user-management/user/{user}', 'UserAccountController@update');

    // ##User Management Types
    Route::post('/user-management/types/add', 'UserTypeController@store');
    Route::get('/user-management/types', 'UserTypeController@index');
    Route::delete('/user-management/types/{user_type}', 'UserTypeController@destroy');
    Route::put('/user-management/types/{user_type}', 'UserTypeController@update');

    // ##User Management Functions
    Route::post('/user-management/functions/add', 'UserFunctionController@store');
    Route::get('/user-management/functions', 'UserFunctionController@index');
    Route::delete('/user-management/functions/{user_function}', 'UserFunctionController@destroy');
    Route::put('/user-management/functions/{user_function}', 'UserFunctionController@update');

    Route::get('/user-info', 'RequisitionController@getUserInfo')->name('get_user_info');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/user/settings', 'UserController@index');
    Route::put('/user/{user}', 'UserController@update');

    Route::get('/requisitions/new', 'RequisitionController@new');
    Route::post('/requisitions/create', 'RequisitionController@create')->name('submit_req');
    Route::get('/requisitions/pending', 'RequisitionController@pending');
    Route::get('/requisitions/active', 'RequisitionController@active');
    Route::get('/requisitions/closed', 'RequisitionController@closed');

    Route::get('/requisitions/details/{requisition}', 'RequisitionController@show');
    Route::post('/requisitions/cancel/{requisition}', 'RequisitionController@cancel');

    Route::get('/getEquipmentsByType/{id}', 'EquipmentController@getEquipmentsByType');
    Route::get('/getEquipmentsByRef/{ref}', 'EquipmentController@getEquipmentsByRef');

    Route::post('/update-req-fields', 'RequisitionController@updateFields')->name('update_req_fields');
    Route::post('/equip-management/equipment/add', 'EquipmentController@add')->name('add_req_equipment');
    Route::post('/equip-management/equipment/remove/{line}', 'EquipmentController@remove')->name('remove_req_equipment');

    Route::match(
        ['get', 'post'],
        '/navbar/search',
        'SearchController@showNavbarSearchResults'
    );
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password/email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password/reset');;


