@extends('layouts/argon-dashboard/theme')

@section('title','แฟ้มเจ้าหนี้้')


@section('content')

<div class="card">
	<div class="card-body">



		<div class="table-responsive">
			<table class="table table-hover text-center" id="table">
				<thead>
					<tr>
						<th class="text-center">รหัส</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">อีเมล์</th>
						<th class="text-center">เบอร์โทรศัพท์</th>
						<th class="text-center">ยอดหนึ้ขณะนี้</th>
						<th class="text-center">วางบิล</th>
						<th class="text-center">จ่ายชำระ</th>
						<th class="text-center d-none">action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($table_supplier as $row)
				@php
					$total_debt = $row->Receives_on_debt->sum('total_debt');
				@endphp
				<tr>
					<td><a href="{{ url('/') }}/supplier/{{ $row->supplier_id }}/edit">{{ $row->supplier_code }}</a></td>
					<td>{{ $row->company_name }}</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->telephone }}</td>
					<td>{{ number_format($total_debt,2) }}</td>
					<td>
						@if($total_debt > 0)
						<div><a class=" " href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t', strtotime( '-1 month' ) ) }}">วางบิลเดือนที่ผ่านมา</a></div>
						<div><a class=" " href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t' ) }}">วางบิลทั้งหมด</a></div>
						@endif
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger d-none">
							<span class="fa fa-trash"></span>
						</a>
					</td>
					<td>
						@if($total_debt > 0)
						<div><a class="" href="{{ url('/') }}/finance/supplier-payment/create?supplier_id={{ $row->supplier_id }}&filter=billing-only">รับชำระที่วางบิล</a></div>
						<div><a class="" href="{{ url('/') }}/finance/supplier-payment/create?supplier_id={{ $row->supplier_id }}">รับชำระทั้งหมด</a></div>
						@endif
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger d-none">
							<span class="fa fa-trash"></span>
						</a>
					</td>
					<td class="d-none">
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger">
							<span class="fa fa-trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="row hide">
			<form action="#" method="POST" id="form_delete">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}

				<button type="submit"></button>
			</form>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<div class="text-center">
        <a class="btn btn-outline-primary" href="{{ url('/') }}/purchase">back</a>
      	<a href="{{ url('/') }}/supplier/create" class="btn btn-primary">
      		<i class="fa fa-plus"></i> เพิ่มเจ้าหนี้
      	</a>
			</div>
		</div>
	</div>


	</div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
      console.log("555");
      $('#table').DataTable();
  });

</script>
<script>
	function onDelete(id){
		//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

		//GET FORM BY ID
		var form = document.getElementById("form_delete");

		//CHANGE ACTION TO SPECIFY ID
		form.action = "{{ url('/') }}/supplier/"+id;

		//SUBMIT
		var want_to_delete = confirm('Are you sure to delete this supplier?');
		if(want_to_delete){
			form.submit();
		}
	}
	</script>
@endsection
