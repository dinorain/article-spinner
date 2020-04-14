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

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@spin')->name('home.spin');

Auth::routes([
//    'verify' => true,
    'register' => false,
]);

Route::post('/login', 'Auth\LoginController@loginUser')->name('login');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/logout', 'Auth\LoginController@logout');

    /**
     * Edit account personal information
     */
    Route::get('/accounts/personal', 'UserController@editPersonal')->name('account.personal.edit');
    Route::post('/accounts/personal', 'UserController@updatePersonal')->name('account.personal.update');

    /**
     * Edit account password
     */
    Route::get('/accounts/password', 'UserController@editPassword')->name('account.password.edit');
    Route::post('/accounts/password', 'UserController@updatePassword')->name('account.password.update');


    Route::group(['prefix' => 'openSesame/targets'], function () {
        Route::any('/', 'AdminController@index')->name('admin.index');
        // Route::any('/{slug}', 'AdminController@index')->where('slug', '.*');

        Route::get('/', 'TargetController@index')->name('target.index');
        Route::post('/', 'TargetController@store')->name('target.store');
        Route::post('/{id}', 'TargetController@update')->name('target.update');
        Route::delete('/{id}', 'TargetController@destroy')->name('target.destroy');

        Route::get('/{target_id}/spintax', 'SpintaxController@index')->name('spintax.index');
        Route::post('/{target_id}/spintax', 'SpintaxController@store')->name('spintax.store');
        Route::post('/{target_id}/spintax/{id}', 'SpintaxController@update')->name('spintax.update');
        Route::delete('/{target_id}/spintax/{id}', 'SpintaxController@destroy')->name('spintax.destroy');
    });
});

