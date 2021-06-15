<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupplierModel extends Model
{
  protected $table = 'tb_supplier';
  protected $primaryKey = 'supplier_id';
  protected $fillable = [
    'supplier_code',
    'supplier_type',
    'company_name',
    'account_id',
    'contact_name',
    'supplier_name',
    'address',
    'address2',
    'sub_district',
    'district',
    'province',
    'zipcode',
    'delivery_address',
    'delivery_address2',
    'delivery_sub_district',
    'delivery_district',
    'delivery_province',
    'delivery_zipcode',
    'user_id',
    'telephone',
    'fax',
    'email',
    'zone_id',
    'delivery_type_id',
    'remark',
    'max_credit',
    'debt_duration',
    'degree_product',
    'loyalty_discount',
    'tax_number',
    'billing_duration',
    'cheqe_condition',
    'delivery_time',
    'payment_condition',
    'tax_type_id',
    'location_type_id',
    'branch_id',
    'debt_balance',
    'upload',
    'contact',
    'payment_method',
    'file_map',
    'file_cc',
    'file_cv_20',
    'file_cheque',

  ];
  //Relationships	
  //sales		
  public function checklist()
  {
    return $this->hasOne('App\Checklist', 'supplier_id');
  }
  public function comments()
  {
    return $this->hasMany('App\Comment', 'value');
  }
  public function contacts()
  {
    return $this->hasMany('App\Contact', 'supplier_id');
  }
  public function contacts2()
  {
    return $this->hasMany('App\Contact', 'supplier_id');
  }

  public function Quotation()
  {
    return $this->hasMany('App\Sales\QuotationModel', 'supplier_id');
  }
  public function Order()
  {
    return $this->hasMany('App\Sales\OrderModel', 'supplier_id');
  }
  public function Invoice()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id');
  }
  public function invoices()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id');
  }
  public function invoices_by_month($month)
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id')->whereMonth('datetime', $month);
  }
  public function Invoice_on_debt()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id')->where('total_debt', '>', 0);
  }
  public function XP_on_debt()
  {
    return $this->hasMany('App\SupplierDebt', 'supplier_id')->where('total_debt', '>', 0);
  }
  public function Invoice_on_debt_last_cycle()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id')->where('total_debt', '>', 0)->where('datetime', '<=', date('Y-m-t', strtotime('-1 month')));
  }
  public function Invoice_on_debt_billing()
  {
    //sales_status_id = 12 คือ วางบิลแล้ว
    return $this->hasMany('App\Sales\InvoiceModel', 'supplier_id')->where('total_debt', '>', 0)->where('sales_status_id', 12);
  }
  //Purchase
  public function Requisition()
  {
    return $this->hasMany('App\Purchase\RequisitionModel', 'supplier_id');
  }
  public function PurchaseOrder()
  {
    return $this->hasMany('App\Purchase\OrderModel', 'supplier_id');
  }
  public function purchase_order_detail()
  {
    return $this->hasMany('App\Purchase\OrderDetailModel', 'supplier_id');
  }
  public function Receive()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id');
  }
  public function Receives()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id');
  }
  public function Receives_on_debt()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id')->where('total_debt', '>', 0);
  }
  public function Receives_by_month($month)
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id')->whereMonth('datetime', $month);
  }
  public function Receives_on_debt_last_cycle()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id')->where('total_debt', '>', 0)->where('datetime', '<=', date('Y-m-t', strtotime('-1 month')));
  }
  public function Receives_on_debt_billing()
  {
    //purchase_status_id = 12 คือ วางบิลแล้ว
    return $this->hasMany('App\Purchase\ReceiveModel', 'supplier_id')->where('total_debt', '>', 0)->where('purchase_status_id', 12);
  }
  //user
  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  // Supplier


  // public static function select_all()
  // {
  //   return DB::table('tb_supplier')->get();
  // }

  // public static function select_by_user_id($user_id)
  // {
  //   return DB::table('tb_supplier')
  //     ->where('user_id', $user_id)
  //     ->get();
  // }

  // public static function select_by_keyword($q)
  // {
  //   return DB::table('tb_supplier')
  //     ->where('tb_supplier.company_name', 'like', "%{$q}%")
  //     ->get();
  // }



  // public static function select_zone()
  // {
  //   return DB::table('tb_zone')->get();
  // }
  // public static function select_delivery_type()
  // {
  //   return DB::table('tb_delivery_type')->get();
  // }
  // public static function select_location_type()
  // {
  //   return DB::table('tb_location_type')->get();
  // }
  // public static function select_supplier_type()
  // {
  //   return DB::table('tb_supplier_type')->get();
  // }
  // public static function insert($input)
  // {
  //   return DB::table('tb_supplier')->insertGetId($input);
  // }
  // public static function select_by_id($id)
  // {
  //   return DB::table('tb_supplier')
  //     ->join('users', 'tb_supplier.user_id', '=', 'users.id')
  //     ->where('supplier_id', '=', $id)->get();
  // }

  // public static function select_upload_by_id($id)
  // {
  //   $upload = DB::table('tb_supplier')->where('supplier_id', '=', $id)->first()->upload;
  //   return $upload == null ? null : json_decode($upload);
  // }

  // public static function update_by_id($input, $id)
  // {
  //   DB::table('tb_supplier')
  //     ->where('supplier_id', $id)
  //     ->update($input);
  // }


  // public static function delete_by_id($id)
  // {
  //   DB::table('tb_supplier')
  //     ->where('supplier_id', '=', $id)
  //     ->delete();
  // }
  /*

    function select(){
		$sql = "select * from supplier ";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from supplier where id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from supplier where id_supplier like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_supplier ,$type_supplier, $name_company, $id_account, $name_supplier, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $debt_balance){
		$sql = "insert into supplier (id_supplier, type_supplier, name_company, id_account, name_supplier, address, place_delivery, id_user, telephone, sales_area, transpot, note, credit, debt_period, degree_product, deposit_discount, tax_number, bill_condition, check_condition, location, branch, fax_number, debt_balance)
			values('{$id_supplier}', '{$type_supplier}', '{$name_company}', {$id_account}, '{$name_supplier}', '{$address}', '{$place_delivery}', {$id_user}, '{$telephone}', '{$sales_area}', '{$transpot}', '{$note}', {$credit}, {$debt_period}, {$degree_product}, {$deposit_discount}, {$tax_number}, '{$bill_condition}', '{$check_condition}', '{$location}', '{$branch}', '{$fax_number}', {$debt_balance})";
		DB::insert($sql, []);
	}

	function update($type_supplier, $name_company, $id_account, $name_supplier, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $id){
		$sql = "update supplier set
				 type_supplier = '{$type_supplier}', name_company = '{$name_company}', id_account = {$id_account}, name_supplier = '{$name_supplier}', address = '{$address}', place_delivery = '{$place_delivery}', id_user = {$id_user}, telephone = '{$telephone}', sales_area = '{$sales_area}', transpot = '{$transpot}', note = '{$note}', credit = {$credit}, debt_period = {$debt_period}, degree_product = {$degree_product}, deposit_discount = {$deposit_discount}, tax_number = '{$tax_number}', bill_condition = '{$bill_condition}', check_condition = '{$check_condition}', location = '{$location}', branch = '{$branch}', fax_number = '{$fax_number}'
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from supplier where id = {$id}";
		DB::delete($sql, []);
	}
	function update_dept($debt_balance, $id_supplier) {
		$sql = "update supplier set debt_balance = {$debt_balance}
		where id_supplier = '{$id_supplier}'";
		DB::update($sql, []);
	}
    */
}
