<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\Functions;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\SalesStatusModel;
use App\Sales\QuotationDetailModel;
use App\Sales\QuotationModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use PDF;

class QuotationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $table_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_quotation.staff_id', '=', 'users.id')
      ->get();

    $data = [
      //QUOTATION
      'table_quotation' => $table_quotation,
      'q' => $request->input('q'),
    ];
    return view('sales/quotation/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    $data = [
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'quotation')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'table_quotation_detail' => [],
      'table_product' => ProductModel::all(),
      'customer' => !empty(request('customer_id')) ? CustomerModel::where('customer_id', request('customer_id'))->firstOrFail() : null,
    ];

    return view('sales/quotation/create', $data);
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
    $input["quotation_code"] = $this->getNewCode();
    $input['datetime'] = date('Y-m-d H:i:s');
    $input["revision"] = 0;
    $input["sales_status_id"] = 0;
    $input["vat_percent"] = 7;
    $input["sales_status_id"] = 0;
    $input["total_before_vat"] = 0;
    $input["total_after_vat"] = 0;


    $quotaion = QuotationModel::create($input);
    $id = $quotaion->quotation_id;

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        QuotationDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "quotation_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ]);
      }
    }

    return redirect("sales/quotation/{$id}")->with('flash_message', 'popup');
  }

  public function getNewCode()
  {
    $number = QuotationModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->where('sales_status_id', '!=', '-1')
      ->count();
    $run_number = Numberun::where('id', '1')->value('number_en');
    $count = $number + 1;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $quotation_code = "{$run_number}{$year}{$month}-{$number}";

    return $quotation_code;
  }

  // public function duplicate($id)
  // {
  //   // echo "hello";
  //   // exit();
  //   //Query
  //   $quotaion = QuotationModel::findOrFail($id);
  //   $quotaion_details = $quotaion->details()->get();

  //   $run_number = Numberun::where('id', '1')->value('number_en');

  //   //Clone
  //   $new_quotaion = $quotaion->replicate()->fill([
  //     'quotation_code' => $quotaion->quotation_code,
  //     'datetime' => "",
  //     'revision' => "0",
  //     'sales_status_id' => "0",
  //   ]);
  //   $new_quotaion->save();

  //   //Clone Detail
  //   foreach ($quotaion_details as $item) {
  //     $new_item = $item->replicate()->fill([
  //       'quotation_id' => $new_quotaion->quotation_id,
  //     ]);
  //     $new_item->save();
  //   }
  //   return redirect("sales/quotation/{$new_quotaion->quotation_id}")->with('flash_message', 'popup');
  // }

  public function change_status(Request $request, $id)
  {

    $quotaion = QuotationModel::findOrFail($id);
    $quotaion->sales_status_id = $request->input("sales_status_id");
    $quotaion->reason = $request->input("reason");
    $quotaion->save();

    return redirect("sales/quotation/{$quotaion->quotation_id}")->with('flash_message', 'popup');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    QuotationModel::findOrFail($id);
    $table_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'users.id', '=', 'tb_quotation.user_id')
      ->where('tb_quotation.quotation_id', '=', $id)
      ->orWhere('tb_quotation.quotation_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_quotation.*,tb_sales_status.*'))
      ->get();

    $table_quotation_detail = QuotationDetailModel::join('tb_product', 'tb_quotation_detail.product_id', '=', 'tb_product.product_id')
      ->where('quotation_id', '=', $id)
      ->get();

    $data = [
      'quotation' => QuotationModel::findOrFail($id),
      'table_quotation' => $table_quotation,
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'quotation')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'quotation_id' => $id,
      'table_quotation_detail' => $table_quotation_detail,
      'table_product' => ProductModel::all(),
      'customer' => CustomerModel::where('customer_id', QuotationModel::findOrFail($id)->customer_id)->first(),
      'customer_json' => CustomerModel::where('customer_id', QuotationModel::findOrFail($id)->customer_id)->first(),

      'mode' => 'show',
    ];
    return view('sales/quotation/edit', $data);
  }

  public function pdf($id)
  {
    QuotationModel::findOrFail($id);

    $table_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'users.id', '=', 'tb_quotation.user_id')
      ->where('tb_quotation.quotation_id', '=', $id)
      ->orWhere('tb_quotation.quotation_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_quotation.*,tb_sales_status.*'))
      ->get();

    $table_quotation_detail = QuotationDetailModel::join('tb_product', 'tb_quotation_detail.product_id', '=', 'tb_product.product_id')
      ->where('quotation_id', '=', $id)
      ->get();

    $data = [
      'table_quotation' => $table_quotation,
      'table_company' => Company::all(),
      'table_quotation_detail' => $table_quotation_detail,
      'total_text' => count($table_quotation) > 0 ? Functions::baht_text($table_quotation[0]->total) : "-",
    ];

    $pdf = PDF::loadView('sales/quotation/show', $data);
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
    $table_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'users.id', '=', 'tb_quotation.user_id')
      ->where('tb_quotation.quotation_id', '=', $id)
      ->orWhere('tb_quotation.quotation_code', '=', $id)
      ->select(DB::raw('users.*,tb_customer.*, tb_quotation.*,tb_sales_status.*'))
      ->get();

    $table_quotation_detail = QuotationDetailModel::join('tb_product', 'tb_quotation_detail.product_id', '=', 'tb_product.product_id')
      ->where('quotation_id', '=', $id)
      ->get();

    $data = [
      'quotation' => QuotationModel::findOrFail($id),
      'table_quotation' => $table_quotation,
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'quotation')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'quotation_id' => $id,
      'table_quotation_detail' => $table_quotation_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'edit',
    ];
    return view('sales/quotation/edit', $data);
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

    if (is_array($request->input('product_id_edit'))) {

      QuotationDetailModel::where('quotation_id', $id)->delete();

      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        QuotationDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "quotation_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ]);
      }
    }
    $quotation = QuotationModel::findOrFail($id);
    $quotation->update($input);

    //3.REDIRECT
    return redirect("sales/quotation/{$id}");
  }

  public function approve(Request $request, $id)
  {

    $quotaion = QuotationModel::findOrFail($id);

    $input = [
      'quotation_code' => $quotaion->quotation_code,
      'datetime' => date('Y-m-d H:i:s'),
      'sales_status_id' => 1,
      'file' => $this->pdf($id),
    ];

    $quotaion->update($input);
    //3.REDIRECT
    return redirect("sales/quotation/{$id}")->with('flash_message', 'popup');
  }

  public function revision(Request $request, $id)
  {
    $input = $request->all();
    $input['datetime'] = date('Y-m-d H:i:s');

    // create qt
    $quotaion = QuotationModel::create($input);
    $id = $quotaion->quotation_id;

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        QuotationDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "quotation_id" => $id,
          "delivery_duration" => $request->input('delivery_duration')[$i],
        ]);
      }
    }

    $quotation = QuotationModel::findOrFail($id);
    $quotation->update($input);

    if (!empty($request->input('quotation_code'))) {

      $q = QuotationModel::where('quotation_id', $request->input('quotation_id'))
        ->orderBy('datetime', 'desc')->first();
      $input['revision'] = $q->revision + 1; // update revision +1
      $q->sales_status_id = -1; //-1 means void

      $q->save(); // บันทึกข้อมูล

      $segments = explode("-", $request->input('quotation_code'));
      $segmentend = end($segments); //"00001"

      if ($segmentend[0] != "R") {
        array_push($segments, "R"); // เพิ่ม R
        $quotation_code = join("-", $segments);
        $input['quotation_code'] = "{$quotation_code}{$input['revision']}";
      } else {
        array_pop($segments); // ลบ string
        array_push($segments, "R"); // เพิ่ม R
        $quotation_code = join("-", $segments);
        $input['quotation_code'] = "{$quotation_code}{$input['revision']}"; // string
      }
    }
    // update QT revision = 1 && sales_status_id -1
    $quotation = QuotationModel::findOrFail($id);
    $quotation->update($input);

    return redirect("sales/quotation/{$id}");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    QuotationModel::destroy($id);
    return redirect("sales/quotation");
  }
}
