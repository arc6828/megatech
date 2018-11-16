<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplierModel;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q  = $request->input('q');
        $table_supplier =  SupplierModel::select_by_name($q);

        $data = [
            'q' => $q,
            'table_supplier' => $table_supplier
        ];

        return view('supplier/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location_type = SupplierModel::select_location_type();

        $data = [
            'table_delivery_type' => $table_delivery_type,
            'table_location_type' => $table_location_type
        ];

        return view('supplier/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            'supplier_code' => $request->input('supplier_code'),
            'supplier_type' => $request->input('supplier_type'),
            'company_name' => $request->input('company_name'),
            'account_id' => $request->input('account_id'),
            'contact_name' => $request->input('contact_name'),
            'address' => $request->input('address'),
            'sub_district' => $request->input('sub_district'),
            'district' => $request->input('district'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_sub_district' => $request->input('delivery_sub_district'),
            'delivery_district' => $request->input('delivery_district'),
            'delivery_province' => $request->input('delivery_province'),
            'delivery_zipcode' => $request->input('delivery_zipcode'),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'transpotation_id' => $request->input('transpotation_id'),
            'tax_number' => $request->input('tax_number'),
            'remark' => $request->input('remark'),
            'max_credit' => $request->input('max_credit'),
            'debt_duration' => $request->input('debt_duration'),
            'loyalty_discount' => $request->input('loyalty_discount'),
            'location_type_id' => $request->input('location_type_id'),
            'branch_id' => $request->input('branch_id'),
            'debt_balance' => $request->input('debt_balance')
        ];

        SupplierModel::insert($input);

        return redirect('supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table_supplier = SupplierModel::select_by_id($id);
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location_type = SupplierModel::select_location_type();

        $data = [
            'table_supplier' => $table_supplier,
            'table_delivery_type' => $table_delivery_type,
            'table_location_type' => $table_location_type
        ];

        return view('supplier/edit', $data);
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
        $input = [
            'supplier_code' => $request->input('supplier_code'),
            'supplier_type' => $request->input('supplier_type'),
            'company_name' => $request->input('company_name'),
            'account_id' => $request->input('account_id'),
            'contact_name' => $request->input('contact_name'),
            'address' => $request->input('address'),
            'sub_district' => $request->input('sub_district'),
            'district' => $request->input('district'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_sub_district' => $request->input('delivery_sub_district'),
            'delivery_district' => $request->input('delivery_district'),
            'delivery_province' => $request->input('delivery_province'),
            'delivery_zipcode' => $request->input('delivery_zipcode'),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'transpotation_id' => $request->input('transpotation_id'),
            'tax_number' => $request->input('tax_number'),
            'remark' => $request->input('remark'),
            'max_credit' => $request->input('max_credit'),
            'debt_duration' => $request->input('debt_duration'),
            'loyalty_discount' => $request->input('loyalty_discount'),
            'location_type_id' => $request->input('location_type_id'),
            'branch_id' => $request->input('branch_id'),
            'debt_balance' => $request->input('debt_balance')
        ];

        SupplierModel::update_all($input,$id);
        return redirect('supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierModel::delete_by_id($id);
        return redirect('supplier');
    }
}
