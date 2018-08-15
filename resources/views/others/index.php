@extends('monster-lite/layouts/theme')

@section('title','อื่นๆ')

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
          <div class="px-3"><span class="round round-primary my-2">ร</span></i></div>
          <div>เริ่มระบบ</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ก</span></div>
          <div>กำหนดรหัสผ่านระบบ</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ข</span></i></div>
          <div>กราฟ / ข้อมูลผู้บริหาร</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">            
          <div class="px-3"><span class="round round-primary my-2">ส</span></i></div>
          <div>สำรองแฟ้มข้อมูล</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ด</span></div>
          <div>ดึงสำรองแฟ้มข้อมูล</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ป</span></div>
          <div>ปิดรายการสิ้นปี</div>             
        </a>
      </div>   
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ส</span></div>
          <div>สร้าง/ออกแบบฟอร์ม</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ค</span></div>
          <div>คำนวณต้นทุน</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ก</span></div>
          <div>กระทบตัวเลขใหม่</div>             
        </a>
      </div>        
    </div>      
  </div>  
</div>    
@endsection