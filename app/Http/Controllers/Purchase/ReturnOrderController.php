<?php

namespace App\Http\Controllers\Purchase;

use App\GaurdStock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\Purchase\OrderDetailModel;
use App\Purchase\ReceiveDetailModel;
use App\Purchase\ReceiveModel;
use App\Purchase\ReturnOrder;
use App\Purchase\ReturnOrderDetail;
use App\SupplierModel;
use Illuminate\Http\Request;
use PDF;

class ReturnOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    $keyword = $request->get('search');
    $perPage = 25;
    $returnorder = ReturnOrder::latest()->get();

    return view('purchase.return-order.index', compact('returnorder'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\View\View
   */
  public function create(Request $request)
  {
    $keyword = $request->get('search');
    $returnorder = ReceiveModel::firstOrNew(['purchase_receive_code' => $keyword]);
    $returnorder->total_before_vat = 0;
    $returnorder->total_after_vat = 0;
    $returnorder->vat = 0;
    $returnorderdetail = isset($returnorder) ? $returnorder->purchase_receive_details()->get() : [];

    return view('purchase.return-order.create', compact('returnorder', 'returnorderdetail'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(Request $request)
  {
    //CREATE RETURN INVOICE
    $requestData = $request->all();
    $requestData["code"] = $this->getNewCode();
    $requestData["revision"] = 0;

    $products = $request->input('product_ids');
    $amounts = $request->input('amounts');
    $discount_prices = $request->input('discount_prices');
    $totals = $request->input('totals');

    $returnorder = ReturnOrder::create($requestData);

    if (is_array($products)) {
      for ($i = 0; $i < count($products); $i++) {
        ReturnOrderDetail::create([
          "product_id" => $products[$i],
          "amount" => $amounts[$i],
          "discount_price" => $discount_prices[$i],
          "total" => $totals[$i],
          "return_order_id" => $returnorder->id,
        ]);
      }
    }
    $return_details = $returnorder->return_order_details()->get();

    foreach ($return_details as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $returnorder->code,
        "type" => "purchase_return_order",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
        "pending_in" => $product->pending_in,
        "pending_out" => ($product->pending_out),
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }

    return redirect('purchase/return-order/' . $returnorder->id)->with('flash_message', 'ReturnOrder added!');
  }

  public function getNewCode()
  {
    $number = ReturnOrder::where('purchase_status_id', '!=', '-1')
      ->whereMonth('created_at', date("m"))
      ->whereYear('created_at', date("Y"))
      ->count();
    $count = $number + 1;
    $run_number = Numberun::where('id', '9')->value('number_en');

    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $code = "{$run_number}{$year}{$month}-{$number}";
    return $code;
  }
  public function cancel($id)
  {
    //
    $returnorder = ReturnOrder::findOrFail($id);
    //VOID
    $returnorder->purchase_status_id = -1; //-1 MEANS Void
    $returnorder->vat = 0;
    $returnorder->total_after_vat = 0;
    $returnorder->total_before_vat = 0;
    // $returnorder->total = 0;

    $returnorder->save();

    //FIND RC
    $receive = ReceiveModel::where('purchase_receive_code', $returnorder->purchase_receive_code)->firstOrFail();
    //RE STATUS RC
    if ($receive->purchase_status_id == 4) { //4 : ปิดการซื้อเรียบร้อย
      $receive->update(["purchase_status_id" => "3"]); //3 : รอรับสินค้า
    }

    $list = $returnorder->return_order_details()->get();

    //GAURD STOCK - CHECK
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $returnorder->code,
        "type" => "purchase_return_order_cancel",
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

    return redirect("purchase/return-order/{$id}/edit");
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\View\View
   */
  public function show($id)
  {
    $returnorder = ReturnOrder::findOrFail($id);
    $returnorderdetail = $returnorder->return_order_details()->get();
    $mode = "show";

    return view('purchase.return-order.edit', compact('returnorder', 'returnorderdetail', 'mode'));
  }
  public function pdf($id)
  {
    $table_return_order = ReturnOrder::join('tb_supplier', 'return_orders.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('return_orders.id', '=', $id)
      ->get();
    $table_return_order_details = ReturnOrderDetail::join('tb_product', 'return_order_details.product_id', '=', 'tb_product.product_id')
      ->get();
    $data = [
      'table_return_order' => $table_return_order,
      'table_return_order_details' => ReturnOrderDetail::$$table_return_order_details,
      'table_company' => Company::select_all(),
    ];
    $pdf = PDF::loadView('purchase/return-order/show', $data);
    return $pdf->stream('test.pdf');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\View\View
   */
  public function edit($id)
  {
    $returnorder = ReturnOrder::findOrFail($id);
    $returnorderdetail = $returnorder->return_order_details()->get();
    $mode = "edit";

    return view('purchase.return-order.edit', compact('returnorder', 'returnorderdetail', 'mode'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function update(Request $request, $id)
  {

    $requestData = $request->all();
    $returnorder = ReturnOrder::findOrFail($id);

    $products = $request->input('product_ids');


    if (is_array($products)) {
      for ($i = 0; $i < count($products); $i++) {

        $new_return_details = [
          "amount" =>  $request->input('amounts')[$i],
        ];

        $return_details = ReturnOrderDetail::findOrFail($request->input('return_order_detail_id_edits')[$i]);
        $return_details->update($new_return_details);
      }
    }
    //LOAD OLD DATA

    //ROLLBACK Gaurd stock
    $return_details = $returnorder->return_order_details()->get();

    foreach ($return_details as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $returnorder->code,
        "type" => "purchase_return_order_cancel",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
        "pending_in" => $product->pending_in,
        "pending_out" => ($product->pending_out),
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }
    $returnorder = ReturnOrder::findOrFail($id);
    $returnorder->update($requestData);

    return redirect("purchase/return-order/{$id}/edit")->with('flash_message', 'ReturnOrder updated!');
  }

  // public function revision(Request $request, $id)
  // {
  //   $revision = $returnorder->revision + 1;
  //   $segments = explode("-", $returnorder->code);
  //   $code = $segments[0] . "-" . $segments[1] . "-R" . $revision;
  //   // $returnorder->update($requestData);
  //   $new_returnorder->update([
  //     'created_at' => date("Y-m-d h:i:s"),
  //     'updated_at' => date("Y-m-d h:i:s"),
  //     'code' => $code,
  //     'revision' => $revision,
  //   ]);
  // }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function destroy($id)
  {
    ReturnOrder::destroy($id);

    return redirect('purchase/return-order')->with('flash_message', 'ReturnOrder deleted!');
  }
}
