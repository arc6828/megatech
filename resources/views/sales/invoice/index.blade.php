@extends('layouts/argon-dashboard/theme')

@section('title','ใบขาย')


@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-body">

		<div class="table-responsive table-binvoiceed">
			<table class="table table-hover text-center" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_invoice as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}/edit">
								{{ $row->invoice_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->customer_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td>{{ $row->total?$row->total:0 }}</td>
						<td>{{ $row->short_name }}</td>
						<td>
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->invoice_id }} )" class="text-danger">
								<span class="fa fa-trash"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>

    <div class="text-center mt-4">
      <a class="btn btn-outline-primary" href="{{ url('/') }}/sales">back</a>
      <a href="{{ url('/') }}/sales/invoice/create" class="btn btn-primary">
      	<i class="fa fa-plus"></i> เพิ่มใบขาย
      </a>
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
			form.action = "{{ url('/') }}/sales/invoice/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this invoice ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
