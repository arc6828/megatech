<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\QuotationModel;
use App\QuotationDetailModel;
use App\UserModel;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_quotation = QuotationModel::select_by_keyword($q);
        $data = [
            'table_quotation' => $table_quotation,
            'q' => $q
        ];
        return view('sales/quotation/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //no show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table_quotation = QuotationModel::select_by_id($id);
        $table_quotation_detail = QuotationDetailModel::select_by_quotation_id($id);
        $table_sales_user = UserModel::select_by_role('sales');

        $data = [
            'table_quotation' => $table_quotation,
            'table_quotation_detail' => $table_quotation_detail,
            'table_sales_user' => $table_sales_user,
        ];
        return view('sales/quotation/edit',$data);
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
