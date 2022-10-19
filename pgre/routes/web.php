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


Route::group(['middleware' => 'management'], function () {

    // ##Brand management
    Route::get('/equip-management/brands', 'BrandController@index');
    Route::post('/equip-management/brands/add', 'BrandController@store');
    Route::delete('/equip-management/brands/{brand}', 'BrandController@destroy');
    Route::put('/equip-management/brands/{brand}', 'BrandController@update');
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


});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


