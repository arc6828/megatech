<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\SupplierModel;
use App\UserModel;
use App\User;

class SupplierController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user_id = $request->input("user_id", "1");
    $table_supplier = [];
    if (UserModel::check_role($user_id, "admin")) {
      $table_supplier = SupplierModel::all();
    } else {
      $table_supplier = SupplierModel::where('user_id', Auth::id())->get();
    }
    return response()->json($table_supplier);
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
    $table_supplier = SupplierModel::join('users', 'tb_supplier.user_id', '=', 'users.id')
      ->where('supplier_id', '=', $id)->get();
    return response()->json($table_supplier);
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
