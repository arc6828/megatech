@extends('layouts/argon-dashboard/theme')

@section('title','ใบจอง')

@section('navbar-menu')

@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-body">
		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบจอง</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/sales/order" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
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
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center d-none">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_order as $row)

					<tr>
						<td>
							<a href="{{ url('/') }}/sales/order/{{ $row->order_id }}/edit">
								{{ $row->order_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->customer_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td class="number">{{ $row->total }}</td>
						<td>{{ $row->short_name }}</td>
						<td>{{ $row->sales_status_name }}</td>
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

    <div class="text-center">
      <a class="btn btn-outline-primary " href="{{ url('/') }}/sales">back</a>
      <a href="{{ url('/') }}/sales/order/create" class="btn btn-primary">
      	<i class="fa fa-plus"></i> เพิ่มใบจอง
      </a>

    </div>
		<script>
		document.addEventListener("DOMContentLoaded", function(event) {
				console.log("555");
        $('.number').each(function(index){
          var number = Number($(this).text()).toLocaleString("en",{minimumFractionDigits: 2});
          $(this).text(number);
        });
				$('#table').DataTable().order( [ 0, 'desc' ] ).draw();

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
