@extends('monster-lite/layouts/theme')

@section('title','การขาย')

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
          <div class="px-4"><span class="round round-primary my-2">บ</span></i></div>
          <div>ใบเสนอ<br>ราคา</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">บ</span></div>
          <div><br>ใบรับจอง</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-4"><span class="round round-primary my-2">ร</span></i></div>
          <div>รับเงิน<br>มัดจำ</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">            
          <div class="px-4"><span class="round round-primary my-2">ข</span></i></div>
          <div>ขาย/ส่ง<br>สินค้า</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-4"><span class="round round-primary my-2">ร</span></div>
          <div>ระบุเงื่อนไข<br>การส่ง</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">ร</span></div>
          <div>รับคืน<br>สินค้า</div>             
        </a>
      </div>   
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">พ</span></div>
          <div>พนักงานขาย</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">ฟ</span></div>
          <div>แฟ้มหลัก<br>ลูกค้า</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-4"><span class="round round-primary my-2">ฟ</span></div>
          <div>แฟ้มหลัก<br>สินค้า</div>             
        </a>
      </div>        
    </div>      
  </div>  
</div>    
@endsection