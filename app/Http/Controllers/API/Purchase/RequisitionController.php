<?php

namespace App\Http\Controllers\API\Purchase;

use Illuminate\Http\Request;
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
      //$order_detail_status_id = $request->input("order_detail_status_id",3);
      //$table_order = RequisitionModel::select_all();


      $user_id = $request->input("user_id",0);
      if($user_id > 0)
      {
        $table_order = RequisitionModel::select_all_by_user_id($user_id);
      }
      return response()->json($table_order);
    }

    public function validate_po(Request $request)
    {
      //$order_detail_status_id = $request->input("order_detail_status_id",3);
      $supplier_id = $request->input("supplier_id");
      $external_reference_id = $request->input("external_reference_id");
      $table_order = RequisitionModel::select_by_po($supplier_id,$external_reference_id);
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
      $data = [
        "table_order" => RequisitionModel::select_by_id($id),
        "table_order_detail" => RequisitionDetailModel::select_by_order_id_by_status_id($id, 1), // 1 MEANS APPROVED
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
