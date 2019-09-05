@extends('layouts/argon-dashboard/theme')

@section('title','ใบเสนอราคา')

@section('content')

<div class="card">
	<div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/sales') }}" title="Back" class="btn btn-warning btn-sm" >
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>
    <div class="table-responsive">
			<table class="table table-sm table-hover text-center table-bordered table-striped" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center d-none">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_quotation as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/edit">
								{{ $row->quotation_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->customer_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td class="text-right">{{ number_format($row->total?$row->total:0,2) }}</td>
						<td>{{ $row->short_name }}</td>
						<td>
              @if( $row->sales_status_id >= 1 &&  $row->sales_status_id <= 3 )
              <a  href="{{ url('/') }}/sales/order/create?quotation_code={{ $row->quotation_code }}"
                  title="{{ $row->sales_status_name }}"
                  class="btn btn-warning btn-sm"
                >
                รอเปิด Order
              </a>
              @else
                {{ $row->sales_status_name }}
              @endif
            </td>
						<td class="d-none">
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->quotation_id }} )" class="text-danger">
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
        $('.number').each(function(index){
          var number = Number($(this).text()).toLocaleString("en",{minimumFractionDigits: 2});
          $(this).text(number);
        });
				$('#table').DataTable().order( [ 0, 'desc' ] ).draw();
		});

		</script>

    <div class="text-center">
      <a class="btn btn-outline-primary" href="{{ url('/') }}/sales">back</a>
      <a href="{{ url('/') }}/sales/quotation/create" class="btn btn-primary">
      	<i class="fa fa-plus"></i> เพิ่มใบเสนอราคา
      </a>
    </div>

	</div>
</div>

<div id="outer-form-container" style="display:none;">
	<form action="#" method="POST" id="form_delete" >
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
</div>

@endsection

@section('script')
@parent

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
		form.action = "{{ url('/') }}/sales/quotation/"+id;
		//SUBMIT
		var want_to_delete = confirm('Are you sure to delete this quotation ?');
		if(want_to_delete){
			form.submit();
		}
	}
</script>



@endsection
