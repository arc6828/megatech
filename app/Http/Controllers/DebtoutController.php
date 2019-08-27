<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DebtoutModel;
use App\CustomerModel;

class DebtoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_debtout = DebtoutModel::select_all();
        $data = [
            'table_debtout' => $table_debtout,
            'q' => $q
        ];
        return view('finance/debtout/index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $table_type_tax = DebtoutModel::select_tb_tax();
        $data = ['table_type_tax' => $table_type_tax];
        return view('finance/debtout/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $id_dept = $request->input('id_dept');
        // $id_customer = $request->input('id_customer');
        // $type_tax = $request->input('type_tax');
        // $tax_liability = $request->input('tax_liability');
        // $date_dept = $request->input('date_dept');
        // $deadline = $request->input('deadline');
        // $tax_filing = $request->input('tax_filing');
        // $total_dept = $request->input('total_dept');
        // $tax_value = $request->input('tax_value');
        // $tax = $request->input('tax');
        // $total_dept = $request->input('total');
        // $id_dept = "XR".$id_dept;
        $debt_code = "XR".$request->input('debt_code');
        $total_dept = $request->input('total_dept');
        $tax_value = $request->input('tax_value');
        $net_amount = $total_dept + $tax_value;
        $input = [
            'debt_code' => $debt_code ,
            'customer_id' => $request->input('customer_id'),
            'date_debt' => $request->input('date_debt'),
            'tax_type_id' => $request->input('tax_type_id'),
            'deadline' => $request->input('deadline'),
            'tax_liability' => $request->input('tax_liability'),
            'tax_filing' => $request->input('tax_filing'),
            'tax' => $request->input('tax'),
            'net_amount' => $net_amount
        ];
        
        DebtoutModel::insert($input);

        // $total = $total_dept+$tax_value;

        // $model_debtout = new DebtoutModel();
        // $model_customer = new CustomerModel();
        // $model_debtout->insert($id_dept, $id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total);
        // $model_customer->update_dept($debt_balance, $id_customer);

        return redirect('finance/debtout');

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
        $table_debtout = DebtoutModel::select_by_id($id);
        $table_type_tax = $model->select_tb_tax();
        $data = [
            'table_debtout' => $table_debtout,
            'table_type_tax' => $table_type_tax
        ];
        return view('finance/debtout/edit',$data);

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
        $debt_code = $request->input('debt_code');
        $total_dept = $request->input('total_dept');
        $tax_value = $request->input('tax_value');
        $net_amount = $total_dept + $tax_value;
        $input = [
            'debt_code' => $debt_code ,
            'customer_id' => $request->input('customer_id'),
            'date_debt' => $request->input('date_debt'),
            'tax_type_id' => $request->input('tax_type_id'),
            'deadline' => $request->input('deadline'),
            'tax_liability' => $request->input('tax_liability'),
            'tax_filing' => $request->input('tax_filing'),
            'tax' => $request->input('tax'),
            'net_amount' => $net_amount,
            'total_debt' => $total_dept,
            'tax_value' => $tax_value
        ];
        DebtoutModel::update_by_id($input,$id);
        return redirect('finance/debtout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptoutModel  $deptoutModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new DebtoutModel();
        $model->delete($id);

        return redirect('finance/debtout');
    }
}
