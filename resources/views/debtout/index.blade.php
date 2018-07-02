@extends('template/template-1')
@section('content')
<h2 style="text-align: center;">ตั้งหนี้คงค้าง</h2>
<div class="container">
	<a href="{{ url('/') }}/debtout/create" class="btn btn-primary btn-lg glyphicon glyphicon-plus">
เพิ่มลูกหนี้คงค้าง
</a>
<br>
<br>
<table class="table">
	<thead>
		<th>เลขที่เอกสาร</th>
		<th>วันที่เอกสาร</th>
		<th>ยอดสุทธิ</th>
		<th>รหัสลูกค้า</th>
		<th>ชื่อบริษัท</th>
		<th>ยอดหนี้คงเหลือ</th>
		<th>action</th>
	</thead>
@foreach($table_customer as $row)
	<tr>
		<td>{{ $row->id_dept}}</td>
		<td>{{ $row->date_dept}}</td>
		<td>{{ $row->total}}</td>
		<td>{{ $row->id_customer}}</td>
		<td>{{ $row->name_company}}</td>
		<td>{{ $row->total}}</td>
		<td>
			<div class="row">
			<a href="{{ url('/') }}/debtout/{{ $row->id }}/edit" class="btn btn-success btn-lg glyphicon glyphicon-pencil" style="height: 3em"></a>
			<form class="inline" action="{{ url('/') }}/debtout/{{ $row->id }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button type="submit" class="glyphicon glyphicon-remove btn-danger btn-lg" style="height: 3em"></button>
			</form>
			</div>
		</td>
	</tr>
</table>
@endforeach
<div class="container">
	<div class="row">
		<div class="col-sm-8">
	<form class="inline" action="{{ url('/') }}/debtout" method="GET">
		<input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" class="form-control"></div>
		<button type="submit" class="glyphicon glyphicon-search
 btn-lg"></button>
</form>
&nbsp;&nbsp;
<a href="{{url('/')}}/debtorindex" class="btn btn-danger btn-lg">Back</a>
</div>
@endsection