<?php

namespace App\Http\Controllers;

use App\SettleModel;
use App\CustomerModel;
use App\AccountModel;
use App\UserModel;
use App\DepartmentModel;
use App\JobModel;
use App\DepositModel;
use Illuminate\Http\Request;

class SettleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $model = new SettleModel();
        $table_settle = $model->select_customer($q);
        $data = [
        'table_settle' => $table_settle,
        'q' => $q
        ];
        return view('settle/index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $model_settle = new SettleModel();
        $model_customer = new CustomerModel();
        $model_job = new JobModel();
        $model_deposit = new DepositModel();
        $model_department = new DepartmentModel();
        $model_account = new AccountModel();
        $model_user = new UserModel();

        $table_settle = $model_settle->select();
        $table_customer = $model_customer->select();
        $table_job = $model_job->select();
        $table_deposit = $model_deposit->select();
        $table_department = $model_department->select();
        $table_account = $model_account->select();
        $table_user = $model_user->select();

        $data = [
            'table_settle' => $table_settle,
            'table_customer' => $table_customer,
            'table_job' => $table_job,
            'table_deposit' => $table_deposit,
            'table_department' => $table_department,
            'table_account' => $table_account,
            'table_user' => $table_user

        ];
        return view('settle/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_settle = $request->input('id_settle');
        $id_customer = $request->input('id_customer');
        $type_tax = $request->input('type_tax');
        $id_user = $request->input('id_user');
        $id_department = $request->input('id_department');
        $sale_area = $request->input('sale_area');
        $tax_liability = $request->input('tax_liability');
        $date_settle = $request->input('date_settle');
        $debt_period = $request->input('debt_period');
        $deadline_settle = $request->input('deadline_settle');
        $id_job = $request->input('id_job');
        $ref_number = $request->input('ref_number');
        $tax_filing = $request->input('tax_filing');
        $id_account = $request->input('id_account');
        $total_settle = $request->input('total_settle');
        $id_deposit = $request->input('id_deposit');
        $discount = $request->input('discount');
        $total_deposit = $request->input('total_deposit');
        $tax = $request->input('tax');
        $tax_value = $request->input('tax_value');
        $cash_receipt = $request->input('cash_receipt');
        $total = $request->input('total');

        $id_settle = "AR".$id_settle;


        $debt_balance = ($total+$cash_receipt);

        $model_settle = new SettleModel();
        $model_customer = new CustomerModel();
        $model_settle->insert($id_settle, $id_customer, $type_tax, $id_user, $id_department, $sale_area, $tax_liability, $date_settle, $debt_period, $deadline_settle, $id_job, $ref_number, $tax_filing, $id_account, $total_settle, $id_deposit, $discount, $total_deposit, $tax, $tax_value, $cash_receipt, $total);

        $model_customer->update_dept($debt_balance, $id_customer);

        return redirect('/settle');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SettleModel  $settleModel
     * @return \Illuminate\Http\Response
     */
    public function show(SettleModel $settleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SettleModel  $settleModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model_settle = new SettleModel();
        $model_customer = new CustomerModel();
        $model_job = new JobModel();
        $model_deposit = new DepositModel();
        $model_department = new DepartmentModel();
        $model_account = new AccountModel();
        $model_user = new UserModel();

        $table_settle = $model_settle->select_id($id);
        $table_customer = $model_customer->select();
        $table_job = $model_job->select();
        $table_deposit = $model_deposit->select();
        $table_department = $model_department->select();
        $table_account = $model_account->select();
        $table_user = $model_user->select();

        $data = [
            'table_settle' => $table_settle,
            'table_customer' => $table_customer,
            'table_job' => $table_job,
            'table_deposit' => $table_deposit,
            'table_department' => $table_department,
            'table_account' => $table_account,
            'table_user' => $table_user

        ];
        return view('settle/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SettleModel  $settleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_customer = $request->input('id_customer');
        $type_tax = $request->input('type_tax');
        $id_user = $request->input('id_user');
        $id_department = $request->input('id_department');
        $sale_area = $request->input('sale_area');
        $tax_liability = $request->input('tax_liability');
        $date_settle = $request->input('date_settle');
        $debt_period = $request->input('debt_period');
        $deadline_settle = $request->input('deadline_settle');
        $id_job = $request->input('id_job');
        $ref_number = $request->input('ref_number');
        $tax_filing = $request->input('tax_filing');
        $id_account = $request->input('id_account');
        $total_settle = $request->input('total_settle');
        $id_deposit = $request->input('id_deposit');
        $discount = $request->input('discount');
        $total_deposit = $request->input('total_deposit');
        $tax = $request->input('tax');
        $tax_value = $request->input('tax_value');
        $cash_receipt = $request->input('cash_receipt');
        $total = $request->input('total');

        if ($total>$cash_receipt) {
        $debt_balance = ($total+$cash_receipt);
        } else {
        $debt_balance = ($cash_receipt-$total);
        }


        $model_settle = new SettleModel();
        $model_customer = new CustomerModel();
        $model_settle->update($id_customer, $type_tax, $id_user, $id_department, $sale_area, $tax_liability, $date_settle, $debt_period, $deadline_settle, $id_job, $ref_number, $tax_filing, $id_account, $total_settle, $id_deposit, $discount, $total_deposit, $tax, $tax_value, $cash_receipt, $total, $id);

        $model_customer->update_dept($debt_balance, $id_customer);
        return redirect('/settle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SettleModel  $settleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new SettleModel();
        $model->delete($id);

        return redirect('/settle');
    }
}
