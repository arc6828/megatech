@extends('layouts/argon-dashboard/theme')

@section('title','การขาย')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success">
	<i class="fas fa-plus"></i> New Activity
</a>
@endsection

@section('content')
<div class="card">
	<div class="card-block">
		<div class="row text-center">
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/sales/quotation">
				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
				<div>ใบเสนอ<br>ราคา</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/sales/order">
				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
				<div><br>ใบรับจอง</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/sales/order_detail">
				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></i></div>
				<div><br>ใบเบิกของ</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/sales/invoice">
				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></i></div>
				<div>ขาย/ส่ง<br>สินค้า</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-danger my-3" href="#">
				<div class="px-4"><span class="round round-danger my-2"><i class="ni ni-delivery-fast"></i></span></div>
				<div>ระบุเงื่อนไข<br>การส่ง</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
					<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
					<div>รับคืน<br>สินค้า</div>
				</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
					<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
					<div>ส่งของ<br>ชั่วคราว</div>
				</a>
			</div>
		</div>
		<div class="row  text-center">
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-success my-3" href="{{url('/')}}/user?q=sales">
				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
				<div>แฟ้มหลัก<br>พนักงานขาย</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-success my-3" href="{{url('/')}}/customer">
				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
				<div>แฟ้มหลัก<br>ลูกค้า</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-success my-3" href="{{url('/')}}/product">
					<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
					<div>แฟ้มหลัก<br>สินค้า</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
