@extends('template/template')
@section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
  <h1>เมนูหลัก</h1>
</head>  
<body>

	 <section class="resume-section p-3 p-lg-5 d-flex d-column">
	 	<div class="container">
	<a class="btn btn-outline-primary" href="{{url('/')}}/debtout">ตั้งหนี้คงค้าง</a>
	<a class="btn btn-outline-primary" href="#">ตั้งหนี้/ลูกหนี้</a>
	<a class="btn btn-outline-primary" href="#">ลดหนี้ลูกหนี้</a>
	<a class="btn btn-outline-primary" href="#">ใบวางบิล</a><br><br>
	<a class="btn btn-outline-primary" href="#">ชำระเงิน</a>
	<a class="btn btn-outline-primary" href="{{url('/')}}/debtor">แฟ้มลูกหนี้</a>
	</div>
</section>
</body>
</html>
@endsection