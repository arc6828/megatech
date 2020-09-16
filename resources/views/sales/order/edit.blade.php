@extends('layouts/argon-dashboard/theme')

@section('title','รายละเอียดใบจอง')

@section('background-tag','bg-warning')

@section('navbar-menu')
<div style="margin: 21px;">
	<a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/order">back</a>
	<button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

	@forelse($table_order as $row)
		
		<form class="" action="{{ url('/') }}/sales/order" id="form" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('POST') }}

			@include('sales/order/form')

			@if($mode == "edit")

			<div class="text-center mt-4">
				<a href="{{ url('/') }}/sales/order" class="btn btn-outline-success" style="width:150px;">back</a>
				<button type="submit" class="btn btn-success" id="form-submit" style="width:150px;">Save</button>
			</div>
			@endif

		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
				//INITIALIZE
				document.querySelector("#order_code").value = "{{ $row->order_code }}";
				document.querySelector("#external_reference_id").value = "{{ $row->external_reference_id }}";
				document.querySelector("#external_reference_id").setAttribute("data","{{ $row->external_reference_id }}") ;
				document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
				document.querySelector("#customer_code").innerHTML = "{{ $row->customer_code }}";
				document.querySelector("#company_name").value = "{{ $row->company_name }}";
			  var str_time = moment("{{ $row->datetime }}").format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
				var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
				document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";
        console.log("debt_duration",{{ $row->debt_duration }});
				document.querySelector("#billing_duration").value = "{{ $row->billing_duration }}";
				document.querySelector("#payment_condition").value = "{{ $row->payment_condition }}";
				document.querySelector("#delivery_type_id").value = "{{ $row->delivery_type_id }}";
				document.querySelector("#tax_type_id").value = "{{ $row->tax_type_id }}";
				document.querySelector("#delivery_time").value = "{{ $row->delivery_time }}";
				document.querySelector("#department_id").value = "{{ $row->department_id }}";
				document.querySelector("#sales_status_id").value = "{{ $row->sales_status_id }}";
				document.querySelector("#user_id").value = "{{ $row->user_id }}";
				document.querySelector("#zone_id").value = "{{ $row->zone_id }}";
				document.querySelector("#total").value = "{{ $row->total }}";
				document.querySelector("#remark").value = "{{ $row->remark }}";
				document.querySelector("#vat_percent").value = "{{ $row->vat_percent }}";
				document.querySelector("#max_credit").value = "{{ $row->max_credit }}";
				document.querySelector("#total_debt").value = "{{ $row->total_debt }}";

				onChange(document.querySelector("#vat_percent"));
				$('form input').keydown(function (e) {
					if (e.keyCode == 13) {
						e.preventDefault();
						return false;
					}
				});

			});

		</script>

	@empty
	<div class="text-center">
		This id does not exist
	</div>
	@endforelse

@endsection
