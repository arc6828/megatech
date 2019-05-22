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

//Province + District
Route::get('/province','API\DistrictController@provinces');
Route::get('/province/{province_code}/amphoe','API\DistrictController@amphoes');
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district','API\DistrictController@districts');
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district/{district_code}','API\DistrictController@detail');


//API
Route::apiResource('/customer', 'API\CustomerController');
Route::apiResource('/product', 'API\ProductController');
//Route::apiResource('/order', 'API\OrderController');

Route::get('/order_detail/index2', 'API\OrderDetailController@index2');
Route::apiResource('/order_detail', 'API\OrderDetailController');

Route::prefix('purchase')->group(function () {
  Route::get('/purchase_requisition_detail/customer/{customer_id}', 'API\PurchaseRequisitionDetailController@index_by_customer');
  Route::apiResource('/requisition_detail', 'API\Purchase\RequisitionDetailController');
});

Route::get('/account', 'AccountController@getAccount');
Route::get('/user', 'UserController@getUser');
//Route::get('/api/order_detail', 'Sales\OrderDetailController@getOrderDetails');
//Route::get('/purchase_requisition_detail', 'Purchase\PurchaseRequisitionController@getPurchaseRequisitionDetails');
Route::get('/bank_detail', 'BankDetailController@index');
