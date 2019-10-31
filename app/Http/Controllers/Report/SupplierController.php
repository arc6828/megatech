<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function screen_1_4()
    {
      return view ("report/supplier/screen_1_4");
    }
    public function screen_1_5()
    {
      return view("report/supplier/screen_1_5");
    }
    public function screen_2_2()
    {
      return view("report/supplier/screen_2_2");
    }
    public function screen_3_2()
    {
      return view("report/supplier/screen_3_2");
    }
    public function screen_4_1()
    {
      return view("report/supplier/screen_4_1");
    }
    public function screen_5_2()
    {
      return view("report/supplier/screen_5_2");
    }
    public function screen_6_16()
    {
      return view("report/supplier/screen_6_16");
    }
    public function screen_7_2()
    {
      return view("report/supplier/screen_7_2");
    }
}
