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

	@forelse($table_quotation as $row)
		<form class="" action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" id="form" method="POST">
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
				document.querySelector("#").value = "";
			});

		</script>

	@empty
	<div class="text-center">
		This id does not exist
	</div>
	@endforelse

@endsection
