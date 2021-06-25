<?php

namespace App\Http\Controllers\Sales;

use App\Functions;
use App\GaurdStock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\Sales\InvoiceModel;
use App\Sales\ReturnInvoice;
use App\Sales\ReturnInvoiceDetail;
use App\Sales\unused\InvoiceDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReturnInvoiceController extends Controller
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
    $returninvoice = ReturnInvoice::latest()->get();

    return view('sales.return-invoice.index', compact('returninvoice'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\View\View
   */
  public function create(Request $request)
  {

    $keyword = $request->get('search');
    $returninvoice = InvoiceModel::firstOrNew(['invoice_code' => $keyword]); //1.ดึงข้อมูล invoice จาก invoice_code
    $returninvoice->total_before_vat = 0;
    $returninvoice->total_after_vat = 0;
    $returninvoice->vat = 0;
    //$returninvoice->sales_status_id = 0;
    $returninvoicedetail = isset($returninvoice) ? $returninvoice->invoice_details()->get() : [];

    return view('sales.return-invoice.create', compact('returninvoice', 'returninvoicedetail'));
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
    $requestData["code"] = $this->getNewCode(); //Gen new code
    $requestData["revision"] = 0;

    $products = $request->input('product_ids');
    $amounts = $request->input('amounts');
    $discount_prices = $request->input('discount_prices');
    $totals = $request->input('totals');

    $returninvoice = ReturnInvoice::create($requestData); //Create return invoice

    if (is_array($products)) {
      for ($i = 0; $i < count($products); $i++) {
        ReturnInvoiceDetail::create([ //Insert invoice detail foreach
          "product_id" => $products[$i],
          "amount" => $amounts[$i],
          "discount_price" => $discount_prices[$i],
          "total" => $totals[$i],
          "return_invoice_id" => $returninvoice->id,
        ]);
      }
    }
    $return_details = $returninvoice->return_invoice_details()->get(); //ดึงข้อมูลจาก invoice_detail

    foreach ($return_details as $item) {
      $product = ProductModel::findOrFail($item->product_id);
      $gaurd_stock = GaurdStock::create([ //Create gaurd_stock
        "code" => $returninvoice->code,
        "type" => "sales_return_invoice",
        "amount" => $item->amount,
        "amount_in_stock" => ($product->amount_in_stock + $item->amount),
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

    return redirect('sales/return-invoice/' . $returninvoice->id)->with('flash_message', 'ReturnInvoice added!');
  }

  public function getNewCode()
  {
    $number = ReturnInvoice::where('sales_status_id', '!=', '-1')
      ->whereMonth('created_at', date("m"))
      ->whereYear('created_at', date("Y"))
      ->count();
    $run_number = Numberun::where('id', '5')->value('number_en');

    $count = $number + 1;
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
    $returninvoice = ReturnInvoice::findOrFail($id);
    //VOID
    $returninvoice->sales_status_id = -1; //-1 MEANS Void
    $returninvoice->vat = 0;
    $returninvoice->vat_percent = 0;
    $returninvoice->total_after_vat = 0;
    $returninvoice->total_before_vat = 0;

    $returninvoice->save();

    //FIND OE
    $invoice = InvoiceModel::where('invoice_code', $returninvoice->invoice_code)->firstOrFail();
    //RE STATUS OE
    if ($invoice->sales_status_id == 4) { //4 : ปิดการซื้อเรียบร้อย
      $invoice->update(["sales_status_id" => "3"]); //3 : รอรับสินค้า
    }

    $list = $returninvoice->return_invoice_details()->get();

    //GAURD STOCK - CHECK
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $returninvoice->code,
        "type" => "sales_return_invoice_cancel",
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

    return redirect("sales/return-invoice/{$id}/edit");
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
    $returninvoice = ReturnInvoice::findOrFail($id);

    $returninvoicedetail = $returninvoice->return_invoice_details()->get();
    $mode = "show";
    return view('sales.return-invoice.edit', compact('returninvoice', 'returninvoicedetail', 'mode'));

    // return view('sales.return-invoice.show', compact('returninvoice'));
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
    $returninvoice = ReturnInvoice::findOrFail($id);

    // $keyword = $request->get('search');
    // $returninvoice = InvoiceModel::firstOrNew(['invoice_code'=> $keyword]);
    // $returninvoice->total_before_vat = 0;
    // $returninvoice->total_after_vat = 0;
    // $returninvoice->vat = 0;
    //$returninvoice->sales_status_id = 0;
    $returninvoicedetail = $returninvoice->return_invoice_details()->get();
    $mode = "edit";

    return view('sales.return-invoice.edit', compact('returninvoice', 'returninvoicedetail', 'mode'));

    // return view('sales.return-invoice.edit', compact('returninvoice'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function pdf($id)
  {

    $table_return_invoice = ReturnInvoice::join('tb_customer', 'return_invoices.customer_id', '=', 'tb_customer.customer_id')
      ->where('return_invoices.id', '=', $id)
      ->select(DB::raw('return_invoices.*', 'tb_customer.*'))
      ->get();

    $table_invoice = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_invoice.invoice_code', '=', $table_return_invoice[0]->invoice_code)
      ->select(DB::raw('tb_customer.*,tb_invoice.*'))
      ->get();

    $table_return_invoice_details = ReturnInvoiceDetail::join('tb_product', 'return_invoice_details.product_id', '=', 'tb_product.product_id')
      ->where('return_invoice_details.return_invoice_id', '=', $id)
      ->select(DB::raw('tb_product.*,return_invoice_details.*'))
      ->get();

    $table_company = Company::firstOrFail();

    $data = [
      'return_invoice' => $table_return_invoice,
      'invoice' => $table_invoice,
      'invoice_detail' => $table_return_invoice_details,
      'company' => $table_company,
      'total_text' => count($table_return_invoice) > 0 ? Functions::baht_text($table_return_invoice[0]->total_after_vat) : "-",

    ];
    // print_r($data['invoice']);
    $pdf = PDF::loadView('sales/return-invoice/show', $data);
    return $pdf->stream('test.pdf');
  }
  public function update(Request $request, $id)
  {

    $requestData = $request->all();
    $returninvoice = ReturnInvoice::findOrFail($id);

    $products = $request->input('product_ids');


    if (is_array($products)) {
      for ($i = 0; $i < count($products); $i++) { // insert invoice_detail
        $new_invoice_detail = [
          "amount" => $request->input('amounts')[$i],
        ];
        $invoice_detail = ReturnInvoiceDetail::findOrFail($request->input('return_invoice_detail_id_edits')[$i]);
        $invoice_detail->update($new_invoice_detail);
      }
    }

    //ROLLBACK Gaurd stock
    $details = $returninvoice->return_invoice_details()->get(); //ดึงข้อมูลจาก invoice_details

    foreach ($details as $item) {
      $product = ProductModel::findOrFail($item->product_id);
      $gaurd_stock = GaurdStock::create([
        "code" => $returninvoice->code,
        "type" => "sales_return_invoice_cancel",
        "amount" => $item->amount,
        "amount_in_stock" => ($product->amount_in_stock - $item->amount),
        "pending_in" => $product->pending_in,
        "pending_out" => ($product->pending_out),
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out Update guard_stock
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }

    $returninvoice = ReturnInvoice::findOrFail($id);
    $returninvoice->update($requestData);


    return redirect("sales/return-invoice/{$id}")->with('flash_message', 'ReturnInvoice updated!');
  }
  public function revision(Request $request, $id)
  {
    //UPDATE SOME DATA

    // $returninvoice->sales_status_id = -1; //VOID
    // $returninvoice->save();

    //DUPLICATE OBJECT
    // $revision = $returninvoice->revision + 1;
    // $segments = explode("-", $returninvoice->code);
    // $code = $segments[0] . "-" . $segments[1] . "-R" . $revision;
    // //$returninvoice->update($requestData);
    // $new_returninvoice->update([
    //     'created_at' => date("Y-m-d h:i:s"),
    //     'updated_at' => date("Y-m-d h:i:s"),
    //     'code' => $code,
    //     'revision' => $revision,
    // ]);

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function destroy($id)
  {
    ReturnInvoice::destroy($id);

    return redirect('sales/return-invoice')->with('flash_message', 'ReturnInvoice deleted!');
  }
}
