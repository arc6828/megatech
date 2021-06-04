<?php
namespace App\Http\Controllers\Sales;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\Functions;
use App\GaurdStock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\SalesStatusModel;
use App\Sales\InvoiceDetailModel;
use App\Sales\InvoiceModel;
use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$table_invoice = InvoiceModel::select_by_keyword($q);
        $select_all = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_invoice.staff_id', '=', 'users.id')
            ->get();

        $select_all_by_user_id = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_invoice.staff_id', '=', 'users.id')
            ->where('tb_invoice.user_id', '=', Auth::user()->id)
            ->get();

        $table_invoice = (Auth::user()->role === "admin") ?
        $select_all : $select_all_by_user_id; //if

        $data = [
            //QUOTATION
            'table_invoice' => $table_invoice,
            'q' => $request->input('q'), //รับค่า order_code จาก index
        ];
        return view('sales/invoice/index', $data);
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
            'table_sales_status' => SalesStatusModel::select_by_category('order'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            //QUOTATION DETAIL
            'table_invoice_detail' => [],
            'table_product' => ProductModel::select_all(),
        ];
        return view('sales/invoice/create', $data);
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
            'invoice_code' => $this->getNewCode(),
            'external_reference_id' => $request->input('external_reference_id'),
            'internal_reference_id' => $request->input('internal_reference_id'),
            'customer_id' => $request->input('customer_id'),
            'debt_duration' => $request->input('debt_duration', "0"),
            'billing_duration' => $request->input('billing_duration', "0"),
            'payment_condition' => $request->input('payment_condition', ""),
            'payment_method' => $request->input('payment_method', ""),
            'max_credit' => $request->input('max_credit', ""),
            'delivery_type_id' => $request->input('delivery_type_id'),
            'tax_type_id' => $request->input('tax_type_id'),
            'delivery_time' => $request->input('delivery_time'),
            'department_id' => $request->input('department_id'),
            'sales_status_id' => $request->input('sales_status_id'),
            'user_id' => $request->input('user_id'),
            'staff_id' => $request->input('staff_id'),
            'zone_id' => $request->input('zone_id'),
            'remark' => $request->input('remark'),
            'vat_percent' => $request->input('vat_percent', 7),
            'vat' => $request->input('vat', 0),
            'total_before_vat' => $request->input('total_before_vat', 0),
            'total' => $request->input('total_after_vat', 0),
            'total_debt' => $request->input('total_after_vat', 0),
        ];

        if ($input['payment_method'] != "credit") {
            $input['total_debt'] = 0;
        }

        $invoice = InvoiceModel::create($input);
        $id = $invoice->invoice_id;
        //INSERT ALL NEW QUOTATION DETAIL
        // $list = [];
        //print_r($request->input('product_id_edit'));
        //print_r($request->input('amount_edit'));
        //print_r($request->input('discount_price_edit'));
        //echo $id;
        if (is_array($request->input('product_id_edit'))) {
            for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
                $invoice_detail = [
                    "product_id" => $request->input('product_id_edit')[$i],
                    "amount" => $request->input('amount_edit')[$i],
                    "discount_price" => $request->input('discount_price_edit')[$i],
                    "invoice_id" => $id,
                ];

                InvoiceDetailModel::create($invoice_detail);
                //Update order_detail (4) ออก iv แล้ว
                OrderDetailModel::where('order_detail_id', $request->input('id_edit')[$i])
                    ->update(["order_detail_status_id" => 4]);

                //Decreament approve_amount order_detail
                OrderDetailModel::where('order_detail_id', $request->input('id_edit')[$i])->first()->decrement('approved_amount', $request->input('amount_edit')[$i]);
                //Increment iv_amount  order_detail
                OrderDetailModel::where('order_detail_id', $request->input('id_edit')[$i])->first()->increment('iv_amount', $request->input('amount_edit')[$i]);

                //ดึงข้อมูลจาก order
                $order_code = $request->input('internal_reference_id');
                $order = OrderModel::where('order_code', $order_code)->first();
                $order_id = $order->order_id;

                $sum = OrderDetailModel::where('order_detail_id', $request->input('id_edit')[$i])
                    ->where('order_id', $order_id)
                    ->sum('before_approved_amount');
                // print_r(json_encode($sum));
                // exit();
                if ($sum == 0) {
                    //NO ONE LEFT : 9 => ออก Invoice ครบ
                    OrderModel::where('order_id', $order_id)->update(["sales_status_id" => 9]);
                } else {
                    OrderModel::where('order_id', $order_id)->update(["sales_status_id" => 14]);

                }
                //CHANGE STATUS ORDER DETAIL => 4
                // $input_detail2 = [
                //     "order_detail_status_id" => 4,
                // ];
                // OrderDetailModel::update_by_id($input_detail2, $request->input('id_edit')[$i]);
                // // OrderDetailModel::where('order_detail_id', $request->input('id_edit')[$i])
                // //     ->update(["order_detail_status_id" => 4]);

                // //CHANGE STATUS ORDER

                // $order_code = $request->input('internal_reference_id');
                // //
                // //$order_id = $order->order_id;
                // $count = OrderDetailModel::countWaitIV($order_code);
                // //if($count == 0){
                // if ($count == 0) {
                //     //NO ONE LEFT : 9 => ออก Invoice ครบ
                //     OrderModel::update_by_id(
                //         ["sales_status_id" => "9"],
                //         $order_code
                //     );
                // }

            }
        }
        // InvoiceDetailModel::insert($list);
        $invoice_detail = InvoiceDetailModel::where('invoice_id', $id)->get();

        // GAURD STOCK
        foreach ($invoice_detail as $item) {
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $invoice->invoice_code,
                "type" => "sales_invoice",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
                "pending_in" => $product->pending_in,
                "pending_out" => ($product->pending_out - $item['amount']),
                "product_id" => $product->product_id,
            ]);

            //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
            $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
            $product->pending_in = $gaurd_stock['pending_in'];
            $product->pending_out = $gaurd_stock['pending_out'];
            $product->save();

        }

        return redirect("sales/invoice/{$id}");
    }

    public function getNewCode()
    {
        $number = InvoiceModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
        $run_number = Numberun::where('id', '4')->value('number_en');
        $count = $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $invoice_code = "{$run_number}{$year}{$month}-{$number}";
        return $invoice_code;
    }

    public function cancel($id)
    {
        //
        $invoice = InvoiceModel::findOrFail($id);
        //VOID
        $invoice->sales_status_id = -1; //-1 MEANS Void
        $invoice->vat = 0;
        $invoice->total_debt = 0;
        $invoice->total_before_vat = 0;
        $invoice->total = 0;
        $invoice->save();

        //FIND OE
        $order = OrderModel::where('order_code', $invoice->internal_reference_id)->firstOrFail();
        //RE STATUS OE
        if ($order->sales_status_id == 9) { //ออก Invoice ครบ
            $order->update(["sales_status_id" => "8"]); //อนุมัติครบ
        }

        $list = $invoice->invoice_details()->get();

        //RE STATUS OE DETAIL IN PICKING
        //$pickings = $order->pickings()->get();
        foreach ($list as $p) {
            $order->pickings()
                ->where('product_id', $p->product_id)
                ->where('amount', $p->amount)
                ->where('order_detail_status_id', '4') //4 means ออก IV แล้ว
                ->update(["order_detail_status_id" => "1"]); //ออก IV แล้ว -> อนุมัติ (1)

            $p->discount_price = 0;
            $p->save();
        }

        //GAURD STOCK
        foreach ($list as $item) {
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $id,
                "type" => "sales_invoice_cancel",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
                "pending_in" => $product->pending_in,
                "pending_out" => ($product->pending_out + $item['amount']),
                "product_id" => $product->product_id,
            ]);

            //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
            $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
            $product->pending_in = $gaurd_stock['pending_in'];
            $product->pending_out = $gaurd_stock['pending_out'];
            $product->save();

        }

        return redirect("sales/invoice/{$id}/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table_invoice = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->where('tb_invoice.invoice_id', '=', $id)
            ->select(DB::raw('tb_customer.*,tb_invoice.*'))
            ->get();
        $data = [
            //QUOTATION
            'table_invoice' => $table_invoice,
            'invoice' => InvoiceModel::findOrFail($id),
            'table_customer' => CustomerModel::select_all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('order'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            'invoice_id' => $id,
            //QUOTATION Detail
            'table_invoice_detail' => InvoiceDetailModel::select_by_invoice_id($id),
            'table_product' => ProductModel::select_all(),
            'mode' => 'show',
        ];
        return view('sales/invoice/edit', $data);
    }

    public function pdf($id)
    {
        //no show
        $table_invoice = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->where('tb_invoice.invoice_id', '=', $id)
            ->select(DB::raw('tb_customer.*,tb_invoice.*'))
            ->get();

        $data = [
            //QUOTATION
            'table_invoice' => $table_invoice,
            'table_customer' => CustomerModel::select_all(),
            'table_company' => Company::all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('order'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            'invoice_id' => $id,
            //QUOTATION Detail
            'table_invoice_detail' => InvoiceDetailModel::select_by_invoice_id($id),
            'table_product' => ProductModel::select_all(),

            'total_text' => count($table_invoice) > 0 ? Functions::baht_text($table_invoice[0]->total) : "-",
        ];
        //return view('sales/invoice/edit',$data);

        $pdf = PDF::loadView('sales/invoice/show', $data);
        return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
        //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table_invoice = InvoiceModel::join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->where('tb_invoice.invoice_id', '=', $id)
            ->select(DB::raw('tb_customer.*,tb_invoice.*'))
            ->get();
        $data = [
            //QUOTATION
            'invoice' => InvoiceModel::findOrFail($id),
            'table_invoice' => $table_invoice,
            'table_customer' => CustomerModel::select_all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('order'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            'invoice_id' => $id,
            //QUOTATION Detail
            'table_invoice_detail' => InvoiceDetailModel::select_by_invoice_id($id),
            'table_product' => ProductModel::select_all(),
            'mode' => 'edit',
        ];
        return view('sales/invoice/edit', $data);
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
        //1.INSERT QUOTATION
        $input = [
            //'invoice_code' => $invoice_code,
            'external_reference_id' => $request->input('external_reference_id'),
            'internal_reference_id' => $request->input('internal_reference_id'),
            'customer_id' => $request->input('customer_id'),
            'debt_duration' => $request->input('debt_duration'),
            'billing_duration' => $request->input('billing_duration'),
            'payment_condition' => $request->input('payment_condition', ""),
            'payment_method' => $request->input('payment_method', ""),
            'max_credit' => $request->input('max_credit', ""),
            'delivery_type_id' => $request->input('delivery_type_id'),
            'tax_type_id' => $request->input('tax_type_id'),
            'delivery_time' => $request->input('delivery_time'),
            'department_id' => $request->input('department_id'),
            'sales_status_id' => $request->input('sales_status_id'),
            'user_id' => $request->input('user_id'),
            'zone_id' => $request->input('zone_id'),
            'remark' => $request->input('remark'),
            'vat_percent' => $request->input('vat_percent', 7),
            //'total' => $request->input('total_before_vat',0),
            'total' => $request->input('total_after_vat', 0),
            'total_debt' => $request->input('total_after_vat', 0),
        ];
        if ($input['payment_method'] != "credit") {
            $input['total_debt'] = 0;
        }
        InvoiceModel::update_by_id($input, $id);

        //2.DELETE QUOTATION DETAIL FIRST
        InvoiceDetailModel::delete_by_invoice_id($id);

        //3.INSERT ALL NEW QUOTATION DETAIL
        $list = [];
        //print_r($request->input('product_id_edit'));
        //print_r($request->input('amount_edit'));
        //print_r($request->input('discount_price_edit'));
        //echo $id;
        if (is_array($request->input('product_id_edit'))) {
            for ($i = 0; $i < count($request->input('product_id_edit')); $i++) {
                $list[] = [
                    "product_id" => $request->input('product_id_edit')[$i],
                    "amount" => $request->input('amount_edit')[$i],
                    "discount_price" => $request->input('discount_price_edit')[$i],
                    "invoice_id" => $id,
                ];
            }
        }

        InvoiceDetailModel::insert($list);

        //4.REDIRECT
        return redirect("sales/invoice/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvoiceModel::destroy($id);
        return redirect("sales/invoice");
    }
}
