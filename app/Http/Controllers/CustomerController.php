<?php

namespace App\Http\Controllers;

use App\CustomerModel;
use App\AccountModel;
use App\UserModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new CustomerModel();
        $model_account = new AccountModel();
        $model_user = new UserModel();
        $q = $request->input('q');
        $table_customer = $model->select_search($q);
        $table_account = $model_account->select();
        $table_user = $model_user->select();
        $data = [
        'table_customer' => $table_customer,
        'table_account' => $table_account,
        'table_user' => $table_user,
        'q' => $q
        ];
        return view('debtor/index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model_account = new AccountModel();
        $model_user = new UserModel();
        $table_account = $model_account->select();
        $table_user = $model_user->select();
        $data = [
            'table_account'=> $table_account,
            'table_user' => $table_user
        ];
        return view('debtor/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_customer = $request->input('id_customer');
        $type_customer = $request->input('type_customer');
        $name_company = $request->input('name_company');
        $id_account = $request->input('id_account');
        $name_customer = $request->input('name_customer');
        $address = $request->input('address');
        $place_delivery = $request->input('place_delivery');
        $id_user = $request->input('id_user');
        $telephone = $request->input('telephone');
        $sales_area = $request->input('sales_area');
        $transpot = $request->input('transpot');
        $note = $request->input('note');
        $credit = $request->input('credit');
        $debt_period = $request->input('debt_period');
        $degree_product = $request->input('degree_product');
        $deposit_discount = $request->input('deposit_discount');
        $tax_number = $request->input('tax_number');
        $bill_condition = $request->input('bill_condition');
        $check_condition = $request->input('check_condition');
        $location = $request->input('location');
        $branch = $request->input('branch');
        $fax_number = $request->input('fax_number');


        $model = new CustomerModel();
        $model->insert($id_customer, $type_customer, $name_company, $id_account, $name_customer, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number);
        return redirect('/debtor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = new CustomerModel();
        $table_customer = $model->select_id($id);
        $data = [
            'table_customer' => $table_customer
        ];
        return view('debtor/show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new CustomerModel();
        $model_account = new AccountModel();
        $model_user = new UserModel();
        $table_account = $model_account->select();
        $table_user = $model_user->select();
        $table_customer = $model->select_id($id);

        $data = [
            'table_customer' => $table_customer,
            'table_user' => $table_user,
            'table_account' => $table_account
        ];
        return view('debtor/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
        $type_customer = $request->input('type_customer');
        $name_company = $request->input('name_company');
        $id_account = $request->input('id_account');
        $name_customer = $request->input('name_customer');
        $address = $request->input('address');
        $place_delivery = $request->input('place_delivery');
        $id_user = $request->input('id_user');
        $telephone = $request->input('telephone');
        $sales_area = $request->input('sales_area');
        $transpot = $request->input('transpot');
        $note = $request->input('note');
        $credit = $request->input('credit');
        $debt_period = $request->input('debt_period');
        $degree_product = $request->input('degree_product');
        $deposit_discount = $request->input('deposit_discount');
        $tax_number = $request->input('tax_number');
        $bill_condition = $request->input('bill_condition');
        $check_condition = $request->input('check_condition');
        $location = $request->input('location');
        $branch = $request->input('branch');
        $fax_number = $request->input('fax_number');

        $model = new CustomerModel();
        $model->update($type_customer, $name_company, $id_account, $name_customer, $address, $place_delivery, $id_user, $telephone, $sales_area, $transpot, $note, $credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition, $location, $branch, $fax_number, $id);

        return redirect('/debtor');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new CustomerModel();
        $model->delete($id);

        return redirect('/debtor');

    }
}
