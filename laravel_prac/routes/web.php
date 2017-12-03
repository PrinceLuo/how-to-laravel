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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('home','AdminController@index');
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\LoginController@login');
    Route::post('logout','Admin\LoginController@logout');
    Route::post('password/email','Admin\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset','Admin\ResetPasswordController@reset');
    Route::get('password/reset/{token}','Admin\ResetPasswordController@showResetForm');
    Route::get('register','Admin\RegisterController@showRegistrationForm');
    Route::post('register','Admin\RegisterController@register');
});
