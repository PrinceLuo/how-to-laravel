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

// Email to activate the account in users table
Route::get('verifyEmailfirst','Auth\RegisterController@verifyEmailfirst')->name('verifyEmailfirst');
Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::prefix('admin')->group(function () {
    Route::get('/home','AdminController@index');
    Route::get('/editor','EditorController@index');
    Route::get('/test','EditorController@test');
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\LoginController@login');
    Route::post('logout','Admin\LoginController@logout');
    Route::post('password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset','Admin\ResetPasswordController@reset');
    Route::get('password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('register','Admin\RegisterController@showRegistrationForm');
    Route::post('register','Admin\RegisterController@register');
});

// self-made custom route
Route::prefix('custom')->group(function($route){
    $route->get('register','Custom\CustomAuthController@showRegisterForm')->name('custom.register');
    $route->post('register','Custom\CustomAuthController@register');
    $route->get('login','Custom\CustomAuthController@showLoginForm')->name('custom.login');
    $route->post('login','Custom\CustomAuthController@login');
});
