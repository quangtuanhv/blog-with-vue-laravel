<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'RegisterController@register')->name('register');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'ResetPasswordController@reset');

Route::get('{id}', function ($id) {
    return $id;
});