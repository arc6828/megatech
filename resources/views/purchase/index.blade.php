@extends('layouts/argon-dashboard/theme')

@section('title','การซื้อ')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> New Activity
</a>
@endsection

@section('content')
<div class="card">
	<div class="card-body">
		<div class="row text-center">
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/requisition">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>ใบเสนอซื้อ</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/requisition_detail">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>อนุมัติ<br>ใบเสนอซื้อ</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/requisition_detail/edit_supplier">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>กำหนดเจ้าหนี้<br>ใบเสนอซื้อ</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/order">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>ใบสั่งซื้อ</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="#">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>จ่ายเงิน<br>มัดจำ</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/receive">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>รับ/ซื้อ<br>สินค้า</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary btn-menu my-3" href="{{url('/')}}/purchase/sendback">
        <div class="vertical-center">
  				<div class="px-4"><span class="round round-primary my-2"><i class="ni ni-single-copy-04"></i></span></div>
  				<div>ส่งคืน<br>สินค้า</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-success btn-menu my-3" href="{{url('/')}}/supplier">
        <div class="vertical-center">
  				<div class="px-4"><i class="round round-success my-2 ni ni-folder-17"></i></div>
  				<div>แฟ้มหลัก<br>เจ้าหนี้</div>
        </div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-success btn-menu my-3" href="{{url('/')}}/product">
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
