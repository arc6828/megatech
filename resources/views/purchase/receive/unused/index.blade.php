@extends('layouts/argon-dashboard/theme')

@section('title','ใบซื้อ/รับสินค้า')


@section('content')

<div class="card">
	<div class="card-body">
		
		<div class="table-responsive">
			<table class="table table-hover text-center table-sm  table-bordered" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">ชื่อลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_purchase_receive as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/purchase/receive/{{ $row->purchase_receive_id }}/edit">
								{{ $row->purchase_receive_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->total?$row->total:0 }}</td>
						<td>{{ $row->customer_name }}</td>
						<td>{{ $row->company_name }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->purchase_status_name }}</td>
						<td>
							<a href="#"><span class="fa fa-trash" style="color: red"></span></a>
							<div class="row d-none">
								<form action="{{ url('/') }}/purchase/receive/{{ $row->purchase_receive_id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit"></button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>

	</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("555");
    $('#table').DataTable().order( [ 1, 'desc' ] ).draw();
});

</script>

<div class="form-group">
	<div class="col-lg-12">
		<div class="text-center mt-4">
	  		<a class="btn btn-outline-primary" href="{{ url('/') }}/purchase">back</a>
        <a href="{{ url('/') }}/purchase/receive/create" class="btn btn-primary">
        	<i class="fa fa-plus"></i> เพิ่มใบซื้อ / รับสินค้า
        </a>
		</div>
	</div>
</div>
@endsection
