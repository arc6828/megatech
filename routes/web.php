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

//LOGIN REQUIRED
Route::middleware(['auth'])->group(function () {
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

  //1. SALES DEPARTMENT
  Route::middleware(['role:sales,admin'])->group(function () {
    Route::prefix('sales')->group(function () {

      //1 Sales
      Route::resource('/quotation', 'Sales\QuotationController');
      //Route::resource('/quotation/{quotation_id}/quotation_detail', 'Sales\QuotationDetailController');
      //Route::resource('/quotation', 'Sales\QuotationController');
      Route::resource('/order', 'Sales\OrderController');
      Route::get('/order_detail', 'Sales\OrderDetailController@index');
      Route::put('/order_detail/approve', 'Sales\OrderDetailController@approve');
      //Route::resource('/requisition', 'Sales\RequisitionController');
      //Route::resource('/requisition/{requisition_id}/requisition_detail', 'Sales\RequisitionDetailController');
      Route::resource('/invoice', 'Sales\InvoiceController');
      //Route::resource('/invoice/{invoice_id}/invoice_detail', 'Sales\InvoiceDetailController');
    });
  });

  //2. PURCHASE DEPARTMENT
  Route::middleware(['role:purchase,admin'])->group(function () {
    Route::prefix('purchase')->group(function () {
      //Route::resource('/purchase_requisition/approve', 'Purchase\PurchaseRequisitionController@approve');
      Route::resource('/purchase_requisition', 'Purchase\PurchaseRequisitionController');
      Route::get('/purchase_requisition_detail', 'Purchase\PurchaseRequisitionDetailController@index');
      Route::put('/purchase_requisition_detail/approve', 'Purchase\PurchaseRequisitionDetailController@approve');
      Route::get('/purchase_requisition_detail/edit_supplier', 'Purchase\PurchaseRequisitionDetailController@edit_supplier');
      Route::put('/purchase_requisition_detail/update_supplier', 'Purchase\PurchaseRequisitionDetailController@update_supplier');
      //Route::resource('/purchase_requisition/{purchase_requisition_id}/purchase_requisition_detail', 'Purchase\PurchaseRequisitionDetailController');


      //Route::resource('/purchase_receive', 'Purchase\PurchaseReceiveController');
      //Route::resource('/purchase_receive/{purchase_receive_id}/purchase_receive_detail', 'Purchase\PurchaseReceiveDetailController');

      Route::resource('/purchase_order', 'Purchase\PurchaseOrderController');
      //Route::resource('/purchase_order/{purchase_order_id}/purchase_order_detail', 'Purchase\PurchaseOrderDetailController');

    });

  });
  Route::get('/user','UserController@index');
  Route::middleware(['role:admin'])->group(function () {
    Route::resource('/user','UserController')->except(['index']);
  });

});

//storage
Route::get('/storage/{customer_id}/{type}/{filename}', 'StorageController@index');




//Supplier
Route::resource('/supplier', 'SupplierController');

//6 Folders
Route::resource('/customer', 'CustomerController');
Route::resource('/product', 'ProductController');



//not confirm

//Users


//Process Deptor
Route::resource('/finance/debtout', 'DebtoutController');

Route::resource('/finance/settle', 'SettleController');

//Process bank and bank_detail
Route::resource('/bank','BankController');

//Inventory_main
Route::resource('/inventory_main','InventoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Billing

Route::resource('/finance/billing', 'BillingNoteController');

//Reduce_debt

Route::resource('/finance/reduce', 'ReduceDebtController');

//Creditor
Route::resource('/finance/creditor/debtout', 'creditorDebtoutController');

Route::resource('/finance/creditor/debtsettle','creditorDebtSettleController');

Route::resource('/finance/creditor/reduce','reduceCreditorController');
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
