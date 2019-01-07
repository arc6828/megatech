<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\QuotationModel;
use App\Sales\QuotationDetailModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_quotation = QuotationModel::select_by_keyword($q);
      $data = [
        //QUOTATION
        'table_quotation' => QuotationModel::select_all(),
        'q' => $request->input('q')
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
      $data = [
          //QUOTATION
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_all(),
          'table_sales_user' => UserModel::select_by_role('sales'),
          //'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_quotation_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/quotation/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //INSERT QUOTATION
      $input = [
          'quotation_code' => $this->getNewCode(),
          'customer_id' => $request->input('customer_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          'sales_status_id' => $request->input('sales_status_id'),
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
      ];
      $id = QuotationModel::insert($input);

      //INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      print_r($request->input('product_id_edit'));
      print_r($request->input('amount_edit'));
      print_r($request->input('discount_price_edit'));
      echo $id;
      for($i=0; $i<count($request->input('product_id_edit')); $i++){
        $list[] = [
            "product_id" => $request->input('product_id_edit')[$i],
            "amount" => $request->input('amount_edit')[$i],
            "discount_price" => $request->input('discount_price_edit')[$i],
            "quotation_id" => $id,
        ];
      }
      QuotationDetailModel::insert($list);

      return redirect("sales/quotation/{$id}/edit");
    }

    public function getNewCode(){
        $count = QuotationModel::select_count_by_current_month() + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $quotation_code = "QT{$year}{$month}-{$number}";
        return $quotation_code;
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
        //QUOTATION
        $table_quotation = QuotationModel::select_by_id($id);
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_department = DepartmentModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_sales_status = SalesStatusModel::select_all();
        $table_sales_user = UserModel::select_by_role('sales');
        $table_zone = ZoneModel::select_all();
        //QUOTATION DETAIL
        $table_quotation_detail = QuotationDetailModel::select_by_quotation_id($id);
        //$q = $request->input('q');
        //$table_quotation = QuotationModel::select_by_id($quotation_id);
        $table_product = ProductModel::select_by_keyword("");

        $data = [
            //QUOTATION
            'table_quotation' => $table_quotation,
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_department' => $table_department,
            'table_tax_type' => $table_tax_type,
            'table_sales_status' => $table_sales_status,
            'table_sales_user' => $table_sales_user,
            'table_zone' => $table_zone,
            'quotation_id'=> $id,
            //QUOTATION Detail
            'table_quotation_detail' => $table_quotation_detail,
            'table_product' => $table_product,
            //'table_quotation' => $table_quotation,
            //'quotation_id' => $quotation_id,
            //'q' => $q,

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
      $input = [
        //'quotation_code' => $quotation_code,
        'customer_id' => $request->input('customer_id'),
        'debt_duration' => $request->input('debt_duration'),
        'billing_duration' => $request->input('billing_duration'),
        'payment_condition' => $request->input('payment_condition',""),
        'delivery_type_id' => $request->input('delivery_type_id'),
        'tax_type_id' => $request->input('tax_type_id'),
        'delivery_time' => $request->input('delivery_time'),
        'department_id' => $request->input('department_id'),
        'sales_status_id' => $request->input('sales_status_id'),
        'user_id' => $request->input('user_id'),
        'zone_id' => $request->input('zone_id'),
        'remark' => $request->input('remark'),
        'vat_percent' => $request->input('vat_percent',7),
      ];

      QuotationModel::update_by_id($input,$id);
      return redirect("sales/quotation/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      QuotationModel::delete_by_id($id);
      return redirect("sales/quotation");
    }




}
