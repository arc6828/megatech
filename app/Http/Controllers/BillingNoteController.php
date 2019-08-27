<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingNoteModel;


class BillingNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_billing = BillingNoteModel::select_all();
        $data = ['table_billing'=> $table_billing ,'q' => $q];
        return view('finance/billing_note/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance/billing_note/create');
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
            'billing_note_code' => $request->input('billing_note_code'),
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'billing_condition' => $request->input('billing_condition'),
            'payment_condition' => $request->input('payment_condition'),
            'billing_date' => $request->input('billing_date'),
            'cheque_date' => $request->input('cheque_date'),
            'remark' => $request->input('remark'),
            'user_id' => $request->input('user_id')
        ];

        BillingNoteModel::insert($input);

        return redirect('finance/billing');
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
        $table_billing = BillingNoteModel::select_by_id($id);
        $data = ['table_billing'=>$table_billing];
        return view('finance/billing_note/edit',$data);
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
            'billing_note_code' => $request->input('billing_note_code'),
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'billing_condition' => $request->input('billing_condition'),
            'payment_condition' => $request->input('payment_condition'),
            'billing_date' => $request->input('billing_date'),
            'cheque_date' => $request->input('cheque_date'),
            'remark' => $request->input('remark'),
            'user_id' => $request->input('user_id')
        ];

        BillingNoteModel::update_by_id($input,$id);

        return redirect('finance/billing');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BillingNoteModel::delete_by_id($id);
        return redirect('finance/billing');
    }
}
