@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('title','ใบสั่งซื้อ')
@section('background-tag','bg-success')

@section('content')

<div class="card">
	<div class="card-body">
		<!-- <div class="mb-4">
		<a href="{{ url('/purchase') }}" title="Back" class="btn btn-warning btn-sm" >
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
		</a>
		</div> -->
		<!-- <div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบสั่งซื้อ</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/purchase/order" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div> -->



		<div class="table-responsive">
			<table width="100%" class="table table-hover text-center table-sm  table-bordered table-striped" id="table">
				<thead>
					<tr>
						<th class="text-center d-none">#</th>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">รหัสเจ้าหนี้</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">ยอดรวม</th>
						<!-- <th class="text-center">พนักงาน</th> -->
						<th class="text-center">สถานะ</th>
						<th class="text-center d-none">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_purchase_order as $row)
					<tr>
						<td class="d-none">
							{{ $row->purchase_order_id }}
						</td>
						<td>
							<a href="{{ url('/') }}/purchase/order/{{ $row->purchase_order_id }}">
								{{ $row->purchase_order_code }}
							</a>
						</td>
						<td>{{ date_format(date_create(explode(" ", $row->datetime)[0]),"d-m-Y") }}</td>
						<td>{{ $row->supplier_code }}</td>
						<td>{{ $row->company_name }}</td>
						<td class="text-right">{{ number_format($row->total?$row->total:0, 2) }}</td>
						<!-- <td>{{ $row->short_name }}</td> -->
						<td>
						@switch($row->purchase_status_id)
							@case(3) 
								<span class="badge badge-pill badge-warning">{{ $row->purchase_status_name }}</span>
								@break
							@case(4) 
								<span class="badge badge-pill badge-success">{{ $row->purchase_status_name }}</span>
								@break
							@case(-1)
								<span class="badge badge-pill badge-secondary">{{ $row->purchase_status_name }}</span>
								@break						
						@endswitch
						</td>
						<td class="d-none">
							<a href="javascript:void(0)" onclick="onDelete( {{ $row->purchase_order_id }} )" class="text-danger">
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
				$('#table').DataTable({
					paging : false,
					info : false,
					columnDefs: [
						// { targets: [1], className : 'text-left'},
						//{ targets: [-3], className : 'text-right'},
						// { targets: '_all', className : 'text-center' }
					]
				}).order( [ 1, 'desc' ] ).draw();
				//DATA TABLE SCROLL
				var tableCont = document.querySelector('#table');
				tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";
				tableCont.parentNode.style.overflow = 'auto';
				tableCont.parentNode.style.maxHeight = '350px';
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



	</div>
</div>

<div class="mt-2 text-center">
  <a class="btn btn-outline-primary d-none " href="{{ url('/') }}/purchase">back</a>
  <a href="{{ url('/') }}/purchase/order/create" class="btn btn-success">
    <i class="fa fa-plus"></i> เพิ่มใบสั่งซื้อ
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
			form.action = "{{ url('/') }}/purchase/order/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this purchase_order ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
