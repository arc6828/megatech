<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerModel extends Model
{
	protected $table = 'tb_customer';
    protected $primaryKey = 'customer_id';
	protected $fillable = ['customer_code',
							'customer_type',
							'company_name',
							'account_id',
							'contact_name',
							'customer_code',
							'customer_name',
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
	public function checklist(){
		return $this->hasOne('App\Checklist','customer_id');
	}
	public function comments(){
		return $this->hasMany('App\Comment','value');
	}	
	public function contacts(){
		return $this->hasMany('App\Contact','customer_id');
	}	
	public function Quotation(){
		return $this->hasMany('App\Sales\QuotationModel','customer_id');
	}
	public function Order(){
		return $this->hasMany('App\Sales\OrderModel','customer_id');
	}
	public function Invoice(){
		return $this->hasMany('App\Sales\InvoiceModel','customer_id');
	}
	public function invoices(){
		return $this->hasMany('App\Sales\InvoiceModel','customer_id');
	}
    public function invoices_by_month($month){
        return $this->hasMany('App\Sales\InvoiceModel','customer_id')->whereMonth('datetime',$month);
    }
	public function Invoice_on_debt(){
		return $this->hasMany('App\Sales\InvoiceModel','customer_id')->where('total_debt','>',0);
	}
	
	public function XR_on_debt(){
		return $this->hasMany('App\CustomerDebt','customer_id')->where('total_debt','>',0);
	}
	public function Invoice_on_debt_last_cycle(){
		return $this->hasMany('App\Sales\InvoiceModel','customer_id')->where('total_debt','>',0)->where('datetime','<=',date('Y-m-t', strtotime( '-1 month' ) ));
	}
	public function Invoice_on_debt_billing(){
		//sales_status_id = 12 คือ วางบิลแล้ว
		return $this->hasMany('App\Sales\InvoiceModel','customer_id')->where('total_debt','>',0)->where('sales_status_id',12);
	}
	//Purchase
	public function Requisition()
    {
        return $this->hasMany('App\Purchase\RequisitionModel','customer_id');
    }
    public function PurchaseOrder()
    {
        return $this->hasMany('App\Purchase\OrderModel','customer_id');
    }
    public function Receive()
    {
        return $this->hasMany('App\Purchase\ReceiveModel','customer_id');
    }
	//user
	public function User()
      {
          return $this->belongsTo('App\User','user_id');
	  }
	  
	 // Customer


	public static function select_all(){
		return DB::table('tb_customer')->get();
	}

	public static function select_by_user_id($user_id){
		return DB::table('tb_customer')
			->where('user_id',$user_id)
			->get();
	}

	public static function select_by_keyword($q){
        return DB::table('tb_customer')
            ->where('tb_customer.company_name', 'like' , "%{$q}%" )
            ->get();
	}
	


	public static function select_zone() {
		return DB::table('tb_zone')->get();
	}
	public static function select_delivery_type() {
		return DB::table('tb_delivery_type')->get();
	}
	public static function select_location_type() {
		return DB::table('tb_location_type')->get();
	}
	public static function select_customer_type(){
		return DB::table('tb_customer_type')->get();
	}
	public static function insert($input) {
		return DB::table('tb_customer')->insertGetId($input);
	}
	public static function select_by_id($id) {
		return DB::table('tb_customer')
      ->join('users', 'tb_customer.user_id', '=', 'users.id')    
      ->where('customer_id', '=', $id)->get();
	}

  public static function select_upload_by_id($id) {
		$upload = DB::table('tb_customer')->where('customer_id', '=', $id)->first()->upload;
    return $upload==null?null:json_decode($upload);
	}

	public static function update_by_id($input,$id) {
        DB::table('tb_customer')
        ->where('customer_id', $id)
        ->update($input);
    }


	public static function delete_by_id($id){
		DB::table('tb_customer')
            ->where('customer_id', '=', $id)
            ->delete();
	}
    /*

    function select(){
		$sql = "select * from customer ";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from customer where id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from customer where id_customer like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_customer ,$type_customer, $name_company, $id_account, $name_customer, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $debt_balance){
		$sql = "insert into customer (id_customer, type_customer, name_company, id_account, name_customer, address, place_delivery, id_user, telephone, sales_area, transpot, note, credit, debt_period, degree_product, deposit_discount, tax_number, bill_condition, check_condition, location, branch, fax_number, debt_balance)
			values('{$id_customer}', '{$type_customer}', '{$name_company}', {$id_account}, '{$name_customer}', '{$address}', '{$place_delivery}', {$id_user}, '{$telephone}', '{$sales_area}', '{$transpot}', '{$note}', {$credit}, {$debt_period}, {$degree_product}, {$deposit_discount}, {$tax_number}, '{$bill_condition}', '{$check_condition}', '{$location}', '{$branch}', '{$fax_number}', {$debt_balance})";
		DB::insert($sql, []);
	}

	function update($type_customer, $name_company, $id_account, $name_customer, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $id){
		$sql = "update customer set
				 type_customer = '{$type_customer}', name_company = '{$name_company}', id_account = {$id_account}, name_customer = '{$name_customer}', address = '{$address}', place_delivery = '{$place_delivery}', id_user = {$id_user}, telephone = '{$telephone}', sales_area = '{$sales_area}', transpot = '{$transpot}', note = '{$note}', credit = {$credit}, debt_period = {$debt_period}, degree_product = {$degree_product}, deposit_discount = {$deposit_discount}, tax_number = '{$tax_number}', bill_condition = '{$bill_condition}', check_condition = '{$check_condition}', location = '{$location}', branch = '{$branch}', fax_number = '{$fax_number}'
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from customer where id = {$id}";
		DB::delete($sql, []);
	}
	function update_dept($debt_balance, $id_customer) {
		$sql = "update customer set debt_balance = {$debt_balance}
		where id_customer = '{$id_customer}'";
		DB::update($sql, []);
	}
    */
	
}
