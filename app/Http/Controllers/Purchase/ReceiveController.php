<?php

namespace App\Http\Controllers\Purchase;

use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\GaurdStock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\PurchaseStatusModel;
use App\Purchase\OrderDetailModel;
use App\Purchase\OrderModel;
use App\Purchase\ReceiveDetailModel;
use App\Purchase\ReceiveModel;
use App\SupplierModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReceiveController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    //$table_purchase_receive = ReceiveModel::select_by_keyword($q);
    $table_purchase_receive = ReceiveModel::join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
      ->get();
    $data = [
      //QUOTATION
      'table_purchase_receive' => $table_purchase_receive,
      'q' => $request->input('q'),
    ];
    return view('purchase/receive/index', $data);
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
      //'table_purchase_user' => UserModel::select_by_role('purchase_receive'),
      'table_purchase_user' => UserModel::all(),
      //'table_purchase_receive_user' => UserModel::select_all(),
      'table_zone' => ZoneModel::select_all(),
      //QUOTATION DETAIL
      'table_purchase_receive_detail' => [],
      'table_product' => ProductModel::select_all(),
    ];
    return view('purchase/receive/create', $data);
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
    $purchase_receive_code = $this->getNewCode();

    $input['purchase_receive_code'] = $purchase_receive_code;
    $input['datetime'] = date('Y-m-d H:i:s');
    $input['purchase_status_id'] = 4;
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total_before_vat'] = $request->input('total_before_vat', 0);
    $input['total'] = $request->input('total_after_vat', 0);
    $input['total_debt'] = $request->input('total_after_vat', 0);

    //UPLOAD
    $receive = ReceiveModel::create($input);
    $id = $receive->purchase_receive_id;

    //UPLOAD FILE P/O
    $receive = ReceiveModel::findOrFail($id);
    if ($request->hasFile('file')) {
      $folder = "supplier/iv";

      $requestData['file'] = $request->file('file')->store($folder, 'public');
      $requestData['external_reference_doc'] = $request->input('external_reference_doc');
      $receive->update($requestData);
    }

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        $receive_detail = [
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_receive_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "purchase_receive_id" => $id,
          "purchase_order_detail_id" => $request->input('purchase_order_detail_id_edit')[$i],
        ];
        ReceiveDetailModel::create($receive_detail);

        OrderDetailModel::where('purchase_order_detail_id', $request->input('id_edit')[$i])
          ->update(["purchase_order_detail_status_id" => 6]);
        OrderDetailModel::where('purchase_order_detail_id', $request->input('id_edit')[$i])->first()->decrement('amount_pending_in',  $request->input('amount_receive_edit')[$i]);
        OrderDetailModel::where('purchase_order_detail_id', $request->input('id_edit')[$i])->first()->increment('amount_pending_rc',  $request->input('amount_receive_edit')[$i]);
        
        $purchase_detail = OrderDetailModel::where('purchase_order_detail_id', $request->input('id_edit')[$i])->first();
        $purchase_order_id = $purchase_detail->purchase_order_id;
        OrderModel::where('purchase_order_id', $purchase_order_id)->update(["purchase_status_id" => 4]);
      
      }
    }

    $receive_detail = ReceiveDetailModel::where('purchase_receive_id', $id)->get();
    // GAURD STOCK
    foreach ($receive_detail as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $receive->purchase_receive_code,
        "type" => "purchase_receive",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
        "pending_in" => ($product->pending_in - $item['amount']),
        "pending_out" => ($product->pending_out),
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }

    return redirect("purchase/receive/{$id}");
  }

  public function getNewCode()
  {
    $number = ReceiveModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->count();
    $run_number = Numberun::where('id', '8')->value('number_en');
    $count = $number + 1;
    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $purchase_receive_code = "{$run_number}{$year}{$month}-{$number}";
    return $purchase_receive_code;
  }

  public function cancel($id)
  {
    //
    $purchase_receive = ReceiveModel::findOrFail($id);
    //VOID
    $purchase_receive->purchase_status_id = -1; //-1 MEANS Void
    $purchase_receive->vat = 0;
    $purchase_receive->total_debt = 0;
    $purchase_receive->total_before_vat = 0;
    $purchase_receive->total = 0;

    $purchase_receive->save();

    //FIND OE
    $order = OrderModel::where('purchase_order_code', $purchase_receive->internal_reference_doc)->firstOrFail();
    //RE STATUS OE
    if ($order->purchase_status_id == 4) { //4 : ปิดการซื้อเรียบร้อย
      $order->update(["purchase_status_id" => "3"]); //3 : รอรับสินค้า
    }

    $list = $purchase_receive->purchase_receive_details()->get();

    foreach ($list as $p) {
      //UPDATE AMOUNT_PENDING_IN
      $order_detail = OrderDetailModel::findOrFail($p->purchase_order_detail_id);
      $order_detail->increment('amount_pending_in', $p->amount);

      //UPDATE STATUS
      $order_detail->update(["purchase_order_detail_status_id" => "5"]); //6 รับสินค้าแล้ว -> 5 ออก PO แล้ว

      $p->discount_price = 0;
      $p->save();
    }

    //GAURD STOCK - CHECK
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $purchase_receive->purchase_receive_code,
        "type" => "purchase_receive_cancel",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
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

    return redirect("purchase/receive/{$id}/edit");
  }

  public function pdf($id)
  {
    //no show
    $table_purchase_receive = ReceiveModel::join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_receive.purchase_receive_id', '=', $id)
      ->select(DB::raw('tb_purchase_receive.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();
    $data = [
      //QUOTATION
      'table_purchase_receive' =>   $table_purchase_receive,
      'table_company' => Company::all(),
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_receive_id' => $id,
      //QUOTATION Detail
      'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
      'table_product' => ProductModel::select_all(),
    ];
    //return view('purchase/receive/edit',$data);

    $pdf = PDF::loadView('purchase/receive/show', $data);
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

    $table_purchase_receive = ReceiveModel::join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_receive.purchase_receive_id', '=', $id)
      ->select(DB::raw('tb_purchase_receive.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();

    $data = [
      //QUOTATION
      'table_purchase_receive' => $table_purchase_receive,
      'purchase_receive' => ReceiveModel::findOrFail($id),
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_receive_id' => $id,
      'mode' => 'show',
      //QUOTATION Detail
      'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
      'table_product' => ProductModel::select_all(),
    ];
    //echo $data["mode"];
    //exit();
    return view('purchase/receive/edit', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $table_purchase_receive = ReceiveModel::join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_receive.purchase_receive_id', '=', $id)
      ->select(DB::raw('tb_purchase_receive.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();

    $data = [
      //QUOTATION
      'table_purchase_receive' => $table_purchase_receive,
      'purchase_receive' => ReceiveModel::findOrFail($id),
      'table_supplier' => SupplierModel::all(),
      'table_delivery_type' => DeliveryTypeModel::select_all(),
      'table_department' => DepartmentModel::select_all(),
      'table_tax_type' => TaxTypeModel::select_all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::select_all(),
      'purchase_receive_id' => $id,
      'mode' => 'edit',
      //QUOTATION Detail
      'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
      'table_product' => ProductModel::select_all(),
    ];

    return view('purchase/receive/edit', $data);
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

    $input = $request->all();
    $input['datetime'] = date('Y-m-d H:i:s');
    $input['total'] = $request->input('total_after_vat', 0);
    $input['vat_percent'] = $request->input('vat_percent', 7);


    //UPLOAD FILE P/O
    $receive = ReceiveModel::findOrFail($id);

    if ($request->hasFile('file')) {
      $folder = "supplier/iv";
      $requestData['file'] = $request->file('file')->store($folder, 'public');
      $requestData['external_reference_doc'] = $request->input('external_reference_doc');
      //$requestData['file'] = "sss.jpg";
      $receive->update($requestData);
    }

    $input['external_reference_doc'] = $request->input('external_reference_doc');

    $receive = ReceiveModel::findOrFail($id);
    $receive->update($input);

    //4.REDIRECT
    return redirect("purchase/receive/{$id}/edit");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    ReceiveModel::destroy($id);
    return redirect("purchase/receive");
  }
}
