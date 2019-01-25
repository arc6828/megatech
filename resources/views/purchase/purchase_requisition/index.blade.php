@extends('monster-lite/layouts/theme')

@section('title','ใบเสนอซื้อ')

@section('navbar-menu')
<div style="margin:21px;">
<a class="btn btn-outline-primary  btn-sm" href="{{ url('/') }}/purchase">back</a>
<a href="{{ url('/') }}/purchase/purchase_requisition/create" class="btn btn-primary btn-sm">
	<i class="fa fa-plus"></i> เพิ่มใบเสนอซื้อ
</a>
<div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-block">
		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบเสนอซื้อ</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/purchase/purchase_requisition" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>



		<div class="table-responsive table-bpurchase_requisitioned">
			<table class="table table-hover text-center" id="table">
				<thead>
					<tr>
						<th class="text-center">#</th>
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
					@foreach($table_purchase_requisition as $row)

					<tr>
						<td>
							{{ $row->purchase_requisition_id }}
						</td>
						<td>
							<a href="{{ url('/') }}/purchase/purchase_requisition/{{ $row->purchase_requisition_id }}/edit">
								{{ $row->purchase_requisition_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->total }}</td>
						<td>{{ $row->customer_name }}</td>
						<td>{{ $row->company_name }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->purchase_status_name }}</td>
						<td>
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->purchase_requisition_id }} )" class="text-danger">
								<span class="fa fa-trash"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
		<script>
		document.addEventListener("DOMContentLoaded", function(event) {
				console.log("555");
				$('#table').DataTable();
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
			form.action = "{{ url('/') }}/purchase/purchase_requisition/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this purchase_requisition ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
