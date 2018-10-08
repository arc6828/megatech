@extends('monster-lite/layouts/theme')

@section('title','แฟ้มพนักงาน')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/register" class="btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> Register
</a>
@endsection

@section('content')

<div class="card">
	<div class="card-block">

		<div class="row">
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
			<table class="table table-hover text-center">
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
						<a href="{{ url('/') }}/user/{{ $row->id }}">{{ $row->name }}</a>
					</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->role }}</td>
					<td>
						<a href="#" class="text-danger">
							<span class="fa fa-trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>




	</div>
</div>
@endsection
