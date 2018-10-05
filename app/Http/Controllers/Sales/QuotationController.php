<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\QuotationModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;

use App\QuotationDetailModel;



class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //QUOTATION
        $q = $request->input('q');
        $table_quotation = QuotationModel::select_by_keyword($q);
        //QUATATION DETAIL

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
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_sales_status = SalesStatusModel::select_all();
        $table_sales_user = UserModel::select_by_role('sales');
        $table_zone = ZoneModel::select_all();

        $data = [
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_tax_type' => $table_tax_type,
            'table_sales_status' => $table_sales_status,
            'table_sales_user' => $table_sales_user,
            'table_zone' => $table_zone,
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
        $quotation_code = $this->getNewQuatationCode();
        $input = [
            'quotation_code' => $quotation_code,
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
            'total_before_vat' => $request->input('total_before_vat',0),
            'vat_percent' => $request->input('vat_percent',7),
            'vat' => $request->input('tax',0),
            'net_price' => $request->input('net_price',0),
        ];
        $id = QuotationModel::insert($input);
        return redirect("sales/quotation/{$id}/edit");
    }

    public function getNewQuatationCode(){
        $count = QuotationModel::select_count_by_current_month() + 1;
        $year = (date("Y") + 543) % 100;
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
        $table_quotation = QuotationModel::select_by_id($id);
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_sales_status = SalesStatusModel::select_all();
        $table_sales_user = UserModel::select_by_role('sales');
        $table_zone = ZoneModel::select_all();
        $table_quotation_detail = QuotationDetailModel::select_by_quotation_id($id);
        $total_before_vat = QuotationDetailModel::get_total_before_vat_by_quotation_id($id);
        if(!$total_before_vat){
          $total_before_vat = 0;
        }

        $data = [
            'table_quotation' => $table_quotation,
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_tax_type' => $table_tax_type,
            'table_sales_status' => $table_sales_status,
            'table_sales_user' => $table_sales_user,
            'table_zone' => $table_zone,
            'table_quotation_detail' => $table_quotation_detail,
            'total_before_vat' => $total_before_vat,
            'quotation_id'=> $id,
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
          'total_before_vat' => $request->input('total_before_vat',0),
          'vat_percent' => $request->input('vat_percent',7),
          'vat' => $request->input('vat',0),
          'net_price' => $request->input('net_price',0),
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
        //
    }
}
