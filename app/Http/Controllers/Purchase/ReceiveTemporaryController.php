<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\ReceiveTemporaryModel;
use App\Purchase\ReceiveTemporaryDetailModel;

use App\SupplierModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\GaurdStock;
use App\Models\Numberun;
use PDF;

class ReceiveTemporaryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $select_all = ReceiveTemporaryModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_receive_temporary.staff_id', '=', 'users.id')
      ->get();
    $select_all_by_user_id = ReceiveTemporaryModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_receive_temporary.staff_id', '=', 'users.id')
      ->where('tb_receive_temporary.user_id', '=', Auth::user()->id)
      ->get();

    $table_receive_temporary = (Auth::user()->role === "admin") ?
      $select_all : $select_all_by_user_id;

    $data = [
      'table_receive_temporary' => $table_receive_temporary,
      'q' => $request->input('q')
    ];
    return view('purchase/receive_temporary/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      'table_supplier' => SupplierModel::all(),
      'table_receive_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::where('category', 'receive_temporary')->get(),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'table_receive_temporary_detail' => [],
      'table_product' => ProductModel::all(),
    ];
    return view('purchase/receive_temporary/create', $data);
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
    $input['receive_temporary_code'] = $this->getNewCode();
    $input['datetime'] = date('Y-m-d H:i:s');
    $input['purchase_status_id'] = 5;
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total'] = $request->input('total', 0);

    $receive_temporary = ReceiveTemporaryModel::create($input);
    $id = $receive_temporary->receive_temporary_id;

    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        ReceiveTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "receive_temporary_id" => $id,
          "receive_duration" => "-",
        ]);
      }
    }

    $list = $receive_temporary->receive_temporary_details()->get();
    //GAURD STOCK      
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $receive_temporary->receive_temporary_code,
        "type" => "purchase_dt_create",
        "amount" => $item['amount'],
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

    return redirect("purchase/receive_temporary/{$id}");
  }
  public function approve($id)
  {

    $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
    $input = [
      'receive_temporary_code' => $receive_temporary->receive_temporary_code,
      'datetime' => date('Y-m-d H:i:s'),
      'purchase_status_id' => 10,
    ];
    $receive_temporary->update($input);

    //3.REDIRECT
    return redirect("purchase/receive_temporary/{$id}")->with('flash_message', 'popup');
  }

  public function getNewCode()
  {
    $number = ReceiveTemporaryModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->where('purchase_status_id', '!=', '-1')
      ->count();
    $run_number = Numberun::where('id', '10')->value('number_en');
    $count =  $number + 1;
    $year = date("y");
    $month = date("m");
    $number = sprintf('%05d', $count);
    $receive_temporary_code = "{$run_number}{$year}{$month}-{$number}";
    return $receive_temporary_code;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $table_receive_temporary = ReceiveTemporaryModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_receive_temporary.receive_temporary_id', '=', $id)
      ->select(DB::raw('tb_supplier.*,tb_receive_temporary.*'))
      ->get();

    $table_receive_temporary_detail = ReceiveTemporaryDetailModel::join('tb_product', 'tb_receive_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('receive_temporary_id', '=', $id)
      ->get();

    $data = [
      'table_receive_temporary' => $table_receive_temporary,
      'receive_temporary' => ReceiveTemporaryModel::findOrFail($id),
      'table_supplier' => SupplierModel::all(),
      'table_receive_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::where('category', 'receive_temporary')->get(),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'receive_temporary_id' => $id,
      'table_receive_temporary_detail' => $table_receive_temporary_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'show',
    ];
    return view('purchase/receive_temporary/edit', $data);
  }

  public function pdf($id)
  {
    //no show
    $table_receive_temporary = ReceiveTemporaryModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_receive_temporary.receive_temporary_id', '=', $id)
      ->select(DB::raw('tb_supplier.*,tb_receive_temporary.*'))
      ->get();
    $table_receive_temporary_detail = ReceiveTemporaryDetailModel::join('tb_product', 'tb_receive_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('receive_temporary_id', '=', $id)
      ->get();
    $data = [
    
      'table_receive_temporary' => $table_receive_temporary,
      'table_supplier' => SupplierModel::all(),
      'table_receive_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::where('category', 'receive_temporary')->get(),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'receive_temporary_id' => $id,
      'table_receive_temporary_detail' => $table_receive_temporary_detail,
      'table_product' => ProductModel::all(),
    ];

    $pdf = PDF::loadView('purchase/receive_temporary/show', $data);
    return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
    //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
  }

  public function cancel($id)
  {
    //
    $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
    $receive_temporary->purchase_status_id = 11; //11 MEANS Cancelled
    $receive_temporary->save();
    $list = $receive_temporary->receive_temporary_details()->get();

    //GAURD STOCK      
    foreach ($list as $item) {
      $product = ProductModel::findOrFail($item['product_id']);
      $gaurd_stock = GaurdStock::create([
        "code" => $receive_temporary->receive_temporary_code,
        "type" => "purchase_dt_cancel",
        "amount" => -1*$item['amount'],
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

    return redirect("purchase/receive_temporary/{$id}/edit");
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $table_receive_temporary = ReceiveTemporaryModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_receive_temporary.receive_temporary_id', '=', $id)
      ->select(DB::raw('tb_supplier.*,tb_receive_temporary.*'))
      ->get();
    $table_receive_temporary_detail = ReceiveTemporaryDetailModel::join('tb_product', 'tb_receive_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('receive_temporary_id', '=', $id)
      ->get();
    $data = [

      'table_receive_temporary' => $table_receive_temporary,
      'receive_temporary' => ReceiveTemporaryModel::findOrFail($id),
      'table_supplier' => SupplierModel::all(),
      'table_receive_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::where('category', 'receive_temporary')->get(),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'receive_temporary_id' => $id,
      'table_receive_temporary_detail' => $table_receive_temporary_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'edit',
    ];
    return view('purchase/receive_temporary/edit', $data);
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
      ReceiveTemporaryDetailModel::where('receive_temporary_detail_id', $id)->delete();
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        ReceiveTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "receive_temporary_id" => $id,
        ]);
      }
    }
    $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
    $receive_temporary->update($input);

    //4.REDIRECT
    return redirect("purchase/receive_temporary/{$id}");
  }

  public function revision(Request $request, $id)
  {

    $input = $request->all();
    $input['datetime'] = date('Y-m-d H:i:s');

    $receive_temporary = ReceiveTemporaryModel::create($input);
    $id =    $receive_temporary->receive_temporary_id;

    if (!empty($request->input('receive_temporary_code'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        ReceiveTemporaryDetailModel::create([
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "discount_price" => $request->input('discount_price_edit')[$i],
          "receive_temporary_id" => $id,
          "receive_duration" => "-",
        ]);
      }
      $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
      $receive_temporary->update($input);

      if (!empty($request->input('receive_temporary_code'))) {

        $q = ReceiveTemporaryModel::where('receive_temporary_id', $request->input('receive_temporary_id'))
          ->orderBy('datetime', 'desc')->first();
        $input['revision'] = $q->revision + 1;
        $q->purchase_status_id = -1; //-1 means void
        $q->save();
        $segments = explode("-", $request->input('receive_temporary_code'));
        $segmentend = end($segments); //"00001"

        if ($segmentend[0] != "R") {
          array_push($segments, "R"); // เพิ่ม R
          $receive_temporary_code = join("-", $segments);
          $input['receive_temporary_code'] = "{$receive_temporary_code}{$input['revision']}";
        } else {
          array_pop($segments); // ลบ string
          array_push($segments, "R"); // เพิ่ม R
          $receive_temporary_code = join("-", $segments);
          $input['receive_temporary_code'] = "{$receive_temporary_code}{$input['revision']}"; // string
        }
      }
    }
    $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
    $receive_temporary->update($input);
    return redirect("purchase/receive_temporary/{$id}");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    ReceiveTemporaryModel::destroy($id);
    return redirect("purchase/receive_temporary");
  }
}
