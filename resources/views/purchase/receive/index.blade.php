@extends('layouts/argon-dashboard/theme')

@section('title','ใบรับ/ซื้อสินค้า')
@section('background-tag','bg-success')

@section('content')

<div class="card">
	<div class="card-body">
		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบรับ/ซื้อสินค้า</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/purchase/receive" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>
    
    <div class="mb-4">
      <a href="{{ url('/') }}/purchase" title="Back" class="btn btn-warning btn-sm">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>

		<div class="table-responsive">
			<table width="100%" class="table table-hover text-center table-sm  table-breceiveed table-striped" id="table">
				<thead>
					<tr>
						<th class="text-center d-none">#</th>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสเจ้าหนี้</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดหนี้คงค้าง</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center d-none">สถานะ</th>
						<th class="text-center d-none">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_purchase_receive as $row)

					<tr>
						<td class="d-none">
							{{ $row->purchase_receive_id }}
						</td>
						<td>
							<a href="{{ url('/') }}/purchase/receive/{{ $row->purchase_receive_id }}/edit">
								{{ $row->purchase_receive_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->supplier_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td>{{ number_format( $row->total_debt?$row->total_debt:0 ,2)}}</td>
						<td>{{ number_format( $row->total?$row->total:0 ,2)}}</td>
						<td>{{ $row->short_name }}</td>
						<td class="d-none">{{ $row->purchase_status_name }}</td>
						<td class="d-none">
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->purchase_receive_id }} )" class="text-danger">
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
				$('#table').DataTable().order( [ 1, 'desc' ] ).draw();
		});

		</script>



	</div>
</div>

<div class="mt-4 text-center">
  <a href="{{ url('/') }}/purchase/receive/create" class="btn btn-primary">
    <i class="fa fa-plus"></i> เพิ่มใบรับ/ซื้อสินค้า
  </a>
<div>

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
			form.action = "{{ url('/') }}/purchase/receive/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this purchase_receive ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
