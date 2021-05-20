<?php
namespace App\Http\Controllers\Sales;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\Functions;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\ProductModel;
use App\SalesStatusModel;
use App\Sales\QuotationDetailModel;
use App\Sales\QuotationModel;
use App\TaxTypeModel;
use App\UserModel;
use App\ZoneModel;
use Illuminate\Http\Request;
use PDF;

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
        // $table_quotation = (Auth::user()->role === "admin" )?
        //     QuotationModel::select_all() :
        //     QuotationModel::select_all_by_user_id(Auth::id());
        $table_quotation = QuotationModel::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_quotation.staff_id', '=', 'users.id')
            ->get();

        $data = [
            //QUOTATION
            'table_quotation' => $table_quotation,
            'q' => $request->input('q'),
        ];
        return view('sales/quotation/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ขั้นตอนที่ 1 กรอกข้อมูลลง form
        $data = [
            //QUOTATION
            'table_customer' => CustomerModel::select_all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('quotation'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            //QUOTATION DETAIL
            'table_quotation_detail' => [],
            'table_product' => ProductModel::select_all(),

            'customer' => !empty(request('customer_id')) ? CustomerModel::where('customer_id', request('customer_id'))->firstOrFail() : null,
            //'customer_json' => !empty(request('customer_id'))? CustomerModel::where('customer_id',request('customer_id'))->first(): '',
            //'customer_json' => json_encode(CustomerModel::findOrFail(request('customer_id'))),
        ];

        return view('sales/quotation/create', $data);
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
            'datetime' => date('Y-m-d H:i:s'),
            'customer_id' => $request->input('customer_id'),
            'contact_name' => $request->input('contact_name'),
            'debt_duration' => $request->input('debt_duration'),
            'billing_duration' => $request->input('billing_duration'),
            'payment_condition' => $request->input('payment_condition', ""),
            'reason' => $request->input('reason'),
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
        ];

        $quotaion = QuotationModel::create($input); // create qt
        $id = $quotaion->quotation_id;

        //INSERT ALL NEW QUOTATION DETAIL
        if (is_array($request->input('product_id_edit'))) {
            for ($i = 0; $i < count($request->input('product_id_edit')); $i++) { // insert qt detail
                $quotaion_detail = [
                    "product_id" => $request->input('product_id_edit')[$i],
                    "amount" => $request->input('amount_edit')[$i],
                    "discount_price" => $request->input('discount_price_edit')[$i],
                    "quotation_id" => $id,
                    "delivery_duration" => $request->input('delivery_duration')[$i],
                ];
                QuotationDetailModel::create($quotaion_detail); // create qt detail
            }
        }

        return redirect("sales/quotation/{$id}")->with('flash_message', 'popup');
    }

    public function getNewCode()
    {
        $number = QuotationModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->where('sales_status_id', '!=', '-1')
            ->count();
        $run_number = Numberun::where('id', '1')->value('number_en');
        $count = $number + 1;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $quotation_code = "{$run_number}{$year}{$month}-{$number}";

        return $quotation_code;
    }

    public function duplicate($id)
    {
        // echo "hello";
        // exit();
        //Query
        $quotaion = QuotationModel::findOrFail($id);
        $quotaion_details = $quotaion->details()->get();

        //Clone
        $new_quotaion = $quotaion->replicate()->fill([
            'quotation_code' => $quotaion->quotation_code,
            'datetime' => "",
            'revision' => "0",
            'sales_status_id' => "0",
        ]);
        $new_quotaion->save();
        //Clone Detail
        foreach ($quotaion_details as $item) {
            $new_item = $item->replicate()->fill([
                'quotation_id' => $new_quotaion->quotation_id,
            ]);
            $new_item->save();
        }
        return redirect("sales/quotation/{$new_quotaion->quotation_id}")->with('flash_message', 'popup');
    }

    public function change_status(Request $request, $id)
    {
        // echo "hello";
        // exit();
        //Query
        $quotaion = QuotationModel::findOrFail($id);
        $quotaion->sales_status_id = $request->input("sales_status_id");
        $quotaion->reason = $request->input("reason");
        $quotaion->save();

        return redirect("sales/quotation/{$quotaion->quotation_id}")->with('flash_message', 'popup');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        QuotationModel::findOrFail($id);
        $data = [
            //QUOTATION
            'quotation' => QuotationModel::findOrFail($id),
            'table_quotation' => QuotationModel::select_by_id($id),
            'table_customer' => CustomerModel::select_all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('quotation'),
            //'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            'quotation_id' => $id,
            //QUOTATION Detail
            'table_quotation_detail' => QuotationDetailModel::select_by_quotation_id($id),
            'table_product' => ProductModel::select_all(),
            'customer' => CustomerModel::where('customer_id', QuotationModel::findOrFail($id)->customer_id)->first(),
            'customer_json' => CustomerModel::where('customer_id', QuotationModel::findOrFail($id)->customer_id)->first(),

            'mode' => 'show',
        ];
        return view('sales/quotation/edit', $data);
    }

    public function pdf($id)
    {
        QuotationModel::findOrFail($id);

        $data = [
            //QUOTATION
            'table_quotation' => QuotationModel::select_by_id($id),
            'table_company' => Company::select_all(),
            //QUOTATION Detail
            'table_quotation_detail' => QuotationDetailModel::select_by_quotation_id($id),
            'total_text' => count(QuotationModel::select_by_id($id)) > 0 ? Functions::baht_text(QuotationModel::select_by_id($id)[0]->total) : "-",
        ];

        $pdf = PDF::loadView('sales/quotation/show', $data);

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
        $data = [
            //QUOTATION
            'quotation' => QuotationModel::findOrFail($id),
            'table_quotation' => QuotationModel::select_by_id($id),
            'table_customer' => CustomerModel::select_all(),
            'table_delivery_type' => DeliveryTypeModel::select_all(),
            'table_department' => DepartmentModel::select_all(),
            'table_tax_type' => TaxTypeModel::select_all(),
            'table_sales_status' => SalesStatusModel::select_by_category('quotation'),
            'table_sales_user' => UserModel::select_by_role('sales'),
            'table_sales_user' => UserModel::select_all(),
            'table_zone' => ZoneModel::select_all(),
            'quotation_id' => $id,
            //QUOTATION Detail
            'table_quotation_detail' => QuotationDetailModel::select_by_quotation_id($id),
            'table_product' => ProductModel::select_all(),
            'mode' => 'edit',
        ];
        return view('sales/quotation/edit', $data);
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
            //'quotation_code' => $quotation_code,
            'customer_id' => $request->input('customer_id'),
            'contact_name' => $request->input('contact_name'),
            'debt_duration' => $request->input('debt_duration'),
            'billing_duration' => $request->input('billing_duration'),
            'reason' => $request->input('reason'),
            'payment_condition' => $request->input('payment_condition', ""),
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
        ];
        //2.INSERT UPDATE DELETE QUOTATION DETAIL
        if (is_array($request->input('product_id_edit'))) {

            QuotationDetailModel::where('quotation_id', $id)->delete(); // clear qt detail

            for ($i = 0; $i < count($request->input('product_id_edit')); $i++) { // insert qt detail
                $quotaion_detail = [
                    "product_id" => $request->input('product_id_edit')[$i],
                    "amount" => $request->input('amount_edit')[$i],
                    "discount_price" => $request->input('discount_price_edit')[$i],
                    "quotation_id" => $id,
                    "delivery_duration" => $request->input('delivery_duration')[$i],
                ];
                QuotationDetailModel::create($quotaion_detail); // create qt detail
            }
        }
        QuotationModel::where('quotation_id', $id)
            ->orWhere('quotation_code', $id)
            ->update($input); // update qt draft

        //3.REDIRECT
        return redirect("sales/quotation/{$id}");
    }

    public function revision(Request $request, $id)
    {
        $input = [
            'quotation_code' => $request->input('quotation_code'),
            'datetime' => date('Y-m-d H:i:s'),
            'customer_id' => $request->input('customer_id'),
            'contact_name' => $request->input('contact_name'),
            'debt_duration' => $request->input('debt_duration'),
            'billing_duration' => $request->input('billing_duration'),
            'reason' => $request->input('reason'),
            'payment_condition' => $request->input('payment_condition', ""),
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
        ];

        $quotaion = QuotationModel::create($input); // create qt
        $id = $quotaion->quotation_id;

        if (is_array($request->input('product_id_edit'))) {
            for ($i = 0; $i < count($request->input('product_id_edit')); $i++) { // insert qt detail
                $quotaion_detail = [
                    "product_id" => $request->input('product_id_edit')[$i],
                    "amount" => $request->input('amount_edit')[$i],
                    "discount_price" => $request->input('discount_price_edit')[$i],
                    "quotation_id" => $id,
                    "delivery_duration" => $request->input('delivery_duration')[$i],
                ];
                QuotationDetailModel::create($quotaion_detail); // create qt detail
            }
        }

        QuotationModel::where('quotation_id', $id)
            ->orWhere('quotation_code', $id)
            ->update($input); // Update QT revision = 0

        if (!empty($request->input('quotation_code'))) {

            $q = QuotationModel::where('quotation_id', $request->input('quotation_id'))
                ->orderBy('datetime', 'desc')->first();
            $input['revision'] = $q->revision + 1; // update revision +1
            $q->sales_status_id = -1; //-1 means void

            $q->save(); // บันทึกข้อมูล

            $segments = explode("-", $request->input('quotation_code'));
            $segmentend = end($segments); //"00001"


            if ($segmentend[0] != "R") {
                array_push($segments, "-R", $input['revision']); // เพิ่ม R
                $input['quotation_code'] = join("", $segments); // string

            } else {
                array_pop($segments);
                array_push($segments, "-R", $input['revision']);
                $input['quotation_code'] = join("", $segments); // string
            }

        }
        QuotationModel::where('quotation_id', $id)
            ->orWhere('quotation_code', $id)
            ->update($input); // update QT revision = 1 && sales_status_id -1

        return redirect("sales/quotation/{$id}");
    }

    public function approve(Request $request, $id)
    {

        //รหัสเอกสาร
        //วันที่และเวลา
        //สถานะ
        $quotaion = QuotationModel::findOrFail($id);

        $input = [
            'quotation_code' => $quotaion->quotation_code,
            'datetime' => date('Y-m-d H:i:s'),
            'sales_status_id' => 1,
        ];
        // QuotationModel::update_by_id($input, $id);
        QuotationModel::where('quotation_id', $id)
            ->orWhere('quotation_code', $id)
            ->update($input);

        //3.REDIRECT
        return redirect("sales/quotation/{$id}")->with('flash_message', 'popup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuotationModel::destroy($id);
        return redirect("sales/quotation");
    }

}
