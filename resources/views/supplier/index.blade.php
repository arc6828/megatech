@extends('layouts/argon-dashboard/theme')

@section('title','แฟ้มเจ้าหนี้')

@section('content')

<div class="card">
	<div class="card-body">

		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">แฟ้มเจ้าหนี้</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/supplier" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center table-sm" id="table">
				<thead>
					<tr>
						<th class="text-center">รหัส</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">อีเมล์</th>
						<th class="text-center">เบอร์โทรศัพท์</th>
						<th class="text-center">ยอดหนึ้ขณะนี้</th>
						<!--th class="text-center ">วางบิล</th>
						<th class="text-center ">รับชำระ</th-->
					</tr>
				</thead>
				<tbody>
				@foreach($table_supplier as $row)
				@php
					$total_debt = $row->Receives_on_debt->sum('total_debt') + $row->XP_on_debt->sum('total_debt') ;
				@endphp
				<tr>
					<td><a href="{{ url('/') }}/supplier/{{ $row->supplier_id }}/edit">{{ $row->supplier_code }}</a></td>
					<td>{{ $row->company_name }}</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->telephone }}</td>
					<td>{{ number_format($total_debt,2) }}</td>
					<!--td class=" ">
						@if($total_debt > 0)
						<div><a class=" " href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t', strtotime( '-1 month' ) ) }}">วางบิลเดือนที่ผ่านมา</a></div>
						<div><a class=" " href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t' ) }}">วางบิลทั้งหมด</a></div>
						@endif
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger d-none">
							<span class="fa fa-trash"></span>
						</a>
					</td>
					<td class=" ">
						@if($total_debt > 0)
						<div><a class="" href="{{ url('/') }}/finance/supplier-payment/create?supplier_id={{ $row->supplier_id }}&filter=billing-only">รับชำระที่วางบิล</a></div>
						<div><a class="" href="{{ url('/') }}/finance/supplier-payment/create?supplier_id={{ $row->supplier_id }}">รับชำระทั้งหมด</a></div>
						@endif
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger d-none">
							<span class="fa fa-trash"></span>
						</a>
					</td-->
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="row hide">
			<form action="#" method="POST" id="form_delete" class="d-none">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}

				<button type="submit"></button>
			</form>
	   </div>
	</div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
      //console.log("555");
      $('#table').DataTable().order( [ 0, 'asc' ] ).draw();
  });

	function onDelete(id){
		//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

		//GET FORM BY ID
		var form = document.getElementById("form_delete");

		//CHANGE ACTION TO SPECIFY ID
		form.action = "{{ url('/') }}/supplier/"+id;

		//SUBMIT
		var want_to_delete = confirm('Are you sure to delete this product?');
		if(want_to_delete){
			form.submit();
		}
	}
	</script>


<div class="form-group mt-4">
  <div class="col-lg-12">
    <div class="text-center">
        <a class="btn btn-outline-primary" href="{{ url('/') }}/sales">
			<i class="fa fa-arrow-left"></i> back
		</a>
        <a href="{{ url('/') }}/supplier/create" class="btn btn-primary">
          <i class="fa fa-plus"></i> เพิ่มเจ้าหนี้
        </a>
    </div>
  </div>
</div>
@endsection
