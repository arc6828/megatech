@extends('monster-lite/layouts/theme')

@section('title','แก้ไขรายละเอียดใบขาย')

@section('navbar-menu')
<div style="margin: 21px;">
	<a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/invoice">back</a>
	<button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

	@forelse($table_invoice as $row)
		<form class="" action="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}" id="form" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			@include('sales/invoice/form')

			<div>
				<button type="submit" class="d-none" id="form-submit">Save</button>
			</div>

		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
				//INITIALIZE
				document.querySelector("#invoice_code").value = "{{ $row->invoice_code }}";
				document.querySelector("#external_reference_id").value = "{{ $row->external_reference_id }}";
				document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
				document.querySelector("#contact_name").value = "{{ $row->contact_name }}";
			  var str_time = moment("{{ $row->datetime }}").format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
				var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
				document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";
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

				onChange(document.querySelector("#vat_percent"));
			});

		</script>

	@empty
	<div class="text-center">
		This id does not exist
	</div>
	@endforelse

@endsection
