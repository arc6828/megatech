@extends('monster-lite/layouts/theme')

@section('title','แฟ้มลูกหนี้')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/finance/debtor/create" class="btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> เพิ่มลูกค้า
</a>
@endsection

@section('content')

<div class="card">
    <div class="card-block">
123456132123
		@foreach($table_customer as $row)
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th>รหัสลูกค้า</th>
							<th>ชื่อบริษัท</th>
							<th>ยอดหนี้ขณะหนี้</th>
							<th>ที่อยู่</th>
							<th>เบอร์โทรศัพท์</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $row->id_customer }}</td>
							<td>{{ $row->name_company }}</td>
							<td>{{ $row->debt_balance }}</td>
							<td>{{ $row->address }}</td>
							<td>{{ $row->telephone }}</td>
							<td>
								<div class="row">
										<a href="{{ url('/') }}/finance/debtor/{{ $row->id }}/edit" class="btn btn-info btn-lg glyphicon glyphicon-pencil" style="height: 3em"></a>
									<form class="inline" action="{{ url('/') }}/finance/debtor/{{ $row->id }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit" class="glyphicon glyphicon-remove btn-danger btn-lg" style="height: 3em"></button>
								</form>
								</div>
							</td>
						</tr>
					</tbody>

				</table>
			</div>

		@endforeach

			<div class="row">
				<div class="col-sm-8">
			<form class="inline" action="{{ url('/') }}/finance/debtor" method="GET">
				<input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" class="form-control"></div>
				<button type="submit" class="glyphicon glyphicon-search
		 btn-lg"></button>
		</form>
		&nbsp;&nbsp;
		<a href="{{url('/')}}/finance" class="btn btn-danger btn-lg">Back</a>
		</div>
		</div>
	</div>
</div>
@endsection
