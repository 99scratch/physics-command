<?php

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


Route::middleware(['checkKey'])->group(function () {

    Route::get('/gate/listen', 'Api\ApiController@listenCommand');
    Route::post('/gate/send', 'Api\ApiController@sendElement');
    Route::get('/gate/checkStatus', 'Api\ApiController@forceEndCommand');
});

Route::get('/', function (){
    return redirect('/user/login');
});
Route::get('/user/login', 'User\UserController@login');
Route::post('/user/login', 'User\UserController@login_post');

Route::middleware(['checkLogin'])->group(function () {

    Route::get('/user/account/devices', 'User\UserController@account_view');
    Route::get('/user/account/device/information/{device_id}', 'User\DevicesController@device_information');
    Route::get('/user/account/settings', 'User\UserController@account_settings');
    Route::post('/user/account/settings/update', 'User\UserController@account_settings_update');
    Route::get('/user/account/device/{device_id}', 'User\DevicesController@device_view');
    Route::get('/user/account/device/{device_id}/execute', 'User\DevicesController@device_execute');
    Route::post('/user/account/device/{device_id}/execute', 'User\DevicesController@device_execute_post');
    Route::get('/user/account/device/packet/{log_id}', 'User\DevicesController@view_packet');
    Route::get('/user/device/commandList', 'User\DevicesController@command_lists');
    Route::get('/user/account/stream/event/{device_id}', 'User\UserController@stream_event');
    Route::get('/user/account/stream/event', 'User\UserController@stream_global');
    Route::get('/user/account/logout', 'User\UserController@logout');
});
