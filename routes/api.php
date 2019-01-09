<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API
Route::apiResource('/customer', 'API\CustomerController');
Route::apiResource('/product', 'API\ProductController');
Route::apiResource('/order_detail', 'API\OrderDetailController');

Route::get('/account', 'AccountController@getAccount');
Route::get('/user', 'UserController@getUser');
//Route::get('/api/order_detail', 'Sales\OrderDetailController@getOrderDetails');
Route::get('/purchase_requisition_detail', 'Purchase\PurchaseRequisitionController@getPurchaseRequisitionDetails');
Route::get('/bank_detail', 'BankDetailController@index');
