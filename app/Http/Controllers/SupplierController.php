<?php

namespace App\Http\Controllers;

use App\SupplierModel;
use App\AccountModel;
use App\UserModel;
use App\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_supplier = [];
        switch(Auth::user()->role){
          case "admin" :
            $table_supplier = SupplierModel::all();
            break;
          case "sales" :
            $table_supplier = SupplierModel::where('user_id', Auth::id() )->get();
            break;
        }

        $data = [
	        'table_supplier' => $table_supplier,
        	'q' => $q
        ];
        return view('supplier/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$table_account = AccountModel::select_all();
        $table_user = UserModel::select_all();
        $table_zone = SupplierModel::select_zone();
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location = SupplierModel::select_location_type();
        $table_supplier_type = SupplierModel::select_supplier_type();
        $data = [
            //'table_account'=> $table_account,
            'table_user' => $table_user,
            'table_zone' => $table_zone,
            'table_delivery_type' => $table_delivery_type,
            'table_location' => $table_location,
            'table_supplier_type' => $table_supplier_type,
            'table_upload' => $this->getUploadTemplate(),
        ];
        return view('supplier/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        
        $requestData = $request->all();

        if ($request->hasFile('file_map')) {
            $folder = "supplier/{$request->input('supplier_code')}/file_map";
            $requestData['file_map'] = $request->file('file_map')->store($folder, 'public');
        }
        if ($request->hasFile('file_cc')) {
          $folder = "supplier/{$request->input('supplier_code')}/file_cc";
            $requestData['file_cc'] = $request->file('file_cc')->store($folder, 'public');
        }
        if ($request->hasFile('file_cv_20')) {
          $folder = "supplier/{$request->input('supplier_code')}/file_cv_20";
            $requestData['file_cv_20'] = $request->file('file_cv_20')->store($folder, 'public');
        }
        if ($request->hasFile('file_cheque')) {
          $folder = "supplier/{$request->input('supplier_code')}/file_cheque";
            $requestData['file_cheque'] = $request->file('file_cheque')->store($folder, 'public');
        }
        //UPDATE CUSTOMER
        SupplierModel::create($requestData);
        return redirect('supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table_supplier = SupplierModel::findOrFail($id);
        return view('finance/debtor/show', compact('table_supplier') );
    }

    public function getUploadTemplate($upload = null)
    {
      if($upload != null)
      {
        return $upload;
      }
      return [
        (object)["key" => "map" , "name" => "แผนที่", "value"=>""],
        (object)["key" => "cc" , "name" => "ใบรับรองบริษัท", "value"=>""],
        (object)["key" => "cv_20" , "name" => "ใบภพ.20", "value"=>""],
        (object)["key" => "cheque" , "name" => "ระเบียบวางบิล-รับเช็ค", "value"=>""],
      ];
    }

    public function getContactTemplate()
    {
      return [
        "" => "",
      ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$table_account = AccountModel::select_all();
        $table_user = UserModel::select_all();
        $table_zone = SupplierModel::select_zone();
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location = SupplierModel::select_location_type();
        $table_supplier_type = SupplierModel::select_supplier_type();
        $table_supplier = SupplierModel::select_by_id($id);

        $data = [
            'table_supplier' => $table_supplier,
            'table_user' => $table_user,
            //'table_account' => $table_account,
            'table_zone' => $table_zone,
            'table_supplier_type' => $table_supplier_type,
            'table_location' => $table_location,
            'table_delivery_type' => $table_delivery_type,

            'table_upload' => $this->getUploadTemplate(),
            'supplier' => SupplierModel::findOrFail($id),
            'supplier2' => SupplierModel::findOrFail($id),
            'checklist' => Checklist::firstOrCreate(
              ['supplier_id' => $id],
              ['type' => 'supplier']
            ),
        ];
        return view('supplier/edit',$data);
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
      $requestData = $request->all();

      //FILE
      if ($request->hasFile('file_map')) {
          $folder = "supplier/{$request->input('supplier_code')}/file_map";
          $requestData['file_map'] = $request->file('file_map')->store($folder, 'public');
      }
      if ($request->hasFile('file_cc')) {
        $folder = "supplier/{$request->input('supplier_code')}/file_cc";
          $requestData['file_cc'] = $request->file('file_cc')->store($folder, 'public');
      }
      if ($request->hasFile('file_cv_20')) {
        $folder = "supplier/{$request->input('supplier_code')}/file_cv_20";
          $requestData['file_cv_20'] = $request->file('file_cv_20')->store($folder, 'public');
      }
      if ($request->hasFile('file_cheque')) {
        $folder = "supplier/{$request->input('supplier_code')}/file_cheque";
          $requestData['file_cheque'] = $request->file('file_cheque')->store($folder, 'public');
      }
      //UPDATE CUSTOMER
      $supplier = SupplierModel::findOrFail($id);
      $supplier->update($requestData);
      //UPDATE CHECKLIST
      $checklist = Checklist::findOrFail($supplier->checklist->id);
      $checklist->update($requestData);

      return redirect("supplier/{$id}/edit");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierModel::delete_by_id($id);
        return redirect('supplier');
}
}
