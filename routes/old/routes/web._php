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

Route::get('/', 'ITTController@index');
Route::get('/home', 'ITTController@index');

Route::get("BookingTickets/all/{order?}/{filter?}/{search?}"			, "ITTController@all");
Route::get("BookingTickets/show"										, "ITTController@show");
Route::get("BookingTickets/edit"										, "ITTController@edit");
Route::get("BookingTickets/Delete"										, "ITTController@Delete");
Route::post("BookingTickets/save"										, "ITTController@save");
Route::get("BookingTickets/PdfTicket/{BTicketId?}"						, "ITTController@PdfTicket");

        // Authentication Routes...
Route::get('login'													, 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login'													, 'Auth\LoginController@login');
Route::get('logout'													, 'Auth\LoginController@logout');
Route::post('logout'												, 'Auth\LoginController@logout');

        // Registration Routes...
Route::get('register'												, 'Auth\RegisterController@showRegistrationForm');
Route::post('register'												, 'Auth\RegisterController@register');

        // Password Reset Routes...
Route::get('password/reset'											, 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email'										, 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}'									, 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset'										, 'Auth\ResetPasswordController@reset');
