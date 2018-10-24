@extends('monster-lite/layouts/theme')

@section('title','แก้ไขรายละเอียดใบเสนอราคา')

@section('breadcrumb-menu')

@endsection

@section('content')

@forelse($table_purchase_order_detail as $row)
<form action="{{ url('/') }}/purchase/purchase_order/{{ $row->purchase_order_id }}/purchase_order_detail/{{ $row->purchase_order_detail_id }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="card">
		<div class="card-block">
			<div class="row">
				<div class="col-lg-9 align-self-center">
					<h4 class="card-title">Purchase Order detail id : {{ $row->purchase_order_detail_id }} </h4>
					<h6 class="card-subtitle">Update infomation in the form</h6>
				</div>
				<div class="col-lg-3 align-self-center">

				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">รหัสสินค้า</label>
				<div class="col-lg-3">
					{{ $row->product_code }}
				</div>
				<label class="col-lg-2 offset-lg-1">ชื่อสินค้า</label>
				<div class="col-lg-3">
					{{ $row->product_name }}
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">จำนวน</label>
				<div class="col-lg-3">
					<input type="number" name="amount" id="amount"  value="{{ $row->amount }}" onkeyup="onChange(this)" onChange="onChange(this)" 	class="form-control form-control-line"	 >
				</div>
				<label class="col-lg-2 offset-lg-1">ส่วนลด %</label>
				<div class="col-lg-3">
					<input type="number" name="discount_percent" id="discount_percent" value="{{ 100 - $row->discount_price/$row->normal_price*100  }}" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-line" >
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">ราคาตั้ง</label>
				<div class="col-lg-3">
					{{ $row->normal_price }}
					<input type="hidden" name="normal_price"  id="normal_price" value="{{ $row->normal_price }}" >
				</div>
				<label class="col-lg-2 offset-lg-1">ราคาขาย</label>
				<div class="col-lg-3">
					<input type="number" name="discount_price"  id="discount_price" value="{{ $row->discount_price }}" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-line" >
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">ราคารวม</label>
				<div class="col-lg-3">
					<input type="number" name="total"  id="total" value="{{ $row->discount_price *  $row->amount }}" readonly disabled class="form-control">
				</div>
			</div>


			<div class="form-group">
				<div class="col-lg-12">
					<div class="text-center">
						<a class="btn btn-outline-primary" href="{{ url('/') }}/purchase/purchase_order/{{ $purchase_order_id}}/purchase_order_detail">back</a>
						<button class="btn btn-success" type="submit" >Update</button>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
<script>
function onChange(obj){
	var discount_price = document.getElementById("discount_price");
	var discount_percent = document.getElementById("discount_percent");
	var normal_price = document.getElementById("normal_price");
	var total = document.getElementById("total");
	var amount = document.getElementById("amount");
	//console.log("print",discount_price,discount_percent,normal_price);
	switch (obj.id) {
		case "discount_percent":
			//EFFECT TO #discount_price
			discount_price.value = normal_price.value - normal_price.value * (discount_percent.value) / 100;

			break;
		case "discount_price":
			//EFFECT TO #discount_percent
			discount_percent.value = 100.0 - discount_price.value / normal_price.value * 100;
			break;
	}
	//EFFECT TO #total
	total.value = amount.value * discount_price.value;
	//console.log(obj.value, obj.id);
}
</script>
@empty

@endforelse

@endsection
