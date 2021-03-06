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

Route::get('/', 'HomeController@coming')->name('coming');
Route::get('/thank-you', 'HomeController@thank')->name('thank');


Route::group(['prefix' => 'arcspin'], function () {

    Route::get('/', 'HomeController@welcome')->name('welcome');
    Route::get('/home', 'HomeController@welcome')->name('home');
    Route::post('/', 'HomeController@spin')->name('home.spin');

    Auth::routes([
    //    'verify' => true,
        'register' => false,
    ]);

    Route::post('/login', 'Auth\LoginController@loginUser')->name('login');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::get('/thank-you', 'HomeController@thank')->name('thank');

    Route::post('/feedback', 'FeedbackController@create')->name('feedback.create');


    Route::group(['middleware' => ['auth', 'verified']], function () {

        Route::get('/logout', 'Auth\LoginController@logout');


        Route::group(['prefix' => 'openSesame'], function () {
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

        Route::group(['prefix' => 'openSesame/targets'], function () {
            Route::any('/', 'AdminController@index')->name('admin.index');
            // Route::any('/{slug}', 'AdminController@index')->where('slug', '.*');

            Route::get('/', 'TargetController@index')->name('target.index');
            Route::post('/', 'TargetController@store')->name('target.store');
            Route::post('/{id}', 'TargetController@update')->name('target.update');
            Route::delete('/{id}', 'TargetController@destroy')->name('target.destroy');

            Route::post('/names/excel', 'TargetController@uploadTargetsExcel')
                ->name('target.excel.upload');

            Route::get('/{target_id}/spintax', 'SpintaxController@index')->name('spintax.index');
            Route::post('/{target_id}/spintax', 'SpintaxController@store')->name('spintax.store');
            Route::post('/{target_id}/spintax/{id}', 'SpintaxController@update')->name('spintax.update');
            Route::delete('/{target_id}/spintax/{id}', 'SpintaxController@destroy')->name('spintax.destroy');

            Route::post('/{target_id}/spintax/synonyms/excel', 'SpintaxController@uploadSpintaxCollectionsExcel')
                ->name('spintax.excel.upload');
        });
    });

});
