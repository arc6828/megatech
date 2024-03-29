@extends('layouts/argon-dashboard/theme')

@section('title','การขาย')

@section('background-tag','bg-warning')

@section('content')

<div class="card">
	<div class="card-body">
		<div class="row text-center">
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-warning btn-menu my-3" href="{{url('/')}}/sales/quotation">
					<div class="vertical-center">
						<div class="px-4">
							<span class="round round-primary my-2">
								<!-- <i class="ni ni-single-copy-04"></i> -->
								<h1>QT</h1>
							</span>
						</div>
						<div class="px-1">ใบเสนอราคา</div>
					</div>
				</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-warning btn-menu my-3" href="{{url('/')}}/sales/order">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2">
				  <!-- <i class="ni ni-single-copy-04"></i> -->
				  <h1>OE</h1>
				  </span></div>
  				<div>ใบรับจอง</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-warning btn-menu  my-3" href="{{url('/')}}/sales/order_detail">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2">
				  <!-- <i class="ni ni-cart"></i> -->
				  <h1>PC</h1>
				  </span></i></div>
  				<div>ใบเบิกของ</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-warning btn-menu  my-3" href="{{url('/')}}/sales/invoice">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2">
				  <!-- <i class="ni ni-single-copy-04"></i> -->
				  <h1>IV</h1>
				  </span></i></div>
  				<div class="px-1">ขาย/ส่งสินค้า</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-warning btn-menu  my-3" href="#">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-danger my-2"><i class="ni ni-delivery-fast"></i></span></div>
  				<div>ระบุเงื่อนไข<br>การส่ง</div>
  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-warning btn-menu  my-3" href="{{ url('/sales/return-invoice') }}">
          <div class="vertical-center">
  					<div class="px-4"><span class="round round-primary my-2">
					  <!-- <i class="ni ni-single-copy-04"></i> -->
					  <h1>RI</h1>
					  </span></div>
  					<div>รับคืนสินค้า</div>
    			</div>
				</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-warning btn-menu  my-3" href="{{url('/')}}/sales/delivery_temporary">
          <div class="vertical-center">
  					<div class="px-4"><span class="round round-primary my-2">
					  <!-- <i class="ni ni-single-copy-04"></i> -->
					  <h1>DT</h1>
					  </span></div>
  					<div>ส่งของชั่วคราว</div>
    			</div>
				</a>
			</div>
		</div>
		<div class="row  text-center">
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-dark btn-menu  my-3" href="{{url('/')}}/user?q=sales">
					<div class="vertical-center">
						<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
						<div  class="px-1">แฟ้มหลัก<br>พนักงานขาย</div>

					</div>
				</a>
			</div>
			<div class="col-6 col-md-3 ">
			<a class="btn btn-outline-dark btn-menu  my-3" href="{{url('/')}}/customer">
        <div class="vertical-center">
  				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
  				<div>แฟ้มหลัก<br>ลูกค้า</div>

  			</div>
			</a>
			</div>
			<div class="col-6 col-md-3 ">
				<a class="btn btn-outline-dark btn-menu  my-3" href="{{url('/')}}/product">
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
