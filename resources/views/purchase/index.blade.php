@extends('monster-lite/layouts/theme')

@section('title','การซื้อ')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success">
	<i class="fa fa-plus"></i> New Activity
</a>
@endsection

@section('content')
<div class="card">
	<div class="card-block">
		<div class="row text-center">
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div><br>ใบเสนอซื้อ</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div>อนุมัติ<br>ใบเสนอซื้อ</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div>กำหนดเจ้าหนี้<br>ใบเสนอซื้อ</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div><br>ใบสั่งซื้อ</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div>จ่ายเงิน<br>มัดจำ</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div>รับ/ซื้อ<br>สินค้า</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
				<div class="px-4"><span class="round round-primary my-2"><i class="fa fa-file-text-o"></i></span></div>
				<div>ส่งคืน<br>สินค้า</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-success my-3" href="{{url('/')}}/">
				<div class="px-4"><i class="round round-success my-2 fa fa-folder-open-o"></i></div>
				<div>แฟ้มหลัก<br>เจ้าหนี้</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-success my-3" href="{{url('/')}}/product">
					<div class="px-4"><i class="round round-success my-2 fa fa-folder-open-o"></i></div>
					<div>แฟ้มหลัก<br>สินค้า</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
