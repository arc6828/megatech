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
          <div class="px-3"><span class="round round-primary my-2">บ</span></i></div>
          <div>ใบเสนอราคา</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">บ</span></div>
          <div>ใบรับจอง</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ร</span></i></div>
          <div>รับเงินมัดจำ</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">            
          <div class="px-3"><span class="round round-primary my-2">ข</span></i></div>
          <div>ขาย/ส่งสินค้า</div>
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="#">
          <div class="px-3"><span class="round round-primary my-2">ร</span></div>
          <div>ระบุเงื่อนไขการส่ง</div>            
        </a>
      </div>
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ร</span></div>
          <div>รับคืนสินค้า</div>             
        </a>
      </div>   
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">พ</span></div>
          <div>พนักงานขาย</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ฟ</span></div>
          <div>แฟ้มหลักลูกค้า</div>             
        </a>
      </div> 
      <div class="col-6 col-md-4 ">
        <a class="btn btn-outline-primary my-3" href="{{url('/')}}/">
          <div class="px-3"><span class="round round-primary my-2">ฟ</span></div>
          <div>แฟ้มหลักสินค้า</div>             
        </a>
      </div>        
    </div>      
  </div>  
</div>    
@endsection