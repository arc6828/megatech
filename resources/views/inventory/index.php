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
          <div class="px-3"><span class="round round-primary my-2">อ</span></i></div>
          <div>โอนย้ายคลัง</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ป</span></div>
          <div>ปรับปรุงเพิ่ม/ลด</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">บ</span></i></div>
          <div>เบิกวัตถุดิบไปผลิต</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">            
          <div class="px-3"><span class="round round-primary my-2">ร</span></i></div>
          <div>รับคืนวัตถุดิบจากผลิต</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ร</span></div>
          <div>รับสินค้าสำเร็จรูป</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ฟ</span></div>
          <div>แฟ้มหลักสินค้า</div>             
        </a>
      </div>   
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ค</span></div>
          <div>คลังสินค้า</div>             
        </a>
      </div>       
    </div>      
  </div>  
</div>    
@endsection