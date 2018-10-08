@extends('monster-lite/layouts/theme')

@section('title','คงคลัง')

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
				<div class="px-4"><span class="round round-primary my-2">อ</span></i></div>
				<div><br>โอนย้ายคลัง</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
				<div class="px-4"><span class="round round-primary my-2">ป</span></div>
				<div>ปรับปรุง<br>เพิ่ม/ลด</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2">บ</span></i></div>
				<div>เบิกวัตถุดิบ<br>ไปผลิต</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2">ร</span></i></div>
				<div>รับคืนวัตถุดิบ<br>จากผลิต</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
			<a class="btn btn-outline-primary my-3" href="#">
				<div class="px-4"><span class="round round-primary my-2">ร</span></div>
				<div>รับสินค้า<br>สำเร็จรูป</div>
			</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-success my-3" href="{{url('/')}}/product">
					<div class="px-4"><i class="round round-success my-2 fa fa-folder-open-o"></i></div>
					<div>แฟ้มหลัก<br>สินค้า</div>
				</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-success my-3" href="{{url('/')}}/inventory">
					<div class="px-4"><i class="round round-success my-2 fa fa-folder-open-o"></i></div>
					<div>แฟ้มหลัก<br>คลังสินค้า</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
