@extends('monster-lite/layouts/theme')

@section('title','แก้ไขรายละเอียดใบเสนอราคา')

@section('navbar-menu')
<div style="margin: 21px;">
	<a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/quotation">back</a>
	<button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')
	<script>
	function validateForm(){
		var i=0;
		document.querySelectorAll(".discount_percent_edit").forEach(function(element,index){
			if(element.value < 40){
				alert("TOO LESS");
				i++;
			}
		});
		if(i>0){
			return false;
		}

	}
	</script>

	@forelse($table_quotation as $row)
		<form onsubmit="return validateForm()" class="" action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" id="form" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			@include('sales/quotation/form')

			<div>
				<button type="submit" class="d-none" id="form-submit">Save</button>
			</div>

		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
				//INITIALIZE
				document.querySelector("#quotation_code").value = "{{ $row->quotation_code }}";
				document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
				document.querySelector("#contact_name").value = "{{ $row->contact_name }}";
			  var str_time = moment("{{ $row->datetime }}").format('YYYY-MM-DDTHH:mm');  //console.log(str_time);
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
