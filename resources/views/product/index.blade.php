@extends('monster-lite/layouts/theme')

@section('title','แฟ้มสินค้า')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/product/create" class="btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> เพิ่มสินค้า
</a>
@endsection

@section('content')

<div class="card">
	<div class="card-block">

		<div class="row">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">แฟ้มสินค้า</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/product" method="GET">
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
						<th class="text-center">รหัสสินค้า</th>
						<th class="text-center">ชื่อสินค้า</th>
						<th class="text-center">ราคาตั้ง</th>
						<th class="text-center">#ใน Stock</th>
						<th class="text-center">#ค้างส่ง</th>
						<th class="text-center">#ค้างรับ</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($table_product as $row)
				<tr>
					<td>
						<a href="{{ url('/') }}/product/{{ $row->product_id }}/edit">{{ $row->product_code }}</a>
					</td>
					<td>{{ $row->product_name }}</td>
					<td>{{ $row->normal_price }}</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
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