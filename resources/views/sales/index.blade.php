@extends('layouts/argon-dashboard/theme')

@section('title','การขาย')

@section('content')
<style>
  .btn-menu{
    width: 120px;
    height: 120px;
  }
  .btn-menu .ni{
    font-size: 28px;
  }
  .vertical-center {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);

  }
</style>
<div class="card">
	<div class="card-block">
		<div class="row text-center">
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/sales/quotation">
        <div class="vertical-center">
          <div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div class="px-1">ใบเสนอราคา</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/sales/order">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>ใบรับจอง</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary btn-menu  my-3" href="{{url('/')}}/sales/order_detail">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></i></div>
  				<div>ใบเบิกของ</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-primary btn-menu  my-3" href="{{url('/')}}/sales/invoice">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></i></div>
  				<div class="px-1">ขาย/ส่งสินค้า</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-danger btn-menu  my-3" href="#">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-danger my-2"><i class="ni ni-delivery-fast"></i></span></div>
  				<div>ระบุเงื่อนไข<br>การส่ง</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-primary btn-menu  my-3" href="{{url('/')}}/">
          <div class="vertical-center">
  					<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  					<div>รับคืนสินค้า</div>
    			</div>
				</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-primary btn-menu  my-3" href="{{url('/')}}/">
          <div class="vertical-center">
  					<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  					<div>ส่งของชั่วคราว</div>
    			</div>
				</a>
			</div>
		</div>
		<div class="row  text-center">
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-success btn-menu  my-3" href="{{url('/')}}/user?q=sales">
        <div class="vertical-center">
  				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
  				<div  class="px-1">แฟ้มหลัก<br>พนักงานขาย</div>

  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-success btn-menu  my-3" href="{{url('/')}}/customer">
        <div class="vertical-center">
  				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
  				<div>แฟ้มหลัก<br>ลูกค้า</div>

  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-success btn-menu  my-3" href="{{url('/')}}/product">
          <div class="vertical-center">
  					<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
  					<div>แฟ้มหลัก<br>สินค้า</div>

    			</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
