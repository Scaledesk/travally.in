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

Route::post('auth/a', function() {
    return Response::json('a');
});
    //Registration Routes
    Route::post('auth/register', 'Auth\RegistrationController@register');
//    Route::get('register/verify/{confirmationCode}', 'Auth\RegistrationController@confirm');

    Route::post('auth/login', function () {
        return Response::json(Authorizer::issueAccessToken());
    });
    Route::post('auth/google', 'Auth\AuthController@google');
    Route::post('auth/facebook', 'Auth\AuthController@facebook');
    Route::get('getProfile', 'ProfileController@getProfile');
    Route::PUT('profileUpdate', 'ProfileController@update');
    Route::post('changePassword', 'Auth\PasswordController@changePassword');
    Route::post('forgotPassword', 'Auth\RegistrationController@forgotPassword');
    Route::post('resetForgotPassword', 'Auth\RegistrationController@resetPassword');
    Route::resource('adv','AdvController');
