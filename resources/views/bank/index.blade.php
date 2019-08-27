@extends('monster-lite/layouts/theme')

@section('title','แฟ้มธนาคาร')

@section('navbar-menu')
<div style="margin:21px;">
	<a href="{{ url('/') }}/bank/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
		<i class="fa fa-plus"></i> เพิ่มรายการธนาคาร
	</a>
<div>
@endsection

@section('content')

<div class="card">
	<div class="card-block">

		<div class="row">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">แฟ้มลูกค้า</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/bank" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead>
					<tr>
						<th class="text-center">รหัสธนาคาร</th>
						<th class="text-center">รายละเอียด</th>
						<th class="text-center">สาขา</th>
						<th class="text-center">ยอดคงเหลือ</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($table_bank as $row)
				<tr>
					<td><a href="{{ url('/') }}/bank/{{ $row->bank_id }}/edit">{{ $row->bank_code }}</a></td>
					<td>{{ $row->bank_name }}</td>
					<td>{{ $row->bank_branch }}</td>
					<td>{{ $row->bring_forward }}</td>
					<td>
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->bank_id }} )" class="text-danger">
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
				  <a class="btn btn-outline-primary" href="{{ url('/') }}/finance">back</a>
			</div>
		</div>
	</div>


	</div>
</div>

<script>
	function onDelete(id){
		//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

		//GET FORM BY ID
		var form = document.getElementById("form_delete");

		//CHANGE ACTION TO SPECIFY ID
		form.action = "{{ url('/') }}/bank/"+id;

		//SUBMIT
		var want_to_delete = confirm('Are you sure to delete this bank?');
		if(want_to_delete){
			form.submit();
		}
	}
	</script>
@endsection

