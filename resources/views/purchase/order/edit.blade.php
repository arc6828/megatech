@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขรายละเอียดใบสั่งซื้อ')



@section('content')

	@forelse($table_purchase_order as $row)
    <div class="text-center mb-4">
    	<a class="float-right btn-print" href="{{ url('/') }}/purchase/order/{{ $row->purchase_order_id }}" target="_blank">
		      <i class="fas fa-print"></i>
		    </a>
      <div class="">
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->purchase_order_code, "C128") }}" alt="barcode"   />
      </div>
      <div class="">
        {{ $row->purchase_order_code }}
      </div>

    </div>
		<form class="" action="{{ url('/') }}/purchase/order/{{ $row->purchase_order_id }}" id="form" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			@include('purchase/order/form')

			<div class="text-center mt-4">
      	<a class="btn btn-outline-primary" href="{{ url('/') }}/purchase/order">back</a>
        <button type="submit" class="btn btn-primary" id="form-submit">Save</button>
      </div>

		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
				//INITIALIZE
				document.querySelector("#purchase_order_code").value = "{{ $row->purchase_order_code }}";
				document.querySelector("#external_reference_doc").value = "{{ $row->external_reference_doc }}";
				document.querySelector("#supplier_id").value = "{{ $row->supplier_id }}";
				document.querySelector("#company_name").value = "{{ $row->company_name }}";
				document.querySelector("#supplier_code").innerHTML = "{{ $row->supplier_code }}";
			  var str_time = moment("{{ $row->datetime }}").format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
				var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
				document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";
				document.querySelector("#billing_duration").value = "{{ $row->billing_duration }}";
				document.querySelector("#payment_condition").value = "{{ $row->payment_condition }}";
				document.querySelector("#delivery_type_id").value = "{{ $row->delivery_type_id }}";
				document.querySelector("#tax_type_id").value = "{{ $row->tax_type_id }}";
				document.querySelector("#delivery_time").value = "{{ $row->delivery_time }}";
				document.querySelector("#department_id").value = "{{ $row->department_id }}";
				document.querySelector("#purchase_status_id").value = "{{ $row->purchase_status_id }}";
				document.querySelector("#user_id").value = "{{ $row->user_id }}";
				document.querySelector("#zone_id").value = "{{ $row->zone_id }}";
				document.querySelector("#total").value = "{{ $row->total }}";
				document.querySelector("#remark").value = "{{ $row->remark }}";
				document.querySelector("#vat_percent").value = "{{ $row->vat_percent }}";

				onChange(document.querySelector("#vat_percent"));
			});

		</script>

	@empty
	<div class="text-center">
		This id does not exist
	</div>
	@endforelse

@endsection
