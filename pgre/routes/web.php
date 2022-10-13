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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/user/settings', 'UserController@index');
    Route::put('/user/{user}', 'UserController@update');
});

Route::group(['middleware' => 'admin'], function () {
    Route::post('/user-management/functions/add', 'UserFunctionController@store');
    Route::get('/user-management/functions', 'UserFunctionController@index');
    Route::delete('/user-management/functions/{user_function}', 'UserFunctionController@destroy');
    Route::put('/user-management/functions/{user_function}', 'UserFunctionController@update');

    Route::post('/user-management/types/add', 'UserTypeController@store');
    Route::get('/user-management/types', 'UserTypeController@index');
    Route::delete('/user-management/types/{user_type}', 'UserTypeController@destroy');
    Route::put('/user-management/types/{user_type}', 'UserTypeController@update');

    Route::get('/admin/app-config', 'AppConfigController@index');
    Route::put('/admin/app-config', 'AppConfigController@update');

    Route::get('/user-management/users', 'UserAccountController@index');
    Route::put('/user-management/user/{user}', 'UserAccountController@update');

});
