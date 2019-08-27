<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryModel;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_inventory = InventoryModel::select_by_name($q);
        $data = [
            'table_inventory' => $table_inventory,
            'q' => $q
        ];
        return view('inventory/inventory_main/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory/inventory_main/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = ['inventory_name' => $request->input('inventory_name')];
        InventoryModel::insert($input);
        return redirect('inventory_main');
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
        $table_inventory = InventoryModel::select_by_id($id);
        $data = ['table_inventory'=>$table_inventory];
        return view('inventory/inventory_main/edit',$data);
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
        $input = ['inventory_name' => $request->input('inventory_name')];
        InventoryModel::update_by_id($input,$id);
        return redirect('inventory_main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryModel::delete_by_id($id);
        return redirect('inventory_main');
    }
}
