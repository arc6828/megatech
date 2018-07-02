<?php

namespace App\Http\Controllers;

use App\DebtoutModel;
use App\CustomerModel;
use Illuminate\Http\Request;

class DebtoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new DebtoutModel();
        $q = $request->input('q');
        $table_debtout = $model->select_search($q);
        $table_customer = $model->select_customer($q);
        $data = [
            'table_debtout' => $table_debtout,
            'table_customer' => $table_customer,
            'q' => $q
        ];
        return view('debtout/index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $model_customer = new CustomerModel();
        $table_customer = $model_customer->select();
        $data = [
            'table_customer' => $table_customer
        ];
        return view('debtout/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_dept = $request->input('id_dept');
        $id_customer = $request->input('id_customer');
        $type_tax = $request->input('type_tax');
        $tax_liability = $request->input('tax_liability');
        $date_dept = $request->input('date_dept');
        $deadline = $request->input('deadline');
        $tax_filing = $request->input('tax_filing');
        $total_dept = $request->input('total_dept');
        $tax_value = $request->input('tax_value');
        $tax = $request->input('tax');

        $id_dept = "XR".$id_dept;

        $debt_balance = $debt_balance+$total_dept;

        $total = $total_dept+$tax_value;

        $model_debtout = new DebtoutModel();
        $model_customer = new CustomerModel();
        $model_debtout->insert($id_dept, $id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total);
        $model_customer->update_dept($debt_balance, $id_customer);

        return redirect('/debtout');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeptoutModel  $deptoutModel
     * @return \Illuminate\Http\Response
     */
    public function show(DeptoutModel $deptoutModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeptoutModel  $deptoutModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new DebtoutModel();
        $model_customer = new CustomerModel();
        $table_debtout = $model->select_id($id);
        $table_customer = $model_customer->select();
        $data = [
            'table_debtout' => $table_debtout,
            'table_customer' => $table_customer
        ];
        return view('debtout/edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeptoutModel  $deptoutModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_customer = $request->input('id_customer');
        $type_tax = $request->input('type_tax');
        $tax_liability = $request->input('tax_liability');
        $date_dept = $request->input('date_dept');
        $deadline = $request->input('deadline');
        $tax_filing = $request->input('tax_filing');
        $total_dept = $request->input('total_dept');
        $tax_value = $request->input('tax_value');
        $tax = $request->input('tax');

        $debt_balance = $total_dept;

        $total = $total_dept+$tax_value;

        $model_debtout = new DebtoutModel();
        $model_customer = new CustomerModel();
        $model_debtout->update($id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total, $id);
        $model_customer->update_dept($debt_balance, $id_customer);

        return redirect('/debtout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptoutModel  $deptoutModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeptoutModel $deptoutModel)
    {
        //
    }
}
