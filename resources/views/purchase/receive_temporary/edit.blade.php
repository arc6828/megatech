@extends('layouts/argon-dashboard/theme')


@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('level-1-url', url('purchase/receive_temporary'))
@section('level-1','ใบรับของชั่วคราว')

@if( isset($mode) )
@if( $mode == "edit" )
  @section('level-2-url', url('purchase/receive_temporary/'.$receive_temporary->receive_temporary_id ))
  @section('level-2','รายละเอียด')
@endif

@section('title', $mode == "edit" ? 'แก้ไข' : 'รายละเอียด')
@endif


@section('background-tag','bg-success')

@section('content')


	@forelse($table_receive_temporary as $row)
		<form class="d-none" action="{{ url('/') }}/purchase/receive_temporary/{{ $row->receive_temporary_id }}/cancel" id="form-cancel" method="POST" onsubmit="return confirm('Do you confirm to cancel?')">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<button type="submit" class="btn btn-primary " id="form-cancel-submit" style="width:150px;">Save</button>
			

		</form>

		<form method="POST" action="{{ url('/') }}/purchase/receive_temporary/{{ $row->receive_temporary_id }}" accept-charset="UTF-8" style="display:none">
			{{ method_field('DELETE') }}
			{{ csrf_field() }}
			<button type="submit" id="form-delete-submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
		</form>

		<form class="" action="{{ url('/') }}/purchase/receive_temporary" id="form" method="POST">
			{{ csrf_field() }}

			@include('purchase/receive_temporary/form')
			@if($row->purchase_status_id != 11)
			@if($mode == "edit")
			<div class="text-center mt-4">
				<a href="{{ url('/') }}/purchase/receive_temporary" class="btn btn-outline-primary" style="width:150px;">back</a>
				<button type="submit" class="btn btn-primary " id="form-submit" style="width:150px;">Save</button>
			</div>
			@endif
			@endif
		</form>

		<script >
			document.addEventListener("DOMContentLoaded", function(event) {
        $(".btn-print").attr("href","{{ url('/') }}/purchase/receive_temporary/{{ $row->receive_temporary_id }}");
        $(".btn-print").removeClass("d-none");
				//INITIALIZE
				document.querySelector("#receive_temporary_code").value = "{{ $row->receive_temporary_code }}";
				document.querySelector("#supplier_id").value = "{{ $row->supplier_id }}";
				//document.querySelector("#contact_name").value = "{{ $row->contact_name }}";
        document.querySelector("#supplier_code").innerHTML  = "{{ $row->supplier_code }}";
        document.querySelector("#company_name").value = "{{ $row->company_name }}";
				 var str_time = moment("{{ $row->datetime }}").format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
				var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
				document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";
				document.querySelector("#billing_duration").value = "{{ $row->billing_duration }}";
				document.querySelector("#payment_condition").value = "{{ $row->payment_condition }}";
				document.querySelector("#receive_type_id").value = "{{ $row->receive_type_id }}";
				document.querySelector("#tax_type_id").value = "{{ $row->tax_type_id }}";
				document.querySelector("#receive_time").value = "{{ $row->receive_time }}";
				document.querySelector("#department_id").value = "{{ $row->department_id }}";
				//document.querySelector("#purchase_status_id").value = "{{ $row->purchase_status_id }}";
				document.querySelector("#user_id").value = "{{ $row->user_id }}";
				document.querySelector("#staff_id").value = "{{ $row->staff_id }}";
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
