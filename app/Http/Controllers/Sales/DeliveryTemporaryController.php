<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\GaurdStock;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\SalesStatusModel;
use App\Sales\DeliveryTemporaryDetailModel;
use App\Sales\DeliveryTemporaryModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use PDF;

class DeliveryTemporaryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $select_all = DeliveryTemporaryModel::join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_delivery_temporary.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_delivery_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_delivery_temporary.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_delivery_temporary.staff_id', '=', 'users.id')
      ->get();

    $select_all_by_user_id = DeliveryTemporaryModel::join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_delivery_temporary.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_delivery_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_delivery_temporary.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_delivery_temporary.staff_id', '=', 'users.id')
      ->where('tb_delivery_temporary.user_id', '=',  Auth::user()->id)
      ->get();

    $table_delivery_temporary = (Auth::user()->role === "admin") ?
      $select_all : $select_all_by_user_id;

    $data = [
      'table_delivery_temporary' => $table_delivery_temporary,
      'q' => $request->input('q'),
    ];
    return view('sales/delivery_temporary/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      'table_customer' => CustomerModel::all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'delivery_temporary')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'table_delivery_temporary_detail' => [],
      'table_product' => ProductModel::all(),
    ];
    return view('sales/delivery_temporary/create', $data);
  }

  public function getNewCode()
  {
    $number = DeliveryTemporaryModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->where('sales_status_id', '!=', '-1')
      ->count();
    $run_number = Numberun::where('id', '2')->value('number_en');
    $count = $number + 1;
    //$year = (date("Y") + 543) % 100;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $delivery_temporary_code = "{$run_number}{$year}{$month}-{$number}";
    return $delivery_temporary_code;
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
    $input['delivery_temporary_code'] = $this->getNewCode();
    $input['datetime'] = date('Y-m-d H:i:s');
    $input["revision"] = 0;
    $input["vat_percent"] = 7;
    $input["sales_status_id"] = 0;
    $input["total_before_vat"] = 0;
    $input["total_after_vat"] = 0;
    $input['sales_status_id'] = 6;


    $delivery_temporary = DeliveryTemporaryModel::create($input);
    $id = $delivery_temporary->delivery_temporary_id;

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        DeliveryTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "delivery_temporary_id" => $id,
          "delivery_duration" => "-",
        ]);
      }
    }

    return redirect("sales/delivery_temporary/{$id}");
  }
  public function cancel($id)
  {
    $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);
    $delivery_temporary->sales_status_id = 11; //11 MEANS Cancelled
    $delivery_temporary->save();
    $list = $delivery_temporary->delivery_temporary_details;

    //GAURD STOCK
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $delivery_temporary->delivery_temporary_code,
        "type" => "sales_dt_cancel",
        "amount" => $item['amount'],
        "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
        "pending_in" => $product->pending_in,
        "pending_out" => $product->pending_out,
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }

    return redirect("sales/delivery_temporary/{$id}/edit");
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $table_delivery_temporary = DeliveryTemporaryModel::join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_delivery_temporary.delivery_temporary_id', '=', $id)
      ->select(DB::raw('tb_customer.*,tb_delivery_temporary.*'))
      ->get();

    $table_delivery_temporary_detail = DeliveryTemporaryDetailModel::join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('delivery_temporary_id', '=', $id)
      ->get();

    $data = [
      'table_delivery_temporary' => $table_delivery_temporary,
      'delivery_temporary' => DeliveryTemporaryModel::findOrFail($id),
      'table_customer' => CustomerModel::all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'delivery_temporary')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'delivery_temporary_id' => $id,
      'table_delivery_temporary_detail' => $table_delivery_temporary_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'show',
    ];
    return view('sales/delivery_temporary/edit', $data);
  }

  public function pdf($id)
  {
    //no show
    $table_delivery_temporary = DeliveryTemporaryModel::join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_delivery_temporary.delivery_temporary_id', '=', $id)
      ->select(DB::raw('tb_customer.*,tb_delivery_temporary.*'))
      ->get();

    $table_delivery_temporary_detail = DeliveryTemporaryDetailModel::join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('delivery_temporary_id', '=', $id)
      ->get();

    $data = [
      'table_delivery_temporary' =>  $table_delivery_temporary,
      'table_company' => Company::all(),
      'table_customer' => CustomerModel::all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::select_by_category('delivery_temporary'),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'delivery_temporary_id' => $id,
      'table_delivery_temporary_detail' => $table_delivery_temporary_detail,
      'table_product' => ProductModel::all(),
    ];

    $pdf = PDF::loadView('sales/delivery_temporary/show', $data);
    return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
    //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
  }


  public function approve($id)
  {

    $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);

    $input = [
      'delivery_temporary_code' => $delivery_temporary->delivery_temporary_code,
      'datetime' => date('Y-m-d H:i:s'),
      'sales_status_id' => 10,
    ];

    $delivery_temporary->update($input);

    //GAURD STOCK
    $list = $delivery_temporary->delivery_temporary_details()->get();

    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $delivery_temporary->delivery_temporary_code,
        "type" => "sales_dt_create",
        "amount" => -1*$item['amount'],
        "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
        "pending_in" => $product->pending_in,
        "pending_out" => $product->pending_out,
        "product_id" => $product->product_id,
      ]);

      //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
      $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
      $product->pending_in = $gaurd_stock['pending_in'];
      $product->pending_out = $gaurd_stock['pending_out'];
      $product->save();
    }

    //3.REDIRECT
    return redirect("sales/delivery_temporary/{$id}")->with('flash_message', 'popup');
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $table_delivery_temporary = DeliveryTemporaryModel::join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_delivery_temporary.delivery_temporary_id', '=', $id)
      ->select(DB::raw('tb_customer.*,tb_delivery_temporary.*'))
      ->get();

    $table_delivery_temporary_detail = DeliveryTemporaryDetailModel::join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('delivery_temporary_id', '=', $id)
      ->get();

    $data = [
      'table_delivery_temporary' => $table_delivery_temporary,
      'delivery_temporary' => DeliveryTemporaryModel::findOrFail($id),
      'table_customer' => CustomerModel::all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_sales_status' => SalesStatusModel::where('category', 'delivery_temporary')->get(),
      'table_sales_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'delivery_temporary_id' => $id,
      'table_delivery_temporary_detail' => $table_delivery_temporary_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'edit',
    ];
    return view('sales/delivery_temporary/edit', $data);
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
      DeliveryTemporaryDetailModel::where('delivery_temporary_id', $id)->delete();
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        DeliveryTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "delivery_temporary_id" => $id,
          "delivery_duration" => "-",
        ]);
      }
    }
    $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);
    $delivery_temporary->update($input);


    //4.REDIRECT
    return redirect("sales/delivery_temporary/{$id}");
  }

  public function revision(Request $request, $id)
  {
    $input = $request->all();
    $input['datetime'] = date('Y-m-d H:i:s');

    $delivery_temporary = DeliveryTemporaryModel::create($input);
    $id = $delivery_temporary->delivery_temporary_id;

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        DeliveryTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "delivery_temporary_id" => $id,
          "delivery_duration" => "-",
        ]);
      }
    }

    $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);
    $delivery_temporary->update($input);

    if (!empty($request->input('delivery_temporary_code'))) {

      $q = DeliveryTemporaryModel::where('delivery_temporary_id', $request->input('delivery_temporary_id'))
        ->orderBy('datetime', 'desc')->first();
      $input['revision'] = $q->revision + 1;
      $q->sales_status_id = -1; //-1 means void
      $q->save();
      $segments = explode("-", $request->input('delivery_temporary_code'));
      $segmentend = end($segments); //"00001"

      if ($segmentend[0] != "R") {
        array_push($segments, "R"); // เพิ่ม R
        $delivery_temporary_code = join("-", $segments);
        $input['delivery_temporary_code'] = "{$delivery_temporary_code}{$input['revision']}";
      } else {
        array_pop($segments); // ลบ string
        array_push($segments, "R"); // เพิ่ม R
        $delivery_temporary_code = join("-", $segments);
        $input['delivery_temporary_code'] = "{$delivery_temporary_code}{$input['revision']}"; // string
      }
    }

    $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);
    $delivery_temporary->update($input);

    return redirect("sales/delivery_temporary/{$id}");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    DeliveryTemporaryModel::destroy($id);
    return redirect("sales/delivery_temporary");
  }
}
