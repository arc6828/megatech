<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('invoice', 'API\InvoiceController@index');

//ORDER
Route::get('/order/validate_po', 'API\OrderController@validate_po');
Route::apiResource('/order', 'API\OrderController');

//DELIVERY TEMPOPARY
Route::get('/delivery_temporary_detail/customer/{customer_id}', 'API\DeliveryTemporaryDetailController@index_by_customer');

//Province + District
Route::get('/province', 'API\DistrictController@provinces');
Route::get('/province/{province_code}/amphoe', 'API\DistrictController@amphoes');
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district', 'API\DistrictController@districts');
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district/{district_code}', 'API\DistrictController@detail');

//API
Route::apiResource('/customer', 'API\CustomerController');
Route::get('/contact/{mode}/{id}', 'API\ContactController@index');
Route::apiResource('/supplier', 'API\SupplierController');
Route::apiResource('/product', 'API\ProductController');
//Route::apiResource('/order', 'API\OrderController');

Route::get('/order_detail/customer/{customer_id}/product/{product_id}', 'API\OrderDetailController@history_sell_price');
Route::get('/order_detail/index2', 'API\OrderDetailController@index2');
Route::apiResource('/order_detail', 'API\OrderDetailController');
// Route::apiResource('/picking_detail', 'API\OrderDetailController');

Route::prefix('purchase')->group(function () {
    Route::get('/requisition_detail/supplier/{supplier_id}', 'API\Purchase\RequisitionDetailController@index_by_supplier');
    Route::get('/requisition_detail/index2', 'API\Purchase\RequisitionDetailController@index2');
    Route::apiResource('/requisition_detail', 'API\Purchase\RequisitionDetailController');
    //PO - Detail
    Route::get('/order_detail/supplier/{supplier_id}', 'API\Purchase\OrderDetailController@supplier');
    Route::get('/order_detail/supplier/{supplier_id}/product/{product_id}', 'API\Purchase\OrderDetailController@history_purchase_price');
    Route::get('/order_detail/order_code/{order_code}', 'API\Purchase\OrderDetailController@order_code');
    Route::get('/order_detail/index2', 'API\Purchase\OrderDetailController@index2');
    Route::apiResource('/order_detail', 'API\Purchase\OrderDetailController');
});

Route::get('/account', 'AccountController@getAccount');
Route::get('/user', 'UserController@getUser');
//Route::get('/api/order_detail', 'Sales\OrderDetailController@getOrderDetails');
//Route::get('/purchase_requisition_detail', 'Purchase\PurchaseRequisitionController@getPurchaseRequisitionDetails');
Route::get('/bank_detail', 'BankDetailController@index');

Route::apiResource('issue-stock', 'API\IssueStockController');

Route::apiResource("picking",'Api\PickingController');
// Route::get('/picking_detail/customer/{customer_id}/product/{product_id}', 'API\PickingDetailController@history_sell_price');
Route::apiResource("picking_detail",'Api\PickingDetailController');
// Route::get('/company', 'API\CompanyController@index');
Route::get('/numberun', 'Api\NumberController@index');
Route::get('/numberun/{id}', 'Api\NumberController@show');
Route::post('/numberun/create', 'Api\NumberController@store');
Route::put('/update', 'Api\NumberController@update');