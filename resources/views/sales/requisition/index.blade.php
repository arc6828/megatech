@extends('monster-lite/layouts/theme')

@section('title','ใบเสนอราคา')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/sales/requisition/create" class="btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> เพิ่มใบเสนอราคา
</a>
@endsection

@section('content')

<div class="card">
	<div class="card-block">
		<div class="row">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">รายการใบเสนอราคา</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/sales/requisition" method="GET">
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
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">ยอดรวม</th>
						<th class="text-center">ชื่อลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center">action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($table_requisition as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/requisition/{{ $row->requisition_id }}/edit">
								{{ $row->requisition_code }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->total?$row->total:0 }}</td>
						<td>{{ $row->customer_name }}</td>
						<td>{{ $row->company_name }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->sales_status_name }}</td>
						<td>
							<a href="#"><span class="fa fa-trash" style="color: red"></span></a>
							<div class="row hide">
								<form action="{{ url('/') }}/sales/requisition/{{ $row->requisition_id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit"></button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>

	</div>
</div>

<div class="form-group">
	<div class="col-lg-12">
		<div class="text-center">
	  		<a class="btn btn-outline-primary" href="{{ url('/') }}/sales">back</a>
		</div>
	</div>
</div>
@endsection
