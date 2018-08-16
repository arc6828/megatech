@extends('monster-lite/layouts/theme')

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
          <div class="px-3"><span class="round round-primary my-2">ฟ</span></i></div>
          <div>แฟ้มผังบัญชี</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ก</span></div>
          <div>กำหนดการเชื่อต่อระบบ</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ต</span></i></div>
          <div>ตรวจสอบข้อผิดพลาด</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">            
          <div class="px-3"><span class="round round-primary my-2">ล</span></i></div>
          <div>ลงรายการประจำวัน</div>
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ค</span></div>
          <div>ค่าเสื่อมทรัพย์สิน</div>            
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ส</span></div>
          <div>สมุดบัญชีเฉพาะ</div>             
        </a>
      </div>   
           
    </div>      
  </div>  
</div>    
@endsection