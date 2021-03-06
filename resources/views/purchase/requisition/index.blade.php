@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('title','ใบเสนอซื้อ')
@section('background-tag','bg-success')

@section('content')

<div class="card">
	<div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/purchase') }}" title="Back" class="pb-4 d-none">
        <button class="btn btn-warning btn-sm">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </button>
      </a>
    </div>
		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบเสนอซื้อ</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/purchase/requisition" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>



		<div class="table-responsive">
			<table class="table table-sm table-hover text-center table-bordered table-striped" id="table">
				<thead>
					<tr>
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<!-- <th class="text-center">รหัสพนักงาน</th> -->
						<th class="text-center">สถานะ</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_purchase_requisition as $row)

					<tr>
						<td>
							<a href="{{ url('/') }}/purchase/requisition/{{ $row->purchase_requisition_id }}">
								{{ $row->purchase_requisition_code }}
							</a>
						</td>
						<td>{{ date_format( date_create(explode(" ",$row->datetime)[0]),"d-m-Y" ) }}</td>
						<!-- <td>{{ $row->User->short_name }}</td> -->
						
						
						<td>
							@switch($row->purchase_status_id)
								@case("-1") 
									<span class="badge badge-pill badge-secondary">Void</span>
									@break
								@case("0")								
									<span class="badge badge-pill badge-primary">อนุมัติทั้งหมด / บางส่วน / รอการอนุมัติ</span>
									@break
								@default
									@if($row->requisition_details->sum("purchase_requisition_detail_status_id") == $row->requisition_details->count("purchase_requisition_detail_status_id")  )
									<span class="badge badge-pill badge-success">อนุมัติทั้งหมด</span>
									@elseif( $row->requisition_details->sum("purchase_requisition_detail_status_id") == $row->requisition_details->count("purchase_requisition_detail_status_id")*3 )
									<span class="badge badge-pill badge-info">รอการอนุมัติ</span>
									@elseif( $row->requisition_details->sum("purchase_requisition_detail_status_id") == $row->requisition_details->count("purchase_requisition_detail_status_id")*2 )
									<span class="badge badge-pill badge-danger">ไม่อนุมัติ</span>
									@else
									<span class="badge badge-pill badge-primary">อนุมัติบางส่วน</span>
									@endif
							@endswitch
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
				order: [[ 0, "desc" ]]
			});

			//DATA TABLE SCROLL
			var tableCont = document.querySelector('#table');
			tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";
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



	</div>
</div>

<div class="mt-4 text-center">
  <a class="btn btn-outline-success" href="{{ url('/') }}/purchase">back</a>
  <a href="{{ url('/') }}/purchase/requisition/create" class="btn btn-success">
    <i class="fa fa-plus"></i> เพิ่มใบเสนอซื้อ
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
			form.action = "{{ url('/') }}/purchase/requisition/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this purchase_requisition ?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
</div>


@endsection
