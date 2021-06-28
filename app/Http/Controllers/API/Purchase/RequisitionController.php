<?php

namespace App\Http\Controllers\API\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Purchase\RequisitionDetailStatusModel;
use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionModel;

class RequisitionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
  
    $select_all_by_user_id = RequisitionModel::join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_delivery_type', 'tb_receive_temporary.receive_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_receive_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_receive_temporary.staff_id', '=', 'users.id')
      ->where('tb_receive_temporary.user_id', '=', Auth::user()->id)
      ->get();
    $user_id = $request->input("user_id", 0);
    if ($user_id > 0) {
      $table_order = $select_all_by_user_id;
    }
    return response()->json($table_order);
  }

  public function validate_po(Request $request)
  {
    $supplier_id = $request->input("supplier_id");
    $external_reference_id = $request->input("external_reference_id");
    $table_order = RequisitionModel::select_by_po($supplier_id, $external_reference_id);
    return response()->json($table_order);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $select_by_id = RequisitionModel::join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_purchase_requisition.purchase_requisition_id', '=', $id)
      ->select(DB::raw('tb_purchase_requisition.*, tb_customer.contact_name, tb_customer.company_name, tb_customer.customer_code'))
      ->get();
    $data = [
      "table_order" => $select_by_id,
      // "table_order_detail" => RequisitionDetailModel::select_by_order_id_by_status_id($id, 1), // 1 MEANS APPROVED
    ];
    return response()->json($data);
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
