@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('sales'))
@section('level-0','การขาย')

@section('title','ใบส่งของชั่วคราว')

@section('background-tag','bg-warning')

@section('content')

<div class="card">
	<div class="card-body">

    <div class="table-responsive">
			<table class="table table-sm table-hover text-center table-bordered table-striped" id="table" style="width:100%; margin-top:-1px !important;">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">พนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center d-none">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_delivery_temporary as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/delivery_temporary/{{ $row->delivery_temporary_id }}">
								{{ $row->delivery_temporary_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->customer_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td class="number">{{ $row->total?$row->total:0 }}</td>
						<td>{{ $row->short_name }}</td>
						<td>
							@switch($row->sales_status_id)							
								@case(-1)
									<span class="badge badge-pill badge-secondary">Void</span>
									@break
								@case(0)
									<span class="badge badge-pill badge-primary">Draft</span>
									@break
								@case(10)
									<span class="badge badge-pill badge-warning">เปิดใบส่งของชั่วคราว</span>
									@break
								@case(11)
									<span class="badge badge-pill badge-success">ปิดใบส่งของชั่วคราว</span>
									@break								
							@endswitch
							
						</td>
						<td class="d-none">
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->delivery_temporary_id }} )" class="text-danger">
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
				paging : false,
				info : false,
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

    <div class="text-center">
      <a class="btn btn-outline-success" href="{{ url('/') }}/sales">back</a>
      <a href="{{ url('/') }}/sales/delivery_temporary/create" class="btn btn-success">
      	<i class="fa fa-plus"></i> เพิ่มใบส่งของชั่วคราว
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
			form.action = "{{ url('/') }}/sales/delivery_temporary/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this delivery_temporary ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>



@endsection
