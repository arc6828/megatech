<?php

namespace App\Http\Controllers;

use App\CustomerModel;
use App\AccountModel;
use App\UserModel;
use App\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $table_customer = [];
        switch(Auth::user()->role){
          case "admin" :
            $table_customer = CustomerModel::all();
            break;
          case "sales" :
            $table_customer = CustomerModel::where('user_id', Auth::id() )->get();
            break;
        }

        $data = [
	        'table_customer' => $table_customer,
        	'q' => $q
        ];
        return view('customer/index',$data);
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
        $table_zone = CustomerModel::select_zone();
        $table_delivery_type = CustomerModel::select_delivery_type();
        $table_location = CustomerModel::select_location_type();
        $table_customer_type = CustomerModel::select_customer_type();
        $data = [
            //'table_account'=> $table_account,
            'table_user' => $table_user,
            'table_zone' => $table_zone,
            'table_delivery_type' => $table_delivery_type,
            'table_location' => $table_location,
            'table_customer_type' => $table_customer_type,
            'table_upload' => $this->getUploadTemplate(),            
            'mode' => 'create',
        ];
        return view('customer/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $validated = $request->validate([
            'customer_code' => 'unique:tb_customer,customer_code',
            'tax_number' => 'unique:tb_customer,tax_number',
        ]);
        $requestData = $request->all();

        if ($request->hasFile('file_map')) {
            $folder = "customer/{$request->input('customer_code')}/file_map";
            $requestData['file_map'] = $request->file('file_map')->store($folder, 'public');
        }
        if ($request->hasFile('file_cc')) {
          $folder = "customer/{$request->input('customer_code')}/file_cc";
            $requestData['file_cc'] = $request->file('file_cc')->store($folder, 'public');
        }
        if ($request->hasFile('file_cv_20')) {
          $folder = "customer/{$request->input('customer_code')}/file_cv_20";
            $requestData['file_cv_20'] = $request->file('file_cv_20')->store($folder, 'public');
        }
        if ($request->hasFile('file_cheque')) {
          $folder = "customer/{$request->input('customer_code')}/file_cheque";
            $requestData['file_cheque'] = $request->file('file_cheque')->store($folder, 'public');
        }
        //CHANGE LATER
        //$requestData['max_credit'] = -1;
        //UPDATE CUSTOMER
        $customer = CustomerModel::create($requestData);
        return redirect('customer/'.$customer->customer_id."/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$table_account = AccountModel::select_all();
        $table_user = UserModel::select_all();
        $table_zone = CustomerModel::select_zone();
        $table_delivery_type = CustomerModel::select_delivery_type();
        $table_location = CustomerModel::select_location_type();
        $table_customer_type = CustomerModel::select_customer_type();
        $table_customer = CustomerModel::select_by_id($id);

        $data = [
          'table_customer' => $table_customer,
          'table_user' => $table_user,
          //'table_account' => $table_account,
          'table_zone' => $table_zone,
          'table_customer_type' => $table_customer_type,
          'table_location' => $table_location,
          'table_delivery_type' => $table_delivery_type,

          'table_upload' => $this->getUploadTemplate(),
          'customer' => CustomerModel::findOrFail($id),
          'checklist' => Checklist::firstOrCreate(
                ['customer_id' => $id],
                ['type' => 'customer']
              ),
          'mode' => 'show',
        ];        
        return view('customer/edit',$data);
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
        $table_zone = CustomerModel::select_zone();
        $table_delivery_type = CustomerModel::select_delivery_type();
        $table_location = CustomerModel::select_location_type();
        $table_customer_type = CustomerModel::select_customer_type();
        $table_customer = CustomerModel::select_by_id($id);

        $data = [
            'table_customer' => $table_customer,
            'table_user' => $table_user,
            //'table_account' => $table_account,
            'table_zone' => $table_zone,
            'table_customer_type' => $table_customer_type,
            'table_location' => $table_location,
            'table_delivery_type' => $table_delivery_type,

            'table_upload' => $this->getUploadTemplate(),
            'customer' => CustomerModel::findOrFail($id),
            'checklist' => Checklist::firstOrCreate(
              ['customer_id' => $id],
              ['type' => 'customer']
            ),
            'mode' => 'edit',
        ];
        return view('customer/edit',$data);
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
          $folder = "customer/{$request->input('customer_code')}/file_map";
          $requestData['file_map'] = $request->file('file_map')->store($folder, 'public');
      }
      if ($request->hasFile('file_cc')) {
        $folder = "customer/{$request->input('customer_code')}/file_cc";
          $requestData['file_cc'] = $request->file('file_cc')->store($folder, 'public');
      }
      if ($request->hasFile('file_cv_20')) {
        $folder = "customer/{$request->input('customer_code')}/file_cv_20";
          $requestData['file_cv_20'] = $request->file('file_cv_20')->store($folder, 'public');
      }
      if ($request->hasFile('file_cheque')) {
        $folder = "customer/{$request->input('customer_code')}/file_cheque";
          $requestData['file_cheque'] = $request->file('file_cheque')->store($folder, 'public');
      }
      //UPDATE CUSTOMER
      $customer = CustomerModel::findOrFail($id);
      $customer->update($requestData);
      //UPDATE CHECKLIST
      $checklist = Checklist::findOrFail($customer->checklist->id);
      $checklist->update($requestData);

      return redirect("customer/{$id}/edit");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptorModel  $deptorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerModel::delete_by_id($id);
        return redirect('customer');
}
}
