@extends('template/template')
@section('content')
<h1>เมนูหลัก</h1>
<section class="resume-section p-3 p-lg-5 d-flex d-column">
 	<div class="container">
 		<ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">ลูกหนี้</a></li>
      <li><a data-toggle="tab" href="#menu1">เจ้าหนี้</a></li>
      <li><a data-toggle="tab" href="#menu2">ธนาคาร</a></li>
      <li><a data-toggle="tab" href="#menu3">ใบวางบิล</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
      	<br><br>
        <div class="container">
        <a class="btn btn-outline-primary" href="{{url('/')}}/debtout">ตั้งหนี้คงค้าง</a>
    	<a class="btn btn-outline-primary" href="{{url('/')}}/settle">ตั้งหนี้/ลูกหนี้</a>
    	<a class="btn btn-outline-primary" href="#">ลดหนี้ลูกหนี้</a>
    	<a class="btn btn-outline-primary" href="#">ใบวางบิล</a><br><br>
    	<a class="btn btn-outline-primary" href="#">ชำระเงิน</a>
    	<a class="btn btn-outline-primary" href="{{url('/')}}/debtor">แฟ้มลูกหนี้</a>
    	</div>
      </div>
      <div id="menu1" class="tab-pane fade">
        <h3>Menu 1</h3>
        <p>Some content in menu 1.</p>
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
      </div>
      <div id="menu3" class="tab-pane fade">
        <h3>Menu 3</h3>
        <p>Some content in menu 3.</p>
      </div>
    </div>
  </div>
</section>
@endsection