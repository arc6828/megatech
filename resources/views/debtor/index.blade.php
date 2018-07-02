@extends('template/template-1')
@section('content')
<div class="container">
<h2 style="text-align: center;">แฟ้มลูกหนี้</h2>
<a href="{{ url('/') }}/debtor/create" class="btn btn-primary btn-lg glyphicon glyphicon-plus">
เพิ่มลูกค้า
</a>
@foreach($table_customer as $row)
	<table class="table">
	<th>รหัสลูกค้า</th>
	<th>ชื่อบริษัท</th>
	<th>ยอดหนี้ขณะหนี้</th>
	<th>ที่อยู่</th>
	<th>เบอร์โทรศัพท์</th>
	<th>action</th>
	<tr>
		<td>{{ $row->id_customer }}</td>
		<td>{{ $row->name_company }}</td>
		<td>{{ $row->debt_balance }}</td>
		<td>{{ $row->address }}</td>
		<td>{{ $row->telephone }}</td>
		<td>
			<div class="row">
					<a href="{{ url('/') }}/debtor/{{ $row->id }}/edit" class="btn btn-info btn-lg glyphicon glyphicon-pencil" style="height: 3em"></a>
				<form class="inline" action="{{ url('/') }}/debtor/{{ $row->id }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button type="submit" class="glyphicon glyphicon-remove btn-danger btn-lg" style="height: 3em"></button>
			</form>
			</div>
		</td>
	</tr>
	</table>
@endforeach

	<div class="row">
		<div class="col-sm-8">
	<form class="inline" action="{{ url('/') }}/debtor" method="GET">
		<input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" class="form-control"></div>
		<button type="submit" class="glyphicon glyphicon-search
 btn-lg"></button>
</form>
&nbsp;&nbsp;
<a href="{{url('/')}}/debtorindex" class="btn btn-danger btn-lg">Back</a>
</div>
</div>
</div>
@endsection
