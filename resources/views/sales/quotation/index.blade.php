@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('sales'))
@section('level-0','การขาย')

@section('title','ใบเสนอราคา')

@section('background-tag','bg-warning')

@section('content')

<div class="card">
	<div class="card-body">
    <div class="mb-4 d-none">
      <a href="{{ url('/sales') }}" title="Back" class="btn btn-warning btn-sm" >
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>
    <div class="table-responsive">
			<table class="table table-sm table-hover text-center table-bordered table-striped" id="table" style="width:100%; margin-top:-1px !important;">
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
						<td class="text-left">
							<a href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}">
								{{ $row->quotation_code }}
							</a>
						</td>
						<td title="{{ $row->datetime }}">{{ explode(" " , $row->datetime)[0] }}</td>
						<td>{{ $row->customer_code }}</td>
						<td>
							<a href2="{{ url('/customer') }}/{{ $row->Customer->customer_id }}/edit" target="_blank">
								{{ $row->company_name }}
							</a>
						</td>
						<td class="text-right">{{ number_format($row->total?$row->total:0,2) }}</td>
						<td><a href2="{{ url('/user') }}/{{ $row->user_id }}" title="{{ $row->name }}" target="_blank">{{ $row->short_name }}</a></td>
						<td>
							@if( $row->sales_status_id == 1  )
								<a  href="#"
									href2="{{ url('/') }}/sales/order/create?quotation_code={{ $row->quotation_code }}"
									title="{{ $row->sales_status_name }}"
									class="btn btn-primary btn-sm d-none"
									>
									รอเปิด Order
								</a>
								<span class="badge badge-pill badge-primary">{{ $row->sales_status_name }}</span>
							@elseif( $row->sales_status_id == 4    )
								<span class="badge badge-pill badge-danger">{{ $row->sales_status_name }}</span>							
							@elseif( $row->sales_status_id == 5    )
								<span class="badge badge-pill badge-success">{{ $row->sales_status_name }}</span>
							@elseif( $row->sales_status_id == -1    )
								<span class="badge badge-pill badge-secondary">{{ $row->sales_status_name }}</span>
								
							@else
								<span class="badge badge-pill badge-warning">{{ $row->sales_status_name }}</span>
								
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
			$('#table').DataTable({
				"paging" : false ,
				"info" : false,
			}).order( [ 0, 'desc' ] ).draw();
			//DATA TABLE SCROLL
			var tableCont = document.querySelector('#table');
			tableCont.parentNode.style.overflow = 'auto';
			tableCont.parentNode.style.maxHeight = '400px';
			tableCont.parentNode.addEventListener('scroll',function (e){
				var scrollTop = this.scrollTop;
				this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 100 + 'px)';
				this.querySelector('thead').style.background = "white";
				this.querySelector('thead').style.zIndex = "3000";
				this.querySelector('thead').style.marginBottom = "100px";
				console.log(scrollTop);
			})
			//END DATA TABLE SCROLL
		});

		</script>

    <div class="text-center mt-4">
      <a class="btn btn-outline-success" href="{{ url('/') }}/sales">
	  	<i class="fa fa-arrow-left" aria-hidden="true"></i> back
	  </a>
      <a href="{{ url('/') }}/sales/quotation/create" class="btn btn-success">
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
