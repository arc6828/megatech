@extends('layouts/argon-dashboard/theme')

@section('title','บัญชี')

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
          <div class="px-4"><span class="round round-primary my-2">ฟ</span></i></div>
          <div>แฟ้มผัง<br>บัญชี</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-success my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-success my-2">ก</span></div>
          <div>กำหนด<br>การเชื่อมต่อระบบ</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-info my-3" href="#">
          <div class="px-4"><span class="round round-info my-2">ต</span></i></div>
          <div>ตรวจสอบ<br>ข้อผิดพลาด</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-warning my-3" href="#">
          <div class="px-4"><span class="round round-warning my-2">ล</span></i></div>
          <div>ลงรายการ<br>ประจำวัน</div>
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a class="btn btn-outline-danger my-3" href="#">
          <div class="px-4"><span class="round round-danger my-2">ค</span></div>
          <div>ค่าเสื่อม<br>ทรัพย์สิน</div>
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">ส</span></div>
          <div>สมุด<br>บัญชีเฉพาะ</div>
        </a>
      </div>

    </div>
  </div>
</div>
@endsection
