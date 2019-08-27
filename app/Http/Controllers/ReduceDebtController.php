<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReduceDebtModel;

class ReduceDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $q = $request->input('q');
        // $table_reduce = ReduceDebtModel::select_by_name($q);

         $data = ['q' => $q];

        return view('/finance/reduce/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table_tax_type = ReduceDebtModel::select_tax_type();
        $table_zone = ReduceDebtModel::select_zone();
        $data = [
            'table_tax_type' => $table_tax_type,
            'table_zone' => $table_zone
        ];
        return view('/finance/reduce/create', $data);
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
        $table_reduce = ReduceDebtModel::select_by_id($id);
        $table_tax_type = ReduceDebtModel::select_tax_type();
        $table_zone = ReduceDebtModel::select_zone();
        $data = [
            'table_tax_type' => $table_tax_type,
            'table_zone' => $table_zone,
            'table_reduce' => $table_reduce
        ];
        return view('/finance/reduce/edit',$data);
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
