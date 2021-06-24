<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Purchase\RequisitionModel;
use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;
//use App;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\Models\Numberun;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

class RequisitionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = [
      //QUOTATION
      'table_purchase_requisition' => RequisitionModel::all(),
      'q' => $request->input('q')
    ];
    return view('purchase/requisition/index', $data);
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
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      //'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      //QUOTATION DETAIL
      'table_purchase_requisition_detail' => [],
      'table_product' => ProductModel::all(),
    ];
    return view('purchase/requisition/create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //1. Gen new code PR
    $input = $request->all();
    $input['purchase_requisition_code'] = $this->getNewCode();
    $input['purchase_status_id'] = 1;
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total'] = $request->input('total', 0);

    //2.create PR
    $purchase = RequisitionModel::create($input);
    $id = $purchase->purchase_requisition_id;

    //3. Insert PR_detail Loop
    if (is_array($request->input('product_id_edit'))) {
      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        //4. Create PR_detail
        RequisitionDetailModel::create([
          "purchase_requisition_detail_status_id" => 3,
          "approved_amount" => 0,
          "supplier_amount" => 0,
          "po_amount" => 0,
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "before_approved_amount" =>  $request->input('amount_edit')[$i],
          "purchase_requisition_id" => $id,
        ]);
      }
    }
    return redirect("purchase/requisition/{$id}");
  }

  public function getNewCode()
  {
    $number = RequisitionModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
      ->where('purchase_status_id', '!=', '-1')
      ->count();

    $run_number = Numberun::where('id', '6')->value('number_en');

    $count =  $number + 1;
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
    $table_purchase_requisition = RequisitionModel::join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_purchase_requisition.purchase_requisition_id', '=', $id)
      ->select(DB::raw('tb_purchase_requisition.*, tb_customer.contact_name, tb_customer.company_name, tb_customer.customer_code'))
      ->get();

    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->where('purchase_requisition_id', '=', $id)
      // ->groupBy('tb_purchase_requisition_detail.product_id')
      // ->select(DB::raw('*,sum(tb_purchase_requisition_detail.amount) as sum_amount,sum(tb_purchase_requisition_detail.before_approved_amount) as sum_before_approved_amount'))
      ->get();


    $data = [
      //QUOTATION
      'table_purchase_requisition' => $table_purchase_requisition,
      'purchase_requisition' => RequisitionModel::findOrFail($id),
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'purchase_requisition_id' => $id,
      'mode' => 'show',
      //QUOTATION Detail
      'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'show',

    ];
    return view('purchase/requisition/edit', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $table_purchase_requisition = RequisitionModel::join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_purchase_requisition.purchase_requisition_id', '=', $id)
      ->select(DB::raw('tb_purchase_requisition.*, tb_customer.contact_name, tb_customer.company_name, tb_customer.customer_code'))
      ->get();

    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->where('purchase_requisition_id', '=', $id)
      // ->groupBy('tb_purchase_requisition_detail.product_id')
      ->get();

    $data = [
      //QUOTATION
      'table_purchase_requisition' => $table_purchase_requisition,
      'purchase_requisition' => RequisitionModel::findOrFail($id),
      'table_customer' => CustomerModel::select_all(),
      'table_delivery_type' => DeliveryTypeModel::all(),
      'table_department' => DepartmentModel::all(),
      'table_tax_type' => TaxTypeModel::all(),
      'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
      'table_purchase_user' => UserModel::all(),
      'table_zone' => ZoneModel::all(),
      'purchase_requisition_id' => $id,
      'mode' => 'edit',
      //QUOTATION Detail
      'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
      'table_product' => ProductModel::all(),
      'mode' => 'edit',
    ];
    return view('purchase/requisition/edit', $data);
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
    //1. ดึงข้อมูลจาก form PR
    $input = $request->all();
    $input['vat_percent'] = $request->input('vat_percent', 7);
    $input['total'] = $request->input('total', 0);
  

    if (is_array($request->input('product_id_edit'))) {

      //2. Clear PR_detail
      RequisitionDetailModel::where('purchase_requisition_id', $id)->delete();

      for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
        // print_r($request->input('product_id_edit'));

        //3.Insert PR_detail
        $purchase_detail = [
          "purchase_requisition_detail_status_id" => 3,
          "approved_amount" => 0,
          "supplier_amount" => 0,
          "po_amount" => 0,
          "product_id" => $request->input('product_id_edit')[$i],
          "amount" => $request->input('amount_edit')[$i],
          "before_approved_amount" =>  $request->input('amount_edit')[$i],
          "purchase_requisition_id" => $id,
        ];

        //4. Create PR_detail
        RequisitionDetailModel::create($purchase_detail);
      }
      // exit();
    }


    //5. Update PR
    $purchase = RequisitionModel::findOrFail($id);
    $purchase->update($input);

    // RequisitionModel::where('purchase_requisition_id', $id)
    //   ->update($input);

    //4.REDIRECT
    return redirect("purchase/requisition/{$id}/edit");
  }

  public function revision(Request $request, $id)
  {
    //VOID IF HAS CODE (Revision)
    if (!empty($request->input('purchase_requisition_code'))) {
      $q = RequisitionModel::where('purchase_requisition_code', $request->input('purchase_requisition_code'))
        ->orderBy('datetime', 'desc')->first();
      $input['revision'] = $q->revision + 1;
      $q->purchase_status_id = -1; //-1 means void
      $q->save();

      $segments = explode("-", $request->input('purchase_requisition_code'));
      $input['purchase_requisition_code'] = $segments[0] . "-" . $segments[1] . "-R" . $input['revision'];
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    RequisitionModel::destroy($id);
    return redirect("purchase/requisition");
  }
}
