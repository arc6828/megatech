@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขรายละเอียดใบส่งของชั่วคราว')

@section('content')


	@forelse($table_delivery_temporary as $row)
		<form class="" action="{{ url('/') }}/sales/delivery_temporary/{{ $row->delivery_temporary_id }}" id="form" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			@include('sales/delivery_temporary/form')

			<div class="text-center mt-4">
				<a href="{{ url('/') }}/sales/delivery_temporary" class="btn btn-outline-primary" style="width:150px;">back</a>
				<button type="submit" class="btn btn-primary " id="form-submit" style="width:150px;">Save</button>
			</div>

		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
        $(".btn-print").attr("href","{{ url('/') }}/sales/delivery_temporary/{{ $row->delivery_temporary_id }}");
        $(".btn-print").removeClass("d-none");
				//INITIALIZE
				document.querySelector("#delivery_temporary_code").value = "{{ $row->delivery_temporary_code }}";
				document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
				//document.querySelector("#contact_name").value = "{{ $row->contact_name }}";
        document.querySelector("#customer_code").innerHTML  = "{{ $row->customer_code }}";
        document.querySelector("#company_name").value = "{{ $row->company_name }}";
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
