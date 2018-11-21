@extends('monster-lite/layouts/theme')

@section('title','แก้ไขรายละเอียดใบเสนอราคา')

@section('breadcrumb-menu')

@endsection

@section('content')

@forelse($table_order as $row)
<form id="form-delete" style="display: none;" action="{{ url('/') }}/sales/order/{{ $row->order_id }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
	<button class="btn btn-danger" type="submit">
		<i class="fa fa-trash-o"></i> Remove
	</button>
</form>
<form class="" action="{{ url('/') }}/sales/order/{{ $row->order_id }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="card">
		<div class="card-block">
			<div class="row">
			<div class="col-lg-9 align-self-center">
				<h4 class="card-title">Order code : {{ $row->order_code }}</h4>
				<h6 class="card-subtitle">Update infomation in the form</h6>
			</div>
			<div class="col-lg-3 align-self-center">
				<div class="dropdown pull-right">
					<button type="button" class="btn btn-secondary btn-circle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="border: none;"><i class="fa fa-ellipsis-v"></i> </button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

					<a class="dropdown-item" href="javascript:document.getElementById('form-delete').submit();">
						<i class="fa fa-trash-o"></i> Remove
					</a>
					</div>
				</div>
			</div>
			</div>

			<div>
			<div class="form-group form-inline">
				<label class="col-lg-2">รหัสลูกค้า</label>
				<div class="col-lg-3">
					<select name="customer_id" class="form-control" required>
						<option value="" >None</option>
						@foreach($table_customer as $row_customer)
						<option value="{{ $row_customer->customer_id }}" {{ $row_customer->customer_id === $row->customer_id ? "selected":"" }}>
							{{	$row_customer->customer_name }}
						</option>
						@endforeach
					</select>
				</div>
				<label class="col-lg-2 offset-lg-1">วันที่เวลา</label>
				<div class="col-lg-3">
					<input type="datetime-local" name="datetime" class="form-control form-control-line"	value="" readonly>
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">ระยะเวลาหนี้</label>
				<div class="col-lg-3">
					<input type="number" name="debt_duration"	class="form-control form-control-line"	value="{{ $row->debt_duration }}" >
				</div>
				<label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
				<div class="col-lg-3">
					<input type="number" name="billing_duration"	class="form-control form-control-line" value="{{ $row->billing_duration }}" >
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
				<div class="col-lg-3">
					<input name="payment_condition"	class="form-control form-control-line" value="{{ $row->payment_condition }}" >
				</div>
				<label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
				<div class="col-lg-3">
					<select name="delivery_type_id" class="form-control" required>
						<option value="" >None</option>
						@foreach($table_delivery_type as $row_delivery_type)
						<option value="{{ $row_delivery_type->delivery_type_id }}" {{ $row_delivery_type->delivery_type_id === $row->delivery_type_id ? "selected":"" }}>
							{{	$row_delivery_type->delivery_type_name }}
						</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">ชนิดภาษี</label>
				<div class="col-lg-3">
					<select name="tax_type_id" id="tax_type_id" class="form-control" onkeyup="onChange(this)" onChange="onChange(this)"  required>
						<option value="" >None</option>
						@foreach($table_tax_type as $row_tax_type)
						<option value="{{ $row_tax_type->tax_type_id }}" {{ $row_tax_type->tax_type_id === $row->tax_type_id ? "selected":"" }}>
							{{	$row_tax_type->tax_type_name }}
						</option>
						@endforeach
					</select>
				</div>
				<label class="col-lg-2 offset-lg-1">ระยะเวลาส่งของ (วัน)</label>
				<div class="col-lg-3">
				<input type="number" name="delivery_time"	class="form-control form-control-line" value="{{ $row->delivery_time }}" >
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">รหัสแผนก</label>
				<div class="col-lg-3">
				<input type="number" name="department_id"	class="form-control form-control-line" value="{{ $row->department_id }}" readonly="">
				</div>
				<label class="col-lg-2 offset-lg-1">สถานะ</label>
				<div class="col-lg-3">
					<select name="sales_status_id" class="form-control" required>
						<option value="" >None</option>
						@foreach($table_sales_status as $row_sales_status)
						<option value="{{ $row_sales_status->sales_status_id }}" {{ $row_sales_status->sales_status_id === $row->sales_status_id ? "selected":"" }}>
							{{	$row_sales_status->sales_status_name }}
						</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group form-inline">
				<label class="col-lg-2">รหัสพนักงานขาย</label>
				<div class="col-lg-3">
					<select name="user_id" class="form-control" required>
						<option value="" >None</option>
						@foreach($table_sales_user as $row_sales_user)
						<option value="{{ $row_sales_user->id }}" {{ $row_sales_user->id === $row->user_id ? "selected":"" }}>
							{{	$row_sales_user->name }}
						</option>
						@endforeach
					</select>
				</div>
				<label class="col-lg-2 offset-lg-1">เขตการขาย</label>
				<div class="col-lg-3">
					<select name="zone_id" class="form-control" required>
						<option value="" >None</option>
						@foreach($table_zone as $row_zone)
						<option value="{{ $row_zone->zone_id }}" {{ $row_zone->zone_id === $row->zone_id ? "selected":"" }}>
							{{	$row_zone->zone_name }}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group form-inline">
				<label class="col-lg-2 ">หมายเหตุ</label>
				<div class="col-lg-3">
				<input name="remark"	class="form-control form-control-line" value="{{ $row->remark }}" >
				</div>
			</div>
			</div>
		</div>
	</div>

	@include('sales/order_detail/table')

	<div class="card">
		<div class="card-block">
			<div class="row">
			<div class="col-lg-12">
				<div class="form-group form-inline">
					<input type="hidden" name="total" id="total"	class="form-control form-control-line" value="{{ $row->total }}" readonly disabled>

					<label class="col-lg-3 offset-lg-6">ยอดรวมก่อนภาษี</label>
					<div class="col-lg-3">
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-line" value="" readonly disabled>
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-3">อัตราภาษี (%)</label>
					<div class="col-lg-3">
						<input type="number" name="vat_percent"  id="vat_percent" value="{{ $row->vat_percent }}" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-line" >
						</div>
					<label class="col-lg-3">มูลค่าภาษี</label>
					<div class="col-lg-3">
						<input type="number" name="vat" id="vat" value="{{ $row->vat }}" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-line" readonly disabled >
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-3 offset-lg-6">ยอดสุทธิ</label>
					<div class="col-lg-3">
						<input type="number" name="total_after_vat" id="total_after_vat"		value="" class="form-control form-control-line"  readonly >
					</div>
				</div>
			</div>
			</div>

			<div class="form-group">
				<div class="col-lg-12">
				<div class="text-center">
					<a class="btn btn-outline-primary" href="{{ url('/') }}/sales/order">back</a>
					<button class="btn btn-success" type="submit" >Update</button>
				</div>
				</div>
			</div>

		</div>
	</div>

</form>
<div style="display:none;">
	<form action="#" method="POST" id="form_delete" >
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
	<script>
		function onDelete(id){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

			//GET FORM BY ID
			var form = document.getElementById("form_delete");
			//CHANGE ACTION TO SPECIFY ID
			form.action = "{{ url('/') }}/sales/order/{{ $order_id }}/order_detail/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this order detail?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>
<script>
function onChange(obj){
	var vat = document.getElementById("vat");
	var vat_percent = document.getElementById("vat_percent");
	var total = document.getElementById("total");
	var total_before_vat = document.getElementById("total_before_vat");
	var total_after_vat = document.getElementById("total_after_vat");
	var tax_type_id = document.getElementById("tax_type_id");
	//console.log("print",vat,vat_percent,total_before_vat);

	//INPUT DETECTOR
	switch (obj.id) {
		case "vat_percent":
			//EFFECT TO #vat
			vat.value = total.value * (vat_percent.value) / 100;
			break;
		case "vat":
			//EFFECT TO #vat_percent
			vat_percent.value = vat.value / total.value * 100;
			break;
	}

	//DISPLAY ON TOTAL
	vat_percent.disabled = false;
	vat_percent.readonly = false;
	switch (tax_type_id.value) {
		case "1":
			//EFFECT TO #vat
			console.log("CASE 1");
			total_before_vat.value = total.value -  vat.value*1;
			total_after_vat.value = total.value ;
			break;
		case "2":
			//EFFECT TO #vat_percent
			console.log("CASE 2");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value*1 + vat.value*1;
			break;
		default:
			vat_percent.disabled = true;
			vat_percent.readonly = true;
			vat_percent.value = 0;
			vat.value = 0;
			console.log("CASE OTHERS");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value;
			break;
	}
}
window.onload = onChange(document.getElementById("tax_type_id"));
</script>

@empty
<div class="text-center">
	This id does not exist
</div>
@endforelse


@endsection

@section('plugins-js')
<script type="text/javascript">
	$(function(){

	var dateControl = document.querySelector('input[type="datetime-local"]');
	//dateControl.value = '2017-06-01T08:30';
	var str_time = moment("{{ $row->datetime }}").format('YYYY-MM-DDTHH:mm');
	//console.log(str_time);
	dateControl.value = str_time;
	});

</script>
@endsection
