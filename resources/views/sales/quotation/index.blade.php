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
				
		<form class="" action="{{ url('/') }}/sales/quotation" method="GET">
			<div class="form-group form-inline pull-right">
				<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
				<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>	
	        </div>	
    	</form>

		<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead>
					<tr>					
						<th class="text-center">เลขที่เอกสาร</th>
						<th class="text-center">วันที่</th>
						<th class="text-center">ยอดสุทธิ</th>
						<th class="text-center">รหัสลูกค้า</th>
						<th class="text-center">ชื่อบริษัท</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center">action</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($table_quotation as $row)
					<tr>
						<td>
							<a href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/edit">  
								{{ $row->quotation_num }}
							</a>
						</td>
						<td>{{ $row->datetime }}</td>
						<td>{{ $row->total }}</td>
						<td>{{ $row->customer_id }}</td>
						<td>{{ "<ชื่อบริษัท>" }}</td>
						<td>{{ $row->user_id }}</td>
						<td>{{ $row->status }}</td>
						<td>
							<a href="#"><span class="fa fa-trash" style="color: red"></span></a>
							<div class="row hide">
								<form action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" method="POST">
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
