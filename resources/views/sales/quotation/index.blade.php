@extends('monster-lite/layouts/theme')

@section('title','ใบเสนอราคา')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/sales/quotation/create" class="btn pull-right hidden-sm-down btn-success"> 
	<i class="fa fa-plus"></i> เพิ่มใบเสนอราคา
</a>
@endsection

@section('content')

<div class="card">
    <div class="card-block">
    	<div class="row">
			<div class="col-sm-6">
				<form class="form-inline" action="{{ url('/') }}/finance/debtor" method="GET">
					<input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" class="form-control mb-2 mr-2">
					<button type="submit" class="btn btn-primary mb-2 mr-2">ค้นหา</button>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead>
					<tr>					
						<th>เลขที่เอกสาร</th>
						<th>วันที่</th>
						<th>ยอดสุทธิ</th>
						<th>รหัสลูกค้า</th>
						<th>ชื่อบริษัท</th>
						<th>action</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($table_quotation as $row)
					<tr>
						<td>{{ $row->quotation_id }}</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->total }}</td>
						<td>{{ $row->customer_id }}</td>
						<td>{{ "<ชื่อบริษัท>" }}</td>
						<td>
							<div class="row">
								<a href="{{ url('/') }}/sales/quotation/{{ $row->id }}/edit"></a>
								<form action="{{ url('/') }}/sales/quotation/{{ $row->id }}" method="POST">
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
@endsection
