@extends('layouts/argon-dashboard/theme')

@section('title','แฟ้มพนักงาน')

@section('navbar-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-body">

		<div class="row d-none">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">แฟ้มพนักงาน</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/user" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center" id="table">
				<thead>
					<tr>
						<th class="text-center">ชื่อ</th>
						<th class="text-center">อีเมล์</th>
						<th class="text-center">ตำแหน่ง</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($table_user as $row)
				<tr>
					<td>
						<a href="{{ url('/') }}/user/{{ $row->id }}/edit">{{ $row->name }}</a>
					</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->department_name }}</td>
					<td>
						<a href="javascript:void(0)" onclick="onDelete( {{ $row->id }} )" class="text-danger">
							<span class="fa fa-trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="row d-none">
				<form action="#" method="POST" id="form_delete">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<button type="submit"></button>
				</form>
		</div>



	</div>
</div>
<div class="mt-4 text-center">
		<a href="{{ url('/') }}/register" class="btn btn-primary">
			<i class="fa fa-plus"></i> Register
		</a>
<div>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
      //console.log("555");
      $('#table').DataTable();
  });

</script>
<script>
		function onDelete(id){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

			//GET FORM BY ID
			var form = document.getElementById("form_delete");

			//CHANGE ACTION TO SPECIFY ID
			form.action = "{{ url('/') }}/user/"+id;

			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this supplier?');
			if(want_to_delete){
				form.submit();
			}
		}
		</script>
@endsection
