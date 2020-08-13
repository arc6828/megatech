@extends('layouts/argon-dashboard/theme')

@section('title','ใบจอง')

@section('background-tag','bg-warning')

@section('navbar-menu')

@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/sales') }}" title="Back" class="btn btn-warning btn-sm" >
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>

		<div class="table-responsive">
			<table class="table table-sm table-hover text-center  table-bordered" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">พนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center d-none">รายละเอียด</th>
						<th class="text-center d-none">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_order as $row)

					<tr>
						<td>
							<a href="{{ url('/') }}/sales/order/{{ $row->order_id }}">
								{{ $row->order_code }}
							</a>
						</td>
						<td>{{ explode(" ", $row->datetime)[0] }}</td>
						<td>{{ $row->customer_code }}</td>
						<td><a href2="{{ url('customer') }}/{{ $row->customer_id }}/edit" target="_blank">{{ $row->company_name }}</a></td>
						<td class="text-right">{{ number_format($row->total,2) }}</td>
						<td><a href2="{{ url('user') }}/{{ $row->user_id }}" target="_blank">{{ $row->short_name }}</a></td>
						<td>
							
							@if( $row->sales_status_id == 7)
							<span class="badge badge-pill badge-warning">รอเบิกสินค้า</span>
							<a class="btn btn-sm btn-warning d-none"
							
								href="#"
								href2="{{ url('/') }}/sales/order_detail?order_id={{ $row->order_code }}">
								รอการเบิกสินค้า
							</a>
							@elseif($row->sales_status_id == 8)							
							<span class="badge badge-pill badge-primary">รอเปิด Invoice</span>
							<a class="btn btn-sm btn-success d-none"
								href="#"
								href2="{{ url('/') }}/sales/invoice/create?order_code={{ $row->order_code }}" >
								เปิด Invoice ใหม่
							</a>
							@else
							<span class="badge badge-pill badge-success">Invoice ครบแล้ว</span>
							{{-- $row->sales_status_name --}}
							@endif
							
						</td>
						<td class="text-left  d-none">
							@foreach($row->order_details as $order_detail)
								@switch($order_detail->order_detail_status_id)
									@case(1)
										<span class="badge badge-pill badge-primary" title="รอเบิกสินค้า">Y</span>
										@break
									@case(3)
										<span class="badge badge-pill badge-warning" title="รอเปิด Invoice">W</span>
										@break
									@case(4)
										<span class="badge badge-pill badge-success" title="Invoice แล้ว">IV</span>
										@break
								@endswitch
							@endforeach

						</td>
						<td class="d-none">
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->order_id }} )" class="text-danger">
								<span class="fa fa-trash"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>

    <div class="text-center mt-4">
      <a class="btn btn-outline-success " href="{{ url('/') }}/sales"><i class="fa fa-arrow-left" aria-hidden="true"></i> back</a>
      <a href="{{ url('/') }}/sales/order/create" class="btn btn-success">
      	<i class="fa fa-plus"></i> เพิ่มใบจอง
      </a>

    </div>
		<script>
		document.addEventListener("DOMContentLoaded", function(event) {
				$('#table').DataTable({
					"scrollY": "250px",
					"scrollCollapse": true,
					"paging":         false,
				}).order( [ 0, 'desc' ] ).draw();
		});

		</script>

	</div>
</div>

<div id="outer-form-container" style="display:none;">
	<form action="#" method="POST" id="form_delete" >
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
	<script>

		function onEdit(){
			console.log("edit",$('#myModal'));
			$('#myModal').on('show');
		}

		function onDelete(id){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

			//GET FORM BY ID
			var form = document.getElementById("form_delete");
			//CHANGE ACTION TO SPECIFY ID
			form.action = "{{ url('/') }}/sales/order/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this order ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
