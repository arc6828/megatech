<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">
	<h2 style="text-align: center;">แฟ้มลูกหนี้</h2>
</head>
<body>
<div class="container">
<a href="{{ url('/') }}/debtor/create" class="btn btn-primary btn-lg glyphicon glyphicon-plus">
เพิ่มลูกค้า
</a>
</div>

@foreach($table_customer as $row)
<section class="resume-section p-3 p-lg-5 d-flex d-column">
	 	<div class="container">
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
					<a href="{{ url('/') }}/debtor/{{ $row->id }}/edit" class="btn btn-info btn-lg glyphicon glyphicon-pencil" ></a>
				<form class="inline" action="{{ url('/') }}/debtor/{{ $row->id }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button type="submit" class="glyphicon glyphicon-remove btn-danger btn-lg"></button>
			</form>
			</div>
		</td>
	</tr>
	</table>

</div>
</section>
@endforeach
<div class="container">
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
</body>
</html>
