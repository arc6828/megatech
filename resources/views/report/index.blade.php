@extends('layouts/argon-dashboard/theme')

@section('title','รายงาน')

@section('content')
<div class="row">
  <div class="col-lg">
    <div class="card">
      <div class="card-header"><h4>ระบบขาย</h4></div>
    	<div class="card-body">
        <ul>
          <li><a href="{{ url('/report/sales/1/3') }}">ระบบขาย 1/3 วิเคราะห์ขาย ลูกค้า</a></li>
          <li><a href="{{ url('/report/sales/1/5') }}">sales/1/5</a></li>
          <li><a href="{{ url('/report/sales/1/12') }}">sales/1/12</a></li>
          <li><a href="{{ url('/report/sales/1/15') }}">sales/1/15</a></li>
          <li><a href="{{ url('/report/sales/1/16') }}">sales/1/16</a></li>
          <li><a href="{{ url('/report/sales/1/18') }}">sales/1/18</a></li>
          <li><a href="{{ url('/report/sales/1/19') }}">sales/1/19</a></li>
          <li><a href="{{ url('/report/sales/1/21') }}">sales/1/21</a></li>
          <li><a href="{{ url('/report/sales/2/3') }}">sales/2/3</a></li>
          <li><a href="{{ url('/report/sales/3/11') }}">sales/3/11</a></li>
          <li><a href="{{ url('/report/sales/4/1') }}">sales/4/1</a></li>
          <li><a href="{{ url('/report/sales/5/x') }}">sales/5/x</a></li>
          <li><a href="{{ url('/report/sales/6/4') }}">sales/6/4</a></li>
          <li><a href="{{ url('/report/sales/6/5') }}">sales/6/5</a></li>
          <li><a href="{{ url('/report/sales/6/6') }}">sales/6/6</a></li>
        </ul>
      </div>
    </div>

  </div>
  <div class="col-lg">
    <div class="card">
      <div class="card-header"><h4>ระบบซื้อ</h4></div>
    	<div class="card-body">
          <ul>
            <li><a href="{{ url('/report/purchase/1/4') }}">purchase/1/4</a></li>
            <li><a href="{{ url('/report/purchase/1/6') }}">purchase/1/6</a></li>
            <li><a href="{{ url('/report/purchase/1/8') }}">purchase/1/8</a></li>
            <li><a href="{{ url('/report/purchase/1/9') }}">purchase/1/9</a></li>
            <li><a href="{{ url('/report/purchase/2/2') }}">purchase/2/2</a></li>
            <li><a href="{{ url('/report/purchase/2/3') }}">purchase/2/3</a></li>
            <li><a href="{{ url('/report/purchase/3/2') }}">purchase/3/2</a></li>
            <li><a href="{{ url('/report/purchase/3/3') }}">purchase/3/3</a></li>
            <li><a href="{{ url('/report/purchase/3/5') }}">purchase/3/5</a></li>
            <li><a href="{{ url('/report/purchase/4/1') }}">purchase/4/1</a></li>
            <li><a href="{{ url('/report/purchase/5/3') }}">purchase/5/3</a></li>
          </ul>
      </div>
    </div>

  </div>
  <div class="col-lg">
    <div class="card">
      <div class="card-header"><h4>สินค้าคงคลัง</h4></div>
    	<div class="card-body">
          <ul>
            <li><a href="{{ url('/report/inventory/1/1') }}">inventory/1/1</a></li>
            <li><a href="{{ url('/report/inventory/2/1') }}">inventory/2/1</a></li>
            <li><a href="{{ url('/report/inventory/2/6') }}">inventory/2/6</a></li>
            <li><a href="{{ url('/report/inventory/2/9') }}">inventory/2/9</a></li>
            <li><a href="{{ url('/report/inventory/3/2') }}">inventory/3/2</a></li>
            <li><a href="{{ url('/report/inventory/3/6') }}">inventory/3/6</a></li>
            <li><a href="{{ url('/report/inventory/3/13') }}">inventory/3/13</a></li>
            <li><a href="{{ url('/report/inventory/4/4') }}">ระบบสินค้า 4/4 ปรับปรุงเพิ่ม/ลด เรียงตามรหัสสินค้า วันที่</a></li>
          </ul>
    	</div>
    </div>

  </div>
</div>


@endsection
