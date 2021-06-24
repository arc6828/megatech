<?php

namespace App\Http\Controllers\Sales;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\Functions;
use App\GaurdStock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionModel;
use App\SalesStatusModel;
use App\Sales\InvoiceModel;
// use App\Sales\OrderDetail2Model;
use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;
use App\Sales\PickingDetail;
use App\Sales\QuotationModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Storage;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $select_all = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_order.staff_id', '=', 'users.id')
      ->get();

    $select_all_user_id = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_order.staff_id', '=', 'users.id')
      ->where('tb_order.user_id', '=', Auth::user()->id)
      ->get();
    //$table_order = OrderModel::select_by_keyword($q);

    $table_order = (Auth::user()->role === "admin") ?
      $select_all : $select_all_user_id; // if

    $data = [
      //QUOTATION
      'table_order' => $table_order,
    ];
    return view('sales/order/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    //รับค่า quotation_code
    $quotation_code = $request->input('quotation_code');

    if (!empty($quotation_code)) {
      $tb_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'users.id', '=', 'tb_quotation.user_id')
        ->where('tb_quotation.quotation_code', '=', $quotation_code)
        ->select(DB::raw('users.*,tb_customer.*, tb_quotation.*,tb_sales_status.*'))
        ->get();
      // $tb_quotation = QuotationModel::select_by_id($quotation_code); // ยกเลิกการใช้งาน
      $customer_code = (count($tb_quotation) > 0) ? $tb_quotation[0]->customer_code : "";
    } else {
      $customer_code = "";
    }
    $data = [
      //QUOTATION
      'table_customer' => CustomerModel::all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::select_by_category('order'),
      //'table_sales_user' => UserModel::select_by_role('sales'),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'customer_code' => $customer_code,
      //QUOTATION DETAIL
      'table_order_detail' => [],
      'table_product' => ProductModel::all(),
    ];
    return view('sales/order/create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $input = $request->all();
    $input['order_code'] = $this->getNewCode();
    $input['datetime'] = date('Y-m-d H:i:s');
    $input['sales_status_id'] = 6;

    if (!empty($request->input('datetime_custom'))) {
      $input['datetime'] = $request->input('datetime_custom');
    }

    $order = OrderModel::create($input);
    $id = $order->order_id;

    //UPLOAD FILE P/O
    if ($request->hasFile('po_file')) {
      $folder = "customer/po";

      $requestData['po_file'] = $request->file('po_file')->store($folder, 'public');
      $order = OrderModel::findOrFail($id);
      $order->update($requestData);
    }

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        $order_detail = [
          'order_detail_status_id' => 0, // draft
          'before_approved_amount' => 0,
          'approved_amount' => 0,
          'iv_amount' => 0,
          'product_id' => $request->input('product_id_edit')[$i],
          'amount' => $request->input('amount_edit')[$i],
          'quotation_code' => $request->input('quotation_code_edit')[$i],
          'discount_price' => $request->input('discount_price_edit')[$i],
          'order_id' => $id,
          'delivery_duration' => $request->input('delivery_duration')[$i],

        ];
        OrderDetailModel::create($order_detail);

        //UPDATE QUOTATION sales_status_id = 5 which mean complete
        QuotationModel::where('quotation_code', $request->input('quotation_code_edit')[$i])
          ->update(['sales_status_id' => 5]);
      }
    }

    return redirect("sales/order/{$id}");
  }

  public function getNewCode()
  {
    $number = OrderModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->where('sales_status_id', '!=', '-1')
      ->count();
    $run_number = Numberun::where('id', '3')->value('number_en');

    $count = $number + 1;
    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $order_code = "{$run_number}{$year}{$month}-{$number}";
    return $order_code;
  }
  // getNewCodeCustom อาจจะยกเลิก
  // public function getNewCodeCustom($dateString)
  // {
  //     $number = OrderModel::select_count_by_current_month_custom($dateString);
  //     $count = $number + 1;
  //     //$year = (date("Y") + 543) % 100;
  //     $date = date_create($dateString);
  //     //echo date_format($date,"Y/m/d H:i:s");

  //     $year = date_format($date, "y");
  //     $month = date_format($date, "m");
  //     $number = sprintf('%05d', $count);
  //     $order_code = "M-OE{$year}{$month}-{$number}";
  //     return $order_code;
  // }

  public function store2(Request $request, $code)
  {
    //INSERT QUOTATION
    $input = [
      'purchase_requisition_code' => $this->getNewCode2(),
      'external_reference_id' => $request->input('external_reference_id'),
      'internal_reference_id' => $code,
      'customer_id' => $request->input('customer_id'),
      'debt_duration' => $request->input('debt_duration'),
      'billing_duration' => $request->input('billing_duration'),
      'payment_condition' => $request->input('payment_condition', ""),
      'delivery_type_id' => $request->input('delivery_type_id'),
      'tax_type_id' => $request->input('tax_type_id'),
      'delivery_time' => date("Y-m-d"),
      'department_id' => $request->input('department_id'),
      'purchase_status_id' => $request->input('purchase_status_id', 1),
      'user_id' => $request->input('user_id'),
      'zone_id' => $request->input('zone_id'),
      'remark' => $request->input('remark'),
      'vat' => $request->input('vat'),
      'vat_percent' => $request->input('vat_percent', 7),
      'total' => $request->input('total', 0),
    ];
    $id = RequisitionModel::insert($input);

    //INSERT ALL NEW QUOTATION DETAIL
    $list = [];
    //print_r($request->input('product_id_edit'));
    //print_r($request->input('amount_edit'));
    //print_r($request->input('discount_price_edit'));
    //echo $id;
    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        //HAVE X
        $product = ProductModel::findOrFail($request->input('product_id_edit')[$i]);

        $hasX = strtolower(substr($product->product_code, -1)) == "x";
        //$checkOthers = true;
        //จำนวนที่ต้องสั่ง = ค้างส่ง - (สต๊อก + ค้างรับ)
        //100   -  (500 + 0) = -400 เงื่อนไข OE ก่อน PR
        //100   -  (50 + 0) = 50 เงื่อนไข OE ก่อน PR
        //100   -  (100 + 0) = 0  เงื่อนไข OE ก่อน PR
        //-------------------------------------------------
        //0   -  (0 + 0) = 0 เงื่อนไข PR ก่อน OE
        //0   -  (0 + 100) = -100 เงื่อนไข PR ก่อน OE
        //100   -  (0 + 100) = 0 เงื่อนไข PR ก่อน OE
        //0   -  (100 + 0) = -100 เงื่อนไข PR ก่อน OE
        //100   -  (100 + 0) = 0 เงื่อนไข PR ก่อน OE
        //$amount_order = $product->pending_out - ($product->amount_in_stock + $product->pending_in);
        //ค้างส่งของ OE นี้เท่านั้น
        $amount_order = $request->input('amount_edit')[$i] - ($product->amount_in_stock + $product->pending_in);
        //ALWAYS PR
        $hasX = true;
        if ($hasX) {
          $list[] = [
            "product_id" => $request->input('product_id_edit')[$i],
            "amount" => $request->input('amount_edit')[$i],
            "discount_price" => $request->input('discount_price_edit')[$i],
            "purchase_requisition_id" => $id,
          ];
        } else if ($amount_order > 0) {
          $list[] = [
            "product_id" => $request->input('product_id_edit')[$i],
            "amount" => $amount_order,
            "discount_price" => $request->input('discount_price_edit')[$i],
            "purchase_requisition_id" => $id,
          ];
        }
      }
    }
    //print_r($list);
    RequisitionDetailModel::insert($list);

    //IF NO ITEM DELETE PR BY id
    if (count($list) == 0) {
      RequisitionModel::destroy($id);
    }

    //return redirect("purchase/purchase_requisition/{$id}/edit");
  }

  public function getNewCode2()
  {
    $number = RequisitionModel::select_count_by_current_month();
    $run_number = Numberun::where('id', '6')->value('number_en');
    $count = $number + 1;
    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $purchase_requisition_code = "{$run_number}{$year}{$month}-{$number}";
    return $purchase_requisition_code;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //CREATE DICT OF CHANGABLE ITEMS
    $current_oe = OrderModel::findOrFail($id);
    $current_pickings = $current_oe->order_details()->whereIn('order_detail_status_id', [4])->orderBy('order_detail_status_id', 'desc')->get();
    $unchangable_items = [];
    for ($i = 0; $i < count($current_pickings); $i++) {
      if (isset($unchangable_items[$current_pickings[$i]->product->product_code])) {
        $unchangable_items[$current_pickings[$i]->product->product_code] += $current_pickings[$i]->amount;
      } else {
        $unchangable_items[$current_pickings[$i]->product->product_code] = $current_pickings[$i]->amount;
      }
    }
  

    $table_order = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('users', 'users.id', '=', 'tb_order.staff_id')
      ->where('tb_order.order_id', '=', $id)
      ->orWhere('tb_order.order_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_order.*'))
      ->get();

    $table_order_detail = OrderDetailModel::join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
      ->where('order_id', '=', $id)
      ->get();

    $data = [
      //QUOTATION
      'table_order' => $table_order,
      'order' => OrderModel::findOrFail($id),
      'unchangable_items' => $unchangable_items,
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::select_by_category('order'),
      //'table_sales_user' => UserModel::select_by_role('sales'),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'order_id' => $id,
      //QUOTATION Detail
      'table_order_detail' => $table_order_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'show',
    ];
    return view('sales/order/edit', $data);
  }

  public function pdf($id)
  {
    $table_order = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('users', 'users.id', '=', 'tb_order.staff_id')
      ->where('tb_order.order_id', '=', $id)
      ->orWhere('tb_order.order_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_order.*'))
      ->get();

    $table_order_detail = OrderDetailModel::join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
      ->where('order_id', '=', $id)
      ->get();

    $data = [
      //QUOTATION
      'table_order' => $table_order,
      'order' => OrderModel::findOrFail($id),
      'table_company' => Company::all(),
      //QUOTATION Detail
      'table_order_detail' => $table_order_detail,
      'total_text' => count($table_order) > 0 ? Functions::baht_text($table_order[0]->total) : "-",
    ];
    //return view('sales/order/edit',$data);

    $pdf = PDF::loadView('sales/order/show', $data);
    return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
    //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //CREATE DICT OF CHANGABLE ITEMS
    $current_oe = OrderModel::findOrFail($id);
    $current_pickings = $current_oe->order_details()->whereIn('order_detail_status_id', [4])->orderBy('order_detail_status_id', 'desc')->get();
    $unchangable_items = [];
    for ($i = 0; $i < count($current_pickings); $i++) {
      if (isset($unchangable_items[$current_pickings[$i]->product->product_code])) {
        $unchangable_items[$current_pickings[$i]->product->product_code] += $current_pickings[$i]->amount;
      } else {
        $unchangable_items[$current_pickings[$i]->product->product_code] = $current_pickings[$i]->amount;
      }
    }
    $table_order = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('users', 'users.id', '=', 'tb_order.staff_id')
      ->where('tb_order.order_id', '=', $id)
      ->orWhere('tb_order.order_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_order.*'))
      ->get();
    $table_order_detail = OrderDetailModel::join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
      ->where('order_id', '=', $id)
      ->get();
    $data = [
      //QUOTATION
      'table_order' => $table_order,
      'order' => $current_oe,
      'unchangable_items' => $unchangable_items,
      'table_customer' => CustomerModel::get(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::select_by_category('order'),
      'table_sales_user' => UserModel::get(),
      'table_zone' => ZoneModel::all(),
      'order_id' => $id,
      //QUOTATION Detail
      'table_order_detail' => $table_order_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'edit',
    ];
    return view('sales/order/edit', $data);
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
    //1.ดึงข้อมูลจาก ฟอร์ม order

    $input = [
      // 'order_code' => $order->order_code,
      // 'datetime' => date('Y-m-d H:i:s'),
      'external_reference_id' => $request->input('external_reference_id'),
      'customer_id' => $request->input('customer_id'),
      'debt_duration' => $request->input('debt_duration'),
      'billing_duration' => $request->input('billing_duration'),
      'payment_condition' => $request->input('payment_condition', ""),
      'delivery_type_id' => $request->input('delivery_type_id'),
      'tax_type_id' => $request->input('tax_type_id'),
      'delivery_time' => $request->input('delivery_time'),
      'department_id' => $request->input('department_id'),
      'sales_status_id' => $request->input('sales_status_id'),
      'user_id' => $request->input('user_id'),
      'staff_id' => $request->input('staff_id'),
      'zone_id' => $request->input('zone_id'),
      'remark' => $request->input('remark'),
      'vat' => $request->input('vat'),
      'total_before_vat' => $request->input('total_before_vat', 0),
      'vat_percent' => $request->input('vat_percent', 7),
      'total' => $request->input('total_after_vat', 0),
      'max_credit' => $request->input('max_credit'),
      'total_debt' => $request->input('total_debt'),
    ];

    //UPLOAD FILE P/O
    if ($request->hasFile('po_file')) {
      $folder = "customer/po";

      $requestData['po_file'] = $request->file('po_file')->store($folder, 'public');
      //$requestData['po_file'] = "sss.jpg";
      $order = OrderModel::findOrFail($id);
      $order->update($requestData);
    }

    //2.INSERT UPDATE DELETE ORDER DETAIL
    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        //2.Clear order_detail
        OrderDetailModel::where('order_id', $id)->delete();
        //3.Insert order_detail foreach
        $order_detail = [
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "order_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ];
        //4.Create order_detail
        OrderDetailModel::create($order_detail);
      }
    }
    //5.Update order

    OrderModel::where('order_id', $id)
      ->orWhere('order_code', $id)
      ->update($input);

    return redirect("sales/order/{$id}");
  }
  public function approve(Request $request, $id)
  {
    //1.ดึงข้อมูล OE จาก Form
    $order = OrderModel::findOrFail($id);

    //2.อัพเดทสถานะ ** รอเบิกของ**
    $input = [
      'order_code' => $order->order_code,
      'datetime' => date('Y-m-d H:i:s'),
      'sales_status_id' => 7,
    ];

    OrderModel::where('order_id', $id)
      ->orWhere('order_code', $id)
      ->update($input);

    //3.ดึงข้อมูลจาก order_detail
    $order_detail = OrderDetailModel::where('order_id', $id)->get();

    foreach ($order_detail as $item) {
      $input_detail = [
        "before_approved_amount" => $item->amount,
        "approved_amount" => 0,
        "iv_amount" => 0,
        "order_detail_status_id" => 3,
      ];
      //4. Update status_id_detail
      OrderDetailModel::where('order_detail_id', $item->order_detail_id)->update($input_detail);
      // PickingDetail::where('order_id')

      //5.Create Gurd Stock

      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $order->order_code,
        "type" => "sales_order",
        "amount" => $item['amount'],
        "amount_in_stock" => $product->amount_in_stock,
        "pending_in" => $product->pending_in,
        "pending_out" => ($product->pending_out + $item['amount']),
        "product_id" => $product->product_id,
      ]);
      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
      //create PickingDetail
      $pickking_detail = PickingDetail::create([
        "product_id" => $product->product_id,
        "amount" => $item['amount'],
        "before_approved_amount" => $item->amount,
        "approved_amount" => 0,
        "iv_amount" => 0,
        "discount_price" => $item->discount_price,
        "order_code" => $order->order_code,
        "order_id" => $item->order_id,
        "order_detail_id" => $item->order_detail_id,
        "order_detail_status_id" => 3,
      ]);
      $pickking_detail->save();
    }

    // store 2

    return redirect("sales/order/{$id}")->with('flash_message', 'popup');
  }
  // public function duplicate($id)
  // {
  //     $order = OrderModel::findOrFail($id);
  //     $order_details = $order->order_details()->get();

  //     $picking = $order_details->replicate()->fill([
  //         'order_code' => $order->order,
  //         // 'datetime' => "",
  //         // 'revision' => "0",
  //         // 'sales_status_id' => "0",
  //     ]);
  //     $picking->save();

  //     //Clone Detail
  //     foreach ($order_details as $item) {
  //         $new_item = $item->replicate()->fill([
  //             'order_code' => $picking->order_code,
  //         ]);
  //         $new_item->save();
  //     }
  // }

  public function revision(Request $request, $id)
  {
    // $order_code = $this->getNewCode();
    $datetime = date('Y-m-d H:i:s');

    if (!empty($request->input('datetime_custom'))) {
      $datetime = $request->input('datetime_custom');
      // $code = $this->getNewCodeCustom($datetime);
    }

    $input = [
      'order_code' => $request->input('order_code'),
      'datetime' => $datetime,
      'external_reference_id' => $request->input('external_reference_id'),
      'customer_id' => $request->input('customer_id'),
      'debt_duration' => $request->input('debt_duration'),
      'billing_duration' => $request->input('billing_duration'),
      'payment_condition' => $request->input('payment_condition', ""),
      'delivery_type_id' => $request->input('delivery_type_id'),
      'tax_type_id' => $request->input('tax_type_id'),
      'delivery_time' => date("Y-m-d"),
      'department_id' => $request->input('department_id'),
      'sales_status_id' => $request->input('sales_status_id'),
      'user_id' => $request->input('user_id'),
      'staff_id' => $request->input('staff_id'),
      'zone_id' => $request->input('zone_id'),
      'remark' => $request->input('remark'),
      'vat_percent' => $request->input('vat_percent', 7),
      'vat' => $request->input('vat', 0),
      'total_before_vat' => $request->input('total_before_vat', 0),
      'total' => $request->input('total_after_vat', 0),
      'max_credit' => $request->input('max_credit'),
      'total_debt' => $request->input('total_debt'),
    ];

    if (!empty($request->input('order_code'))) {
      //REVISION + VOID THE OLD ONE
      $q = OrderModel::where('order_code', $request->input('order_code'))
        ->orderBy('datetime', 'desc')->first();
      $input['revision'] = $q->revision + 1;
      $input['po_file'] = $q->po_file;
      $q->sales_status_id = -1; //-1 means void
      $q->save();
      //NEW CODE WITH Rx
      $segments = explode("-", $request->input('order_code'));
      $segmentend = end($segments); //"00001"

      if ($segmentend[0] != "R") {
        array_push($segments, "R"); // เพิ่ม R
        $order_code = join("-", $segments);
        $input['order_code'] = "{$order_code}{$input['revision']}";
      } else {
        array_pop($segments); // ลบ string
        array_push($segments, "R"); // เพิ่ม R
        $order_code = join("-", $segments);
        $input['order_code'] = "{$order_code}{$input['revision']}"; // string
      }
      //ROLLBACK STOCK STATS IN PRODUCT AND GAURD STOCK
      //CREATE GAURD STOCK + UPDATE PRODUCT
      foreach ($q->order_details as $item) {
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $item->order_code,
          "type" => "sales_order",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock),
          "pending_in" => ($product->pending_in),
          "pending_out" => ($product->pending_out - $item['amount']),
          "product_id" => $product->product_id,
        ]);

        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();
      }
    }
    //CREATE
    $order = OrderModel::create($input);
    $id = $order->order_id;

    if ($request->hasFile('po_file')) {
      $folder = "customer/po";

      $requestData['po_file'] = $request->file('po_file')->store($folder, 'public');
      //$requestData['po_file'] = "sss.jpg";
      $order = OrderModel::findOrFail($id);
      $order->update($requestData);
    }
    if (is_array($request->input('product_id_edit'))) {

      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        $order_detail = [
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "order_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ];
        OrderDetailModel::create($order_detail);
      }
    }
    OrderModel::where('order_id', $id)
      ->orWhere('order_code', $id)
      ->update($input);

    // if (empty($request->input('order_code'))) {
    //     // //CASE CREATE
    //     // OrderDetailModel::insert($list);
    // } else {
    //     //OE ต้องน้อยกว่าเดิม + ต้องไม่น้อยกว่า IV + ห้ามเพิ่มรายการ
    //     //CASE REVISION
    //     //QUERY order from order_code
    //     $q = OrderModel::where('order_code', $request->input('order_code'))
    //         ->orderBy('datetime', 'desc')->first();
    //     //UPDATE DEATAIL
    //     $q->pickings()->update(["order_id" => $id]);

    //     $order = OrderModel::find($id);
    //     //UPDATE INVOICE REFERENCE order_code
    //     InvoiceModel::where('internal_reference_id', $request->input('order_code'))
    //         ->update(["internal_reference_id" => $order->order_code]);

    //     //UPDATE OrderDetail order_id

    //     //OE ล่าสุด
    //     $current_oe = OrderModel::find($id);
    //     $current_oe_details = $current_oe->order_details;

    //     //OE ก่อนหน้า
    //     $previous_oe = OrderModel::where('order_code', $request->input('order_code'))->first();
    //     $previous_oe_details = $previous_oe->order_details;
    //     //DIFFs
    //     $diffs = [];
    //     for ($i = 0; $i < count($current_oe_details); $i++) {
    //         $diffs[$current_oe_details[$i]->product->product_code] = ($current_oe_details[$i]->amount - $previous_oe_details[$i]->amount);
    //     }
    //     print_r($diffs);
    //     //ขออนุญาติใหม่อีกครั้ง??
    //     //$current_oe->pickings()->whereIn('order_detail_status_id',[1,3])->update([order_detail_status_id""=>1]);
    //     $current_pickings = $current_oe->pickings()->whereIn('order_detail_status_id', [1, 3])->orderBy('order_detail_status_id', 'desc')->get();
    //     foreach ($current_pickings as $item) {
    //         if ($item->amount + $diffs[$item->product->product_code] >= 0) {
    //             //FINISH IN ONE ORDER
    //             $new_amount = $item->amount + $diffs[$item->product->product_code];
    //             $diffs[$item->product->product_code] += $item->amount;
    //             $item->update(['amount' => $new_amount]);
    //             //UPDATE DIFF, WHERE DIFF NEVER MORE THAN 0 (CLEAR DIFF)
    //             echo "<br>Before if " . $diffs[$item->product->product_code];
    //             if ($diffs[$item->product->product_code] > 0) {
    //                 $diffs[$item->product->product_code] = 0;
    //             }

    //             echo "<br>After if " . $diffs[$item->product->product_code];
    //         } else {
    //             //FINISH WITH SERVERAL ORDERS
    //             $new_amount = $item->amount - $item->amount;
    //             $diffs[$item->product->product_code] += $item->amount;
    //             $item->update(['amount' => $new_amount]);

    //             echo "<br>Else : " . $diffs[$item->product->product_code];
    //         }
    //     }

    // }

    return redirect("sales/order/{$id}");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    OrderModel::destroy($id);
    return redirect("sales/order");
  }
}
