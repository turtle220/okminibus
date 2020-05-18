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

Route::get('/', 'BookingController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//bookingTickets
Route::get("BookingTickets/show", "BookingController@show");
Route::get("BookingTickets/edit", "BookingController@edit");
Route::get("BookingTickets/Delete"	, "BookingController@Delete");
Route::post("BookingTickets/save"	, "BookingController@save");
Route::get("BookingTickets/PdfTicket/{BTicketId?}", "BookingController@PdfTicket");
Route::post("viewinvoice", "BookingController@viewinvoice");
Route::get("BookingTickets/setcheck", "BookingController@setCheck");
Route::get("BookingTickets/search", "BookingController@search");
Route::get("BookingTickets/editAjax", "BookingController@editAjax");
Route::get("BookingTickets/resave", "BookingController@store");
//invoice
Route::get("invoice", "InvoiceController@index");
Route::get("invoice/edit", "InvoiceController@edit");
Route::post("invoice/update", "InvoiceController@update");
Route::post("invoice/pdf", "InvoiceController@invoiceToPdf");
Route::post("invoicelist/pdf", "InvoiceController@invoicelistToPdf");

//area
Route::get('area','AreaController@index');
Route::get('area/store', 'AreaController@store');
Route::get('area/create', 'AreaController@create');
Route::get('area/edit', 'AreaController@edit');
Route::post('area/update', 'AreaController@update');
Route::post('area/destroy', 'AreaController@destroy');


//admin url
Route::get('/users', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/edit', 'UserController@edit');
Route::post('user/update', 'UserController@update');
Route::post('/user/delete', 'UserController@destroy');
Route::get('/user/setrole', 'UserController@setRole');


//excel url
Route::get('excel', 'ExcelController@index');
// Route::post('excel/print/admin',  'ExcelController@printAdmin()');
Route::post('excel/print','ExcelController@printExcel');
Route::get('/getuserlistajax', 'UserController@getUserListAjax');
Route::post('selectedprint', 'ExcelController@selectedPrint');

Route::get('/getCurrentTime', 'BookingController@getCurrentTime');