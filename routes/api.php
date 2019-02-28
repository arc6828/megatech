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
//QUOTATION
Route::get('/quotation_detail/user/{user_id}', 'API\QuotationDetailController@index_by_user');

Route::get('/quotation_detail/customer/{customer_id}', 'API\QuotationDetailController@index_by_customer');
Route::get('/quotation_detail/customer/{customer_id}/user/{user_id}', 'API\QuotationDetailController@index_by_user');
Route::apiResource('/quotation_detail', 'API\QuotationDetailController');

//ORDER
Route::get('/order/validate_po', 'API\OrderController@validate_po');
Route::apiResource('/order', 'API\OrderController');


//API
Route::apiResource('/customer', 'API\CustomerController');
Route::apiResource('/product', 'API\ProductController');
Route::apiResource('/order', 'API\OrderController');
Route::apiResource('/order_detail', 'API\OrderDetailController');
Route::apiResource('/purchase_requisition_detail', 'API\PurchaseRequisitionDetailController');

Route::get('/account', 'AccountController@getAccount');
Route::get('/user', 'UserController@getUser');
//Route::get('/api/order_detail', 'Sales\OrderDetailController@getOrderDetails');
//Route::get('/purchase_requisition_detail', 'Purchase\PurchaseRequisitionController@getPurchaseRequisitionDetails');
Route::get('/bank_detail', 'BankDetailController@index');
