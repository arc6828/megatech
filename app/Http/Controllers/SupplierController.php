<?php

namespace App\Http\Controllers;

use App\SupplierModel;
use App\AccountModel;
use App\UserModel;
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
            $table_supplier = SupplierModel::select_all();
            break;
          case "sales" :
            $table_supplier = SupplierModel::select_by_user_id(Auth::user()->id);
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

        $table_account = AccountModel::select_all();
        $table_user = UserModel::select_all();
        $table_zone = SupplierModel::select_zone();
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location = SupplierModel::select_location_type();
        $table_supplier_type = SupplierModel::select_supplier_type();
        $data = [
            'table_account'=> $table_account,
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
        // $id_supplier = $request->input('id_supplier');
        // $type_supplier = $request->input('type_supplier');
        // $name_company = $request->input('name_company');
        // $id_account = $request->input('id_account');
        // $name_supplier = $request->input('name_supplier');
        // $address = $request->input('address');
        // $place_delivery = $request->input('place_delivery');
        // $id_user = $request->input('id_user');
        // $telephone = $request->input('telephone');
        // $sales_area = $request->input('sales_area');
        // $transpot = $request->input('transpot');
        // $note = $request->input('note');
        // $credit = $request->input('credit');
        // $debt_period = $request->input('debt_period');
        // $degree_product = $request->input('degree_product');
        // $deposit_discount = $request->input('deposit_discount');
        // $tax_number = $request->input('tax_number');
        // $bill_condition = $request->input('bill_condition');
        // $check_condition = $request->input('check_condition');
        // $location = $request->input('location');
        // $branch = $request->input('branch');
        // $fax_number = $request->input('fax_number');

        // $debt_balance = 0;


        // $model = new SupplierModel();
        // $model->insert($id_supplier, $type_supplier, $name_company, $id_account, $name_supplier, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $debt_balance);
        // return redirect('finance/debtor');

        $input = [
            'supplier_code' => $request->input('supplier_code'),
            'supplier_type' => $request->input('supplier_type'),
            'company_name' => $request->input('company_name'),
            'account_id' => $request->input('account_id'),
            'contact_name' => $request->input('contact_name'),
            'address' => $request->input('address'),
            'address2' => "",
            'sub_district' => $request->input('sub_district'),
            'district' => $request->input('district'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_address2' => "",
            'delivery_sub_district' => $request->input('delivery_sub_district'),
            'delivery_district' => $request->input('delivery_district'),
            'delivery_province' => $request->input('delivery_province'),
            'delivery_zipcode' => $request->input('delivery_zipcode'),
            'user_id' => $request->input('user_id'),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'zone_id' => $request->input('zone_id'),
            'transpotation_id' => $request->input('transpotation_id'),
            'remark' => $request->input('remark'),
            'max_credit' => $request->input('max_credit'),
            'debt_duration' => $request->input('debt_duration'),
            'degree_product' => $request->input('degree_product'),
            'loyalty_discount' => $request->input('loyalty_discount'),
            'tax_number' => $request->input('tax_number'),
            'billing_condition' => $request->input('billing_condition'),
            'cheqe_condition' => $request->input('cheqe_condition'),
            'location_type_id' => $request->input('location_type_id'),
            'branch_id' => $request->input('branch_id')
        ];

        SupplierModel::insert($input);
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
        $model = new SupplierModel();
        $table_supplier = $model->select_id($id);
        $data = [
            'table_supplier' => $table_supplier
        ];
        return view('finance/debtor/show',$data);

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
        $table_account = AccountModel::select_all();
        $table_user = UserModel::select_all();
        $table_zone = SupplierModel::select_zone();
        $table_delivery_type = SupplierModel::select_delivery_type();
        $table_location = SupplierModel::select_location_type();
        $table_supplier_type = SupplierModel::select_supplier_type();
        $table_supplier = SupplierModel::select_by_id($id);

        $data = [
            'table_supplier' => $table_supplier,
            'table_user' => $table_user,
            'table_account' => $table_account,
            'table_zone' => $table_zone,
            'table_supplier_type' => $table_supplier_type,
            'table_location' => $table_location,
            'table_delivery_type' => $table_delivery_type,

            'table_upload' => $this->getUploadTemplate(),
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
      //Save upload image to 'avatar' folder which in 'storage/app/public' folder
      $upload = SupplierModel::select_upload_by_id($id);
      $upload_json = $this->getUploadTemplate($upload);
      if ($request->hasFile('upload_map')) {
        //$path = $request->file('upload_map')->store('avatar','public');
      }

      $i = 0;
      foreach($upload_json as $row)
      {
        //$path = $request->file('image')->store('avatar','public');
        $filename = "upload_".$row->key;
        echo $filename;
        if ($request->hasFile($filename)) {
          $folder = "{$id}/{$row->key}";
          $value = $request->file($filename)->store($folder,'public');
          $upload_json[$i]->value = $value;
          echo $row->key."<br>";
        }
        $i++;
      }
      //$path = $request->file('image')->store('avatar','public');
      //echo $path;
      //Save $path to database or anything else
      //...
      $input = [
          'supplier_code' => $request->input('supplier_code'),
          'supplier_type' => $request->input('supplier_type'),
          'company_name' => $request->input('company_name'),
          'account_id' => $request->input('account_id'),
          'contact_name' => $request->input('contact_name'),
          'address' => $request->input('address'),
          'address2' => "",
          'sub_district' => $request->input('sub_district'),
          'district' => $request->input('district'),
          'province' => $request->input('province'),
          'zipcode' => $request->input('zipcode'),
          'delivery_address' => $request->input('delivery_address'),
          'delivery_address2' => "",
          'delivery_sub_district' => $request->input('delivery_sub_district'),
          'delivery_district' => $request->input('delivery_district'),
          'delivery_province' => $request->input('delivery_province'),
          'delivery_zipcode' => $request->input('delivery_zipcode'),
          'user_id' => $request->input('user_id'),
          'telephone' => $request->input('telephone'),
          'fax' => $request->input('fax'),
          'zone_id' => $request->input('zone_id'),
          'transpotation_id' => $request->input('transpotation_id'),
          'remark' => $request->input('remark'),
          'max_credit' => $request->input('max_credit'),
          'debt_duration' => $request->input('debt_duration'),
          'degree_product' => $request->input('degree_product'),
          'loyalty_discount' => $request->input('loyalty_discount'),
          'tax_number' => $request->input('tax_number'),
          'billing_condition' => $request->input('billing_condition'),
          'cheqe_condition' => $request->input('cheqe_condition'),
          'location_type_id' => $request->input('location_type_id'),
          'branch_id' => $request->input('branch_id'),
          'upload' => json_encode($upload_json),
      ];

      SupplierModel::update_by_id($input,$id);
      return redirect('supplier');

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
