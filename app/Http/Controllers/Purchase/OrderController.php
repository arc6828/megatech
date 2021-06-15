<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\OrderModel;
use App\Purchase\OrderDetailModel;
use App\Purchase\OrderDetailStatusModel;
use App\Purchase\RequisitionDetailModel;

use App\SupplierModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\Purchase\ReceiveModel;



use App\GaurdStock;
use App\Models\Company;
use App\Models\Numberun;
use PDF;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    //$table_purchase_order = OrderModel::select_by_keyword($q);
    $data = [
      //QUOTATION
      'table_purchase_order' => OrderModel::select_all(),
      'q' => $request->input('q')
    ];
    return view('purchase/order/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      //QUOTATION
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_order'),
      //'table_purchase_user' => UserModel::select_by_role('purchase_order'),
      'table_purchase_user' => UserModel::all(),
      //'table_purchase_order_user' => UserModel::select_all(),
      'table_zone' => ZoneModel::select_all(),
      //QUOTATION DETAIL
      'table_purchase_order_detail' => [],
      'table_product' => ProductModel::select_all(),
    ];
    return view('purchase/order/create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //1.รับค่า request จาก index
    $input = $request->all();
    $purchase_order_code = $this->getNewCode();
    $input['datetime'] = date('Y-m-d H:i:s');
    
    if (!empty($request->input('datetime_custom'))) {
      $datetime = $request->input('datetime_custom');
      $purchase_order_code = $this->getNewCodeCustom($datetime);
    }

    $input['purchase_order_code'] = $purchase_order_code;
    $input['purchase_status_id'] = 3;
    $input['billing_duration'] = $request->input('billing_duration', "0");
    $input['payment_condition'] = $request->input('payment_condition', "0");
    $input['delivery_time'] = $request->input('delivery_time', "0");
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total_before_vat'] = $request->input('total_before_vat', 0);
    $input['total'] = $request->input('total_after_vat', 0);

    //create order
    $order = OrderModel::create($input);
    $id = $order->purchase_order_id;

    //update order_detail foreach
    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        //6.update order_detail

        $new_order_detail = [
          "amount_pending_in" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "purchase_order_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ];

        OrderDetailModel::whereNull('purchase_order_id')->update($new_order_detail);
        //Decreament supplier_amount RequisitionDetailModel
        RequisitionDetailModel::where('purchase_requisition_detail_id', $request->input('requisition_detail_id_edit')[$i])->first()->decrement('supplier_amount', $request->input('amount_edit')[$i]);
        //Increment po_amount  RequisitionDetailModel
        RequisitionDetailModel::where('purchase_requisition_detail_id', $request->input('requisition_detail_id_edit')[$i])->first()->increment('po_amount', $request->input('amount_edit')[$i]);
      }
    }

    $order_detail = OrderDetailModel::where('purchase_order_detail_id', $id)->get();

    foreach ($order_detail as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $order->purchase_order_code,
        "type" => "purchase_order",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock),
        "pending_in" => ($product->pending_in + $item['amount']),
        "pending_out" => ($product->pending_out),
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }



    return redirect("purchase/order/{$id}");
  }

  public function getNewCode()
  {
    $number = OrderModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->count();
    $run_number = Numberun::where('id', '7')->value('number_en');
    $count =  $number + 1;
    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $purchase_order_code = "{$run_number}{$year}{$month}-{$number}";
    return $purchase_order_code;
  }

  public function getNewCodeCustom($dateString)
  {
    $number = OrderModel::select_count_by_current_month_custom($dateString);
    $run_number = Numberun::where('id', '7')->value('number_en');
    $count =  $number + 1;
    //$year = (date("Y") + 543) % 100;
    $date = date_create($dateString);
    //echo date_format($date,"Y/m/d H:i:s");

    $year = date_format($date, "y");
    $month = date_format($date, "m");
    $number = sprintf('%05d', $count);
    $order_code = "{$run_number}{$year}{$month}-{$number}";
    return $order_code;
  }

  public function pdf($id)
  {
    //no show
    $data = [
      //QUOTATION
      'table_purchase_order' => OrderModel::select_by_id($id),
      'table_supplier' => SupplierModel::all(),
      'table_company' => Company::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_order'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_order_id' => $id,
      //QUOTATION Detail
      'table_purchase_order_detail' => OrderDetailModel::select_by_purchase_order_id($id),
      'table_product' => ProductModel::select_all(),
    ];
    //return view('purchase/order/edit',$data);


    $pdf = PDF::loadView('purchase/order/show', $data);
    return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
    //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //CREATE DICT OF UNCHANGABLE ITEMS
    $current_oe = OrderModel::findOrFail($id);
    $receives = $current_oe->receives()->where('purchase_status_id', '>', '0')->get();
    //
    // print_r($receives);
    // exit();
    $unchangable_items = [];
    foreach ($receives as $item) {
      $current_pickings = $item->purchase_receive_details;
      for ($i = 0; $i < count($current_pickings); $i++) {
        if (isset($unchangable_items[$current_pickings[$i]->Product->product_code])) {
          $unchangable_items[$current_pickings[$i]->Product->product_code] += $current_pickings[$i]->amount;
        } else {
          $unchangable_items[$current_pickings[$i]->Product->product_code] = $current_pickings[$i]->amount;
        }
      }
    }
    //print_r($unchangable_items);


    $data = [
      //QUOTATION
      'table_purchase_order' => OrderModel::select_by_id($id),
      'order' => $current_oe,
      'unchangable_items' => $unchangable_items,
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_order'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_order_id' => $id,
      'mode' => 'show',
      //QUOTATION Detail
      'table_purchase_order_detail' => OrderDetailModel::select_by_purchase_order_id($id),
      'table_product' => ProductModel::select_all(),
    ];
    return view('purchase/order/edit', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    //CREATE DICT OF UNCHANGABLE ITEMS
    $current_oe = OrderModel::findOrFail($id);
    $receives = $current_oe->receives()->where('purchase_status_id', '>', '0')->get();
    //
    // print_r($receives);
    // exit();
    $unchangable_items = [];
    foreach ($receives as $item) {
      $current_pickings = $item->purchase_receive_details;
      for ($i = 0; $i < count($current_pickings); $i++) {
        if (isset($unchangable_items[$current_pickings[$i]->Product->product_code])) {
          $unchangable_items[$current_pickings[$i]->Product->product_code] += $current_pickings[$i]->amount;
        } else {
          $unchangable_items[$current_pickings[$i]->Product->product_code] = $current_pickings[$i]->amount;
        }
      }
    }
    //print_r($unchangable_items);


    $data = [
      //QUOTATION
      'table_purchase_order' => OrderModel::select_by_id($id),
      'order' => $current_oe,
      'unchangable_items' => $unchangable_items,
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_order'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_order_id' => $id,
      'mode' => 'edit',
      //QUOTATION Detail
      'table_purchase_order_detail' => OrderDetailModel::select_by_purchase_order_id($id),
      'table_product' => ProductModel::select_all(),
    ];
    return view('purchase/order/edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //1.INSERT QUOTATION
    $input = $request->all();
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total'] = $request->input('total', 0);
    // $input = [
    //   //'purchase_order_code' => $purchase_order_code,
    //   'external_reference_doc' => $request->input('external_reference_doc'),
    //   'supplier_id' => $request->input('supplier_id'),
    //   'debt_duration' => $request->input('debt_duration'),
    //   'billing_duration' => $request->input('billing_duration'),
    //   'payment_condition' => $request->input('payment_condition', ""),
    //   'delivery_type_id' => $request->input('delivery_type_id'),
    //   'tax_type_id' => $request->input('tax_type_id'),
    //   'delivery_time' => $request->input('delivery_time'),
    //   'department_id' => $request->input('department_id'),
    //   'purchase_status_id' => $request->input('purchase_status_id'),
    //   'user_id' => $request->input('user_id'),
    //   'zone_id' => $request->input('zone_id'),
    //   'remark' => $request->input('remark'),
    //   'vat_percent' => $request->input('vat_percent', 7),
    //   'total' => $request->input('total', 0),
    // ];

    //2.INSERT UPDATE DELETE ORDER DETAIL
    if (is_array($request->input('product_id_edit'))) {

      OrderDetailModel::where('purchase_order_id', $id)->delete();
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        $order_detail = [
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "purchase_order_id" => $id,
          "purchase_order_detail_status_id" => 5, //5 : ออก PO แล้ว
          "requisition_detail_id" =>  $request->input('requisition_detail_id')[$i],
        ];
        OrderDetailModel::create($order_detail);
      }
    }
    //UPDATE PR Detail

    $purchase = OrderModel::findOrFail($id);
    $purchase->update($input);
    //4.REDIRECT
    return redirect("purchase/order/{$id}/edit");
  }
  // public function revision(Request $request)
  // {
  //   if (!empty($request->input('purchase_order_code'))) {
  //     //REVISION + VOID THE OLD ONE       
  //     $q = OrderModel::where('purchase_order_code', $request->input('purchase_order_code'))
  //       ->orderBy('datetime', 'desc')->first();
  //     $input['revision'] = $q->revision + 1;
  //     $q->purchase_status_id = -1; //-1 means void
  //     $q->save();
  //     //NEW CODE WITH Rx
  //     $segments = explode("-", $request->input('purchase_order_code'));
  //     $input['purchase_order_code'] = $segments[0] . "-" . $segments[1] . "-R" . $input['revision'];

  //     //UPDATE INVOICE REFERENCE order_code
  //     ReceiveModel::where('internal_reference_doc', $request->input('purchase_order_code'))
  //       ->update(["internal_reference_doc" => $input['purchase_order_code']]);

  //     //ROLLBACK STOCK STATS IN PRODUCT AND GAURD STOCK
  //     //CREATE GAURD STOCK + UPDATE PRODUCT      
  //     foreach ($q->order_details as $item) {
  //       $product = ProductModel::findOrFail($item['product_id']);
  //       $gaurd_stock = GaurdStock::create([
  //         "code" => $item['purchase_order_id'],
  //         "type" => "purchase_order",
  //         "amount" => $item['amount'],
  //         "amount_in_stock" => ($product->amount_in_stock),
  //         "pending_in" => ($product->pending_in - $item['amount']),
  //         "pending_out" => ($product->pending_out),
  //         "product_id" => $product->product_id,
  //       ]);

  //       //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
  //       $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
  //       $product->pending_in = $gaurd_stock['pending_in'];
  //       $product->pending_out = $gaurd_stock['pending_out'];
  //       $product->save();

  //       //DIVIDED REQUISITION DETAIL INTO 2 PARTS


  //     }
  //   }
  // }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    OrderModel::destroy($id);
    return redirect("purchase/order");
  }
}
