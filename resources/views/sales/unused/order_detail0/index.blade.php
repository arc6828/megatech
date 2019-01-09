@extends('monster-lite/layouts/theme')

@section('title','รายละเอียดรายการในใบเสนอราคา')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/sales/order/{{ $order_id }}/order_detail/create" class="pull-right  btn btn-success">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</a>
@endsection

@section('content')
	@include('sales/order_detail/table')

	<div class="form-group">
		<div class="col-lg-12">
			<div class="text-center">
		  		<a class="btn btn-outline-primary" href="{{ url('/') }}/sales/order/{{ $order_id }}/edit">back</a>
			</div>
		</div>
	</div>

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

@endsection
