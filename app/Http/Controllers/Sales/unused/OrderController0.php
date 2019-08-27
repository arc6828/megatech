<?php
namespace App\Http\Controllers\Sales\unused;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;

use App\Sales\OrderDetailModel;



class OrderController extends Controller
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
        $table_order = OrderModel::select_by_keyword($q);
        //QUATATION DETAIL

        $data = [
            'table_order' => $table_order,
            'q' => $q
        ];
        return view('sales/order/index',$data);
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
        return view('sales/order/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_code = $this->getNewCode();
        $input = [
            'order_code' => $order_code,
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
        $id = OrderModel::insert($input);
        return redirect("sales/order/{$id}/edit");
    }

    public function getNewCode(){
        $count = OrderModel::select_count_by_current_month() + 1;
		//$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $order_code = "QT{$year}{$month}-{$number}";
        return $order_code;
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
        $table_order = OrderModel::select_by_id($id);
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_sales_status = SalesStatusModel::select_all();
        $table_sales_user = UserModel::select_by_role('sales');
        $table_zone = ZoneModel::select_all();
        $table_order_detail = OrderDetailModel::select_by_order_id($id);

        $data = [
            'table_order' => $table_order,
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_tax_type' => $table_tax_type,
            'table_sales_status' => $table_sales_status,
            'table_sales_user' => $table_sales_user,
            'table_zone' => $table_zone,
            'table_order_detail' => $table_order_detail,
            'order_id'=> $id,
        ];
        return view('sales/order/edit',$data);
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
          //'order_code' => $order_code,
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
      OrderModel::update_by_id($input,$id);
      return redirect("sales/order/{$id}/edit");
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
