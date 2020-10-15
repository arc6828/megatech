@extends('layouts/argon-dashboard/theme')

@section('title','ใบขาย')

@section('background-tag','bg-warning')


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
		<div class="table-responsive table-binvoiceed">
			<table width="100%" class="table table-hover text-center table-sm" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดหนี้คงค้าง</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($table_invoice as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}">
								{{ $row->invoice_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->customer_code }}</td>
						<td><a href2="{{ url('/customer') }}/{{ $row->customer_id }}/edit" target="_blank">{{ $row->company_name }}</a></td>
						<td>{{ number_format($row->total_debt,2)  }}</td>
						<td>{{ number_format($row->total?$row->total:0,2) }}</td>
						<td>{{ $row->short_name }}</td>
						<td>
						@switch($row->sales_status_id)							
							@case(-1)
								<span class="badge badge-pill badge-secondary">Void</span>
								@break
							@default
								<span class="badge badge-pill badge-success">Yes</span>
								@break
								{{-- $row->sales_status_name --}}
						@endswitch
							
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>

    <div class="text-center mt-4">
      <a class="btn btn-outline-success" href="{{ url('/') }}/sales"><i class="fa fa-arrow-left" aria-hidden="true"></i> back</a>
      <a href="{{ url('/') }}/sales/invoice/create" class="btn btn-success">
      	<i class="fa fa-plus"></i> เพิ่มใบขาย
      </a>
    </div>
		<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			console.log("555");
			$('#table').DataTable({
				"paging" : false,
			}).order( [ 0, 'desc' ] ).draw();

			//DATA TABLE SCROLL
			var tableCont = document.querySelector('#table');
			tableCont.parentNode.style.overflow = 'auto';
			tableCont.parentNode.style.maxHeight = '400px';
			tableCont.parentNode.addEventListener('scroll',function (e){
				var scrollTop = this.scrollTop-1;
				this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 1000 + 'px)';
				this.querySelector('thead').style.background = "white";
				this.querySelector('thead').style.zIndex = "3000";
				//this.querySelector('thead').style.marginBottom = "200px";
				//console.log(scrollTop);
			})
			//END DATA TABLE SCROLL
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
