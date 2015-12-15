<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');*/


Route::post('auth/a', function() {
    return Response::json('a');
});

    //Registration Routes
    Route::post('auth/register', 'Auth\RegistrationController@register');
//    Route::get('register/verify/{confirmationCode}', 'Auth\RegistrationController@confirm');

    Route::post('auth/login', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::post('auth/git', 'Auth\AuthController@github');
    Route::post('auth/google', 'Auth\AuthController@google');

    Route::resource('adv','AdvController');