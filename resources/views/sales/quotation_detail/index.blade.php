@extends('monster-lite/layouts/theme')

@section('title','รายละเอียดรายการในใบเสนอราคา')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/sales/quotation/{{ $quotation_id }}/quotation_detail/create" class="pull-right  btn btn-success">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</a>
@endsection

@section('content')
	@include('sales/quotation_detail/table')

	<div class="form-group">
		<div class="col-lg-12">
			<div class="text-center">
		  		<a class="btn btn-outline-primary" href="{{ url('/') }}/sales/quotation/{{ $quotation_id }}/edit">back</a>
			</div>
		</div>
	</div>
@endsection
