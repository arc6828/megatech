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
  Route::get('/genbarcode',function(){
    $oe= "OE1906-00004";
      //echo DNS1D::getBarcodeHTML($oe, "C128");
      //echo '<img src="data:image/png,' . DNS1D::getBarcodePNG($oe, "C128") . '" alt="barcode"   />';
      echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($oe, "C128") . '" alt="barcode"   />';
      echo $oe;
  });




  //1. SALES DEPARTMENT
  Route::middleware(['role:sales,admin'])->group(function () {
    Route::prefix('sales')->group(function () {

      //1 Sales
      Route::get('/quotation/{id}/pdf', 'Sales\QuotationController@pdf');
      Route::resource('/quotation', 'Sales\QuotationController');
      //Route::resource('/quotation/{quotation_id}/quotation_detail', 'Sales\QuotationDetailController');
      //Route::resource('/quotation', 'Sales\QuotationController');
      Route::resource('/order', 'Sales\OrderController');
      Route::get('/order_detail', 'Sales\OrderDetailController@index');
      Route::put('/order_detail/approve', 'Sales\OrderDetailController@approve');
      //Route::resource('/requisition', 'Sales\RequisitionController');
      //Route::resource('/requisition/{requisition_id}/requisition_detail', 'Sales\RequisitionDetailController');
      Route::resource('/invoice', 'Sales\InvoiceController');
      Route::resource('/delivery_temporary', 'Sales\DeliveryTemporaryController');
      //Route::resource('/invoice/{invoice_id}/invoice_detail', 'Sales\InvoiceDetailController');
    });
  });

  //2. PURCHASE DEPARTMENT
  Route::middleware(['role:purchase,admin'])->group(function () {
    Route::prefix('purchase')->group(function () {
      //Route::resource('/purchase_requisition/approve', 'Purchase\PurchaseRequisitionController@approve');
      Route::resource('/requisition', 'Purchase\RequisitionController');
      Route::get('/requisition_detail', 'Purchase\RequisitionDetailController@index');
      Route::put('/requisition_detail/approve', 'Purchase\RequisitionDetailController@approve');
      Route::get('/requisition_detail/edit_supplier', 'Purchase\RequisitionDetailController@edit_supplier');
      Route::put('/requisition_detail/update_supplier', 'Purchase\RequisitionDetailController@update_supplier');
      //Route::resource('/purchase_requisition/{purchase_requisition_id}/purchase_requisition_detail', 'Purchase\PurchaseRequisitionDetailController');


      Route::resource('/receive', 'Purchase\ReceiveController');
      //Route::resource('/purchase_receive/{purchase_receive_id}/purchase_receive_detail', 'Purchase\PurchaseReceiveDetailController');

      Route::resource('/order', 'Purchase\OrderController');
      //Route::resource('/purchase_order/{purchase_order_id}/purchase_order_detail', 'Purchase\PurchaseOrderDetailController');

      Route::get('/order_detail', 'Purchase\OrderDetailController@index');
      Route::put('/order_detail/approve', 'Purchase\OrderDetailController@approve');

    });

  });
  Route::get('/user','UserController@index');
  Route::middleware(['role:admin'])->group(function () {
    Route::resource('/user','UserController')->except(['index']);
  });

});

//storage
Route::get('/storage/{blob}/{id}/{type}/{filename}', 'StorageController@index');




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

Route::resource('product2', 'Product2Controller');

Route::resource('stock', 'StockController');

//REPORT SALES : 1/x
Route::get("report/sales/1/3","Report\SalesController@screen_1_3");
Route::get("report/sales/1/5","Report\SalesController@screen_1_5");
Route::get("report/sales/1/12","Report\SalesController@screen_1_12");
Route::get("report/sales/1/15","Report\SalesController@screen_1_15");
Route::get("report/sales/1/16","Report\SalesController@screen_1_16");
Route::get("report/sales/1/18","Report\SalesController@screen_1_18");
Route::get("report/sales/1/19","Report\SalesController@screen_1_19");
Route::get("report/sales/1/21","Report\SalesController@screen_1_21");

//REPORT SALES : 2/x
Route::get("report/sales/2/3","Report\SalesController@screen_2_3");

//REPORT SALES : 3/x
Route::get("report/sales/3/11","Report\SalesController@screen_3_11");
Route::get("report/sales/3/17","Report\SalesController@screen_3_17");
Route::get("report/sales/3/21","Report\SalesController@screen_3_21");
Route::get("report/sales/3/26","Report\SalesController@screen_3_26");

//REPORT SALES : 4/x
Route::get("report/sales/4/1","Report\SalesController@screen_4_1");

//REPORT SALES : 5/x
Route::get("report/sales/5/x","Report\SalesController@screen_5_x");

//REPORT SALES : 6/x
Route::get("report/sales/6/4","Report\SalesController@screen_6_4");
Route::get("report/sales/6/5","Report\SalesController@screen_6_5");
Route::get("report/sales/6/6","Report\SalesController@screen_6_6");

//REPORT PURCHASE : 1/x
Route::get("report/purchase/1/4","Report\PurchaseController@screen_1_4");
Route::get("report/purchase/1/6","Report\PurchaseController@screen_1_6");
Route::get("report/purchase/1/8","Report\PurchaseController@screen_1_8");
Route::get("report/purchase/1/9","Report\PurchaseController@screen_1_9");

//REPORT PURCHASE : 2/x
Route::get("report/purchase/2/2","Report\PurchaseController@screen_2_2");
Route::get("report/purchase/2/3","Report\PurchaseController@screen_2_3");

//REPORT PURCHASE : 3/x
Route::get("report/purchase/3/2","Report\PurchaseController@screen_3_2");
Route::get("report/purchase/3/3","Report\PurchaseController@screen_3_3");
Route::get("report/purchase/3/5","Report\PurchaseController@screen_3_5");

//REPORT PURCHASE : 4/x
Route::get("report/purchase/4/1","Report\PurchaseController@screen_4_1");

//REPORT PURCHASE : 5/x
Route::get("report/purchase/5/3","Report\PurchaseController@screen_5_3");

//REPORT INVENTORY : 1/x
Route::get("report/inventory/1/1","Report\InventoryController@screen_1_1");

//REPORT INVENTORY : 2/x
Route::get("report/inventory/2/1","Report\InventoryController@screen_2_1");
Route::get("report/inventory/2/6","Report\InventoryController@screen_2_6");
Route::get("report/inventory/2/9","Report\InventoryController@screen_2_9");

//REPORT INVENTORY : 3/x
Route::get("report/inventory/3/2","Report\InventoryController@screen_3_2");
Route::get("report/inventory/3/6","Report\InventoryController@screen_3_6");
Route::get("report/inventory/3/13","Report\InventoryController@screen_3_13");

//REPORT INVENTORY : 4/x
Route::get("report/inventory/4/4","Report\InventoryController@screen_4_4");

//REPORT INDEX
Route::get('report/',function(){
  return view('report/index');
});

Route::resource('gaurd-stock', 'GaurdStockController');
Route::resource('gaurd-stock', 'GaurdStockController');
Route::resource('customer-debt', 'CustomerDebtController');
Route::resource('customer-debt', 'CustomerDebtController');
Route::resource('supplier-debt', 'SupplierDebtController');
Route::resource('bank-account', 'BankAccountController');
Route::resource('bank-transaction', 'BankTransactionController');