@extends('layouts/argon-dashboard/theme')

@section('title','คงคลัง')

@section('background-tag','bg-yellow')

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
				<a class="btn bg-yellow btn-menu my-3" href="{{url('/')}}/">
					<div class="vertical-center text-dark">
						<div class="px-4"><i class="round round-yellow my-2 ni ni-folder-17"></i></div>
						<div><br>โอนย้ายคลัง</div>
					</div>

				</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn  bg-yellow btn-menu my-3" href="{{url('/adjust-stock')}}">
					<div class="vertical-center text-dark">
						<div class="px-4"><i class="round round-yellow my-2 ni ni-folder-17"></i></div>
						<div>ปรับปรุง<br>เพิ่ม/ลด</div>
					</div>

				</a>
			</div>
			<div class="col-6 col-md-4">
				<a class="btn bg-yellow btn-menu my-3" href="{{url('/issue-stock')}}">
					<div class="vertical-center  text-dark">
						<div class="px-4"><i class="round round-yellow my-2 ni ni-folder-17"></i></div>

						<div>เบิกวัตถุดิบ<br>ไปผลิต</div>
					</div>
				</a>
			</div>
			<div class="col-6 col-md-4">
				<a class="btn bg-yellow btn-menu  my-3" href="{{url('/receive-final')}}">
					<div class="vertical-center  text-dark">
						<div class="px-4"><i class="round round-yellow my-2 ni ni-folder-17"></i></div>
						<div>รับคืนวัตถุดิบ<br>จากผลิต</div>
					</div>

				</a>
			</div>
			<div class="col-6 col-md-4  d-none">
				<a class="btn bg-yellow btn-menu  my-3" href="#">
					<div class="vertical-center">
						<div class="px-4"><i class="round round-yellow my-2 ni ni-folder-17"></i></div>

						<div>รับสินค้า<br>สำเร็จรูป</div>
					</div>
				</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-dark btn-menu  my-3" href="{{ url('/') }}/product">
					<div class="vertical-center">
						<div class="px-4"><i class="round round-dark my-2 ni ni-folder-17"></i></div>
						<div>แฟ้มหลัก<br>สินค้า</div>
					</div>
				</a>
			</div>
			<div class="col-6 col-md-4 ">
				<a class="btn btn-outline-dark btn-menu  my-3" href="#">
					<div class="vertical-center">
						<div class="px-4"><i class="round round-dark my-2 ni ni-folder-17"></i></div>
						<div>แฟ้มหลัก<br>คลังสินค้า</div>
					</div>

				</a>
			</div>
			
		</div>
	</div>
</div>
@endsection
