<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\ReceiveTemporaryModel;
use App\Purchase\ReceiveTemporaryDetailModel;

use App\SupplierModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\GaurdStock;
use App\Models\Numberun;
use PDF;

class ReceiveTemporaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_receive_temporary = ReceiveTemporaryModel::select_by_keyword($q);
      $table_receive_temporary = (Auth::user()->role === "admin" )?
          ReceiveTemporaryModel::select_all() :
          ReceiveTemporaryModel::select_all_by_user_id(Auth::id());

      $data = [
        //QUOTATION
        'table_receive_temporary' => $table_receive_temporary,
        'q' => $request->input('q')
      ];
      return view('purchase/receive_temporary/index',$data);
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
          'table_supplier' => SupplierModel::all(),
          'table_receive_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('receive_temporary'),
          //'table_purchase_user' => UserModel::select_by_role('purchase'),
          'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_receive_temporary_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/receive_temporary/create',$data);
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
          'receive_temporary_code' => $this->getNewCode(),
          'supplier_id' => $request->input('supplier_id'),
          'debt_duration' => $request->input('debt_duration',"0"),
          'billing_duration' => $request->input('billing_duration',"0"),
          'payment_condition' => $request->input('payment_condition',""),
          'receive_type_id' => $request->input('receive_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'receive_time' => $request->input('receive_time',"0"),
          'department_id' => $request->input('department_id'),
          //'purchase_status_id' => 10, //default is 10 สร้างใบส่งของชั่วคราว          
          'purchase_status_id' => $request->input('purchase_status_id'), //default is 0 DRAFT
          'user_id' => $request->input('user_id'),
          'staff_id' => $request->input('staff_id'),
          'zone_id' => $request->input('zone_id','0'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total_after_vat',0),
      ];
      //print_r($input);
      //exit();
      //VOID IF HAS CODE (Revision)
      
      if( !empty($request->input('receive_temporary_code') ) ){
        switch($request->input('receive_temporary_code')){
          case "M-RTDRAFT" : 
            $id =   $request->input('receive_temporary_id');
            ReceiveTemporaryModel::destroy($id);
            ReceiveTemporaryDetailModel::where('receive_temporary_id',$id)->delete();
            break;
          default :
            $q = ReceiveTemporaryModel::where('receive_temporary_code',$request->input('receive_temporary_code') )
              ->orderBy('datetime','desc')->first();
            $input['revision'] = $q->revision +1 ;
            $q->purchase_status_id = -1; //-1 means void
            $q->save();
            
            $segments = explode("-",$request->input('receive_temporary_code'));
            $input['receive_temporary_code'] = $segments[0]."-".$segments[1]."-R".$input['revision'];

            //ROLLBACK STOCK STATS IN PRODUCT AND GAURD STOCK
            //CREATE GAURD STOCK + UPDATE PRODUCT      
            foreach($q->receive_temporary_details as $item){
              $product = ProductModel::findOrFail($item['product_id']);
              $gaurd_stock = GaurdStock::create([
                "code" => $item['receive_temporary_id'],
                "type" => "purchase_dt_void",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
                "pending_in" => ($product->pending_in  ),
                "pending_out" => ($product->pending_out),
                "product_id" => $product->product_id,
              ]);
              
              //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
              $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
              $product->pending_in = $gaurd_stock['pending_in'];
              $product->pending_out = $gaurd_stock['pending_out'];
              $product->save();

            }  
        }
        
        
        
      }else{
        $id =   $request->input('receive_temporary_id');
        ReceiveTemporaryModel::destroy($id);
        ReceiveTemporaryDetailModel::where('receive_temporary_id',$id)->delete();
      }
      //DRAFT
      if($input['purchase_status_id'] == 0 )
      {
        //0 means DRAFT -> do not set quotation_code / date
        $input['receive_temporary_code'] = "RTDRAFT";
        $input['datetime'] = "";
      }
      $id = ReceiveTemporaryModel::insert($input);

      //INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $list[] = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "receive_temporary_id" => $id,
              "receive_duration" => "-",
          ];
        }
      }
      ReceiveTemporaryDetailModel::insert($list);

      //IF NOT DRAFT
      if($input['purchase_status_id'] > 0 )
      {
        //GAURD STOCK      
        foreach($list as $item){
          $product = ProductModel::findOrFail($item['product_id']);
          $gaurd_stock = GaurdStock::create([
            "code" => $id,
            "type" => "purchase_dt_create",
            "amount" => $item['amount'],
            "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
            "pending_in" => $product->pending_in,
            "pending_out" => $product->pending_out,
            "product_id" => $product->product_id,
          ]);
          
          //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
          $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
          $product->pending_in = $gaurd_stock['pending_in'];
          $product->pending_out = $gaurd_stock['pending_out'];
          $product->save();

        }
      }

      return redirect("purchase/receive_temporary/{$id}");
    }

    public function getNewCode(){
        $number = ReceiveTemporaryModel::select_count_by_current_month();
        $run_number = Numberun::where('id', '10')->value('number_en');
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $receive_temporary_code = "{$run_number}{$year}{$month}-{$number}";
        return $receive_temporary_code;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data = [
          //QUOTATION
          'table_receive_temporary' => ReceiveTemporaryModel::select_by_id($id),
          'receive_temporary' => ReceiveTemporaryModel::findOrFail($id),
          'table_supplier' => SupplierModel::all(),
          'table_receive_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('receive_temporary'),
          //'table_purchase_user' => UserModel::select_by_role('purchase'),
          'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'receive_temporary_id'=> $id,
          //QUOTATION Detail
          'table_receive_temporary_detail' => ReceiveTemporaryDetailModel::select_by_receive_temporary_id($id),
          'table_product' => ProductModel::select_all(),
          'mode'=>'show',
      ];
      return view('purchase/receive_temporary/edit',$data);
    }

    public function pdf($id)
    {
        //no show

      $data = [
          //QUOTATION
          'table_receive_temporary' => ReceiveTemporaryModel::select_by_id($id),
          'table_supplier' => SupplierModel::all(),
          'table_receive_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('receive_temporary'),
          //'table_purchase_user' => UserModel::select_by_role('purchase'),
          'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'receive_temporary_id'=> $id,
          //QUOTATION Detail
          'table_receive_temporary_detail' => ReceiveTemporaryDetailModel::select_by_receive_temporary_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      //return view('purchase/receive_temporary/edit',$data);

      $pdf = PDF::loadView('purchase/receive_temporary/show',$data);
      return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }

    public function cancel($id)
    {
      //
      $receive_temporary = ReceiveTemporaryModel::findOrFail($id);
      $receive_temporary->purchase_status_id = 11; //11 MEANS Cancelled
      $receive_temporary->save();      
      $list = $receive_temporary->receive_temporary_details;
      
      //GAURD STOCK      
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $id,
          "type" => "purchase_dt_cancel",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
          "pending_in" => $product->pending_in,
          "pending_out" => $product->pending_out,
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }

      return redirect("purchase/receive_temporary/{$id}/edit");
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
          'table_receive_temporary' => ReceiveTemporaryModel::select_by_id($id),
          'receive_temporary' => ReceiveTemporaryModel::findOrFail($id),
          'table_supplier' => SupplierModel::all(),
          'table_receive_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('receive_temporary'),
          //'table_purchase_user' => UserModel::select_by_role('purchase'),
          'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'receive_temporary_id'=> $id,
          //QUOTATION Detail
          'table_receive_temporary_detail' => ReceiveTemporaryDetailModel::select_by_receive_temporary_id($id),
          'table_product' => ProductModel::select_all(),
          'mode'=>'edit',
      ];
      return view('purchase/receive_temporary/edit',$data);
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
        //'receive_temporary_code' => $receive_temporary_code,
        'supplier_id' => $request->input('supplier_id'),
        'debt_duration' => $request->input('debt_duration'),
        'billing_duration' => $request->input('billing_duration'),
        'payment_condition' => $request->input('payment_condition',""),
        'receive_type_id' => $request->input('receive_type_id'),
        'tax_type_id' => $request->input('tax_type_id'),
        'receive_time' => $request->input('receive_time'),
        'department_id' => $request->input('department_id'),
        'purchase_status_id' => $request->input('purchase_status_id'),
        'user_id' => $request->input('user_id'),
        'zone_id' => $request->input('zone_id'),
        'remark' => $request->input('remark'),
        'vat_percent' => $request->input('vat_percent',7),
        'total' => $request->input('total_after_vat',0),
      ];
      ReceiveTemporaryModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      ReceiveTemporaryDetailModel::delete_by_receive_temporary_id($id);

      //3.INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $a = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "receive_temporary_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            //$a["receive_temporary_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }

      ReceiveTemporaryDetailModel::insert($list);
      //print_r($list);

      //4.REDIRECT
      return redirect("purchase/receive_temporary/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      ReceiveTemporaryModel::delete_by_id($id);
      return redirect("purchase/receive_temporary");
    }




}
