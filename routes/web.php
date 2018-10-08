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
Route::get('/index',function(){
	return redirect('/sales');
});

//Main Menu
Route::get('/sales',function(){
    return view('sales/index');
});
Route::get('/purchase',function(){
	return view('purchase/index');
});
Route::get('/inventory',function(){
    return view('inventory/index');
});
Route::get('/finance',function(){
    return view('finance/index');
});
Route::get('/account',function(){
    return view('account/index');
});
Route::get('/others',function(){
    return view('others/index');
});


//1 Sales
Route::resource('/sales/quotation', 'Sales\QuotationController');
Route::resource('/sales/quotation/{quotation_id}/quotation_detail', 'Sales\QuotationDetailController');

Route::resource('/sales/order', 'Sales\OrderController');
Route::resource('/sales/order/{order_id}/order_detail', 'Sales\OrderDetailController');

Route::resource('/sales/requisition', 'Sales\RequisitionController');
Route::resource('/sales/requisition/{requisition_id}/requisition_detail', 'Sales\RequisitionDetailController');

Route::resource('/sales/invoice', 'Sales\InvoiceController');
Route::resource('/sales/invoice/{invoice_id}/invoice_detail', 'Sales\QuotationDetailController');

//6 Folders
Route::resource('/user', 'UserController');
Route::resource('/customer', 'CustomerController');
Route::resource('/product', 'ProductController');

//not confirm


//Process Deptor
Route::resource('/finance/debtout', 'DebtoutController');

Route::resource('/finance/settle', 'SettleController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//THEME
Route::get('/dashboard', function () {
    return view('monster-lite/index');
});
Route::get('/icon-fontawesome', function () {
    return view('monster-lite/icon-fontawesome');
});
Route::get('/map-google', function () {
    return view('monster-lite/map-google');
});
Route::get('/pages-blank', function () {
    return view('monster-lite/pages-blank');
});
Route::get('/icon-fontawesome', function () {
    return view('monster-lite/icon-fontawesome');
});
Route::get('/pages-error-404', function () {
    return view('monster-lite/pages-error-404');
});
Route::get('/pages-profile', function () {
    return view('monster-lite/pages-profile');
});
Route::get('/table-basic', function () {
    return view('monster-lite/table-basic');
});
