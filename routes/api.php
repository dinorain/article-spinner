<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:web']], function () {

    Route::group(['prefix' => 'openSesame/targets'], function () {
        Route::get('/{id}', 'Api\TargetController@detail');
        Route::get('/{target_id}/spintax/{id}', 'Api\SpintaxController@detail');
    });

});
