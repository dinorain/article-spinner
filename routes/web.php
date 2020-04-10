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

Auth::routes([
//    'verify' => true,
    'register' => false,
]);
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/logout', 'Auth\LoginController@logout');

    // non-admin route group
    Route::group(['middleware' => ['can:isntAdmin']], function () {


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

    });

    // admin routes
    Route::group(['middleware' => ['can:isAdmin']], function () {
        Route::group(['prefix' => 'openSesame'], function () {
            Route::any('/', 'AdminController@index')->name('admin.index');
            Route::any('/{slug}', 'AdminController@index')->where('slug', '.*');
        });
    });
});
