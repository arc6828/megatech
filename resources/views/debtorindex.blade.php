@extends('monster-lite/layouts/theme')

@section('title','เมนูหลักการเงิน')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success"> 
  <i class="fa fa-plus"></i> New Activity
</a>
@endsection

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="debtor-tab" data-toggle="tab" href="#debtor" role="tab" aria-controls="debtor" aria-selected="true">ลูกหนี้</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="creditor-tab" data-toggle="tab" href="#creditor" role="tab" aria-controls="creditor" aria-selected="false">เจ้าหนี้</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">ธนาคาร</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="bill-tab" data-toggle="tab" href="#bill" role="tab" aria-controls="bill" aria-selected="false">ใบวางบิล</a>
  </li>
</ul>
<div class="tab-content" id="tabContent">
  <div class="tab-pane fade show active" id="debtor" role="tabpanel" aria-labelledby="debtor-tab">
    <div class="card">
      <div class="card-block">      
        <div class="row text-center">
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="{{url('/')}}/debtout">
              <div class="px-3"><span class="round round-primary my-2">ค</span></i></div>
              <div>ตั้งหนี้คงค้าง</div>
            </a>
          </div>
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="{{url('/')}}/settle">
              <div class="px-3"><span class="round round-primary my-2">น</span></div>
              <div>ตั้งหนี้/ลูกหนี้</div>            
            </a>
          </div>
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="#">
              <div class="px-3"><span class="round round-primary my-2">ล</span></i></div>
              <div>ลดหนี้ลูกหนี้</div>            
            </a>
          </div>
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="#">            
              <div class="px-3"><span class="round round-primary my-2">บ</span></i></div>
              <div>ใบวางบิล</div>
            </a>
          </div>
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="#">
              <div class="px-3"><span class="round round-primary my-2">ช</span></div>
              <div>ชำระเงิน</div>            
            </a>
          </div>
          <div class="col-md-4 ">
            <a class="btn btn-outline-primary my-3" href="{{url('/')}}/debtor">
              <div class="px-3"><span class="round round-primary my-2">ฟ</span></div>
              <div>แฟ้มลูกหนี้</div>             
            </a>
          </div>          
        </div>      
      </div>  
    </div>    
  </div>
  <div class="tab-pane fade" id="creditor" role="tabpanel" aria-labelledby="creditor-tab">
    <div class="card">
      <div class="card-block">      
         
      </div>  
    </div> 
  </div>
  <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
    <div class="card">
      <div class="card-block">      
         
      </div>  
    </div> 
  </div>
  <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
    <div class="card">
      <div class="card-block">      
         
      </div>  
    </div> 
  </div>
</div>
@endsection