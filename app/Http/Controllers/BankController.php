<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountModel;
use App\BankModel;
use App\BankDetailModel;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_bank = BankModel::select_by_name($q);
        $data = [
            'table_bank' => $table_bank,
            'q' => $q
        ];
        return view('bank/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table_detail_bank = BankDetailModel::select_year_now();
        $data = ['table_detail_bank' => $table_detail_bank];
        return view('bank/create',$data);
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
            'bank_code' => $request->input('bank_code'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'account_id' => $request->input('account_id'),
            'book_bank_serial' => $request->input('book_bank_serial'),
            'bring_forward' => $request->input('bring_forword')
        ];
        BankModel::insert($input);
        return redirect('bank');
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
        $table_bank = BankModel::select_by_id($id);
        $table_detail_bank = BankDetailModel::select_year_now();
        $data = [
            'table_bank' => $table_bank,
            'table_detail_bank' => $table_detail_bank
        ];
        return view('bank/edit',$data);
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
            'bank_code' => $request->input('bank_code'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'account_id' => $request->input('account_id'),
            'book_bank_serial' => $request->input('book_bank_serial'),
            'bring_forward' => $request->input('bring_forword')
        ];
        BankModel::update_by_id($input,$id);
        return redirect('bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankModel::delete_by_id($id);
        return redirect('bank');
    }
}
