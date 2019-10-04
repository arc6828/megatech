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
          <li><a href="{{ url('/report/sales/1/5') }}">ระบบขาย 1/5 วิเคราะห์ขาย ตามยอดขายลูกค้าของพนักงาน</a></li>
          <li><a href="{{ url('/report/sales/1/12') }}">ระบบขาย 1/12 วิเคราะห์ขาย รายละเอียดยอดขายตามลูกค้า + วันที่ (แบบที่ 2)</a></li>
          <li><a href="{{ url('/report/sales/1/15') }}">ระบบขาย 1/15 วิเคราะห์ขาย ยอดขายพนักงานทั้งปี</a></li>
          <li><a href="{{ url('/report/sales/1/16') }}">ระบบขาย 1/16 วิเคราะห์ขาย ยอดขายลูกค้าทั้งปี</a></li>
          <li><a href="{{ url('/report/sales/1/18') }}">ระบบขาย 1/18 วิเคราะห์ขาย จำนวนขายสินค้าทั้งปี</a></li>
          <li><a href="{{ url('/report/sales/1/19') }}">ระบบขาย 1/19 วิเคราะห์ขาย ยอดขายพนักงาน ลูกค้าทั้งปี</a></li>
          <li><a href="{{ url('/report/sales/1/21') }}">ระบบขาย 1/21 วิเคราะห์ขาย จำนวนขาย ลูกค้า สินค้าทั้งปี</a></li>
          <li><a href="{{ url('/report/sales/2/3') }}">ระบบขาย 2/3 รับจองสินค้า ยอดค้างส่ง ตามวันส่ง ลูกค้า</a></li>
          <li><a href="{{ url('/report/sales/3/11') }}">ระบบขาย 3/11 การขายสินค้า การขายสินค้าเรียงตามรหัสสินค้า + วันที่ (แบบที่ 2)</a></li>
          <li><a href="{{ url('/report/sales/4/1') }}">ระบบขาย 4/1 รับคืนสินค้า รายละเอียดการรับคืนสินค้า</a></li>
          <li><a href="{{ url('/report/sales/5/x') }}">ระบบขาย 5/x ใบเสนอราคา รายละเอียดใบเสนอราคา + สถานะ + เซลล์ + วันที่</a></li>
          <li><a href="{{ url('/report/sales/6/4') }}">ระบบขาย 6/4 วิเคราะห์ต้นทุนขาย ตามรหัสสินค้า</a></li>
          <li><a href="{{ url('/report/sales/6/5') }}">ระบบขาย 6/5 วิเคราะห์ต้นทุนขาย ทั้งปี แยกตามลูกค้า (แสดง 12 เดือน)</a></li>
          <li><a href="{{ url('/report/sales/6/6') }}">ระบบขาย 6/6 วิเคราะห์ต้นทุนขาย ทั้งปี แยกตามพนักงานขาย (แสดง 12 เดือน)</a></li>
        </ul>
      </div>
    </div>

  </div>
  <div class="col-lg">
    <div class="card">
      <div class="card-header"><h4>ระบบซื้อ</h4></div>
    	<div class="card-body">
          <ul>
            <li><a href="{{ url('/report/purchase/1/4') }}">ระบบซื้อ 1/4 วิเคราะห์ซื้อ เรียงตามผู้จำหน่ายสินค้า</a></li>
            <li><a href="{{ url('/report/purchase/1/6') }}">ระบบซื้อ 1/6 วิเคราะห์ซื้อ เรียงตามผู้จำหน่าย สินค้า แสดงเอกสาร</a></li>
            <li><a href="{{ url('/report/purchase/1/8') }}">ระบบซื้อ 1/8 วิเคราะห์ซื้อ จำนวนซื้อ แสดงทั้งปี เรียงตามสินค้า</a></li>
            <li><a href="{{ url('/report/purchase/1/9') }}">ระบบซื้อ 1/9 วิเคราะห์ซื้อ ยอดซื้อแสดงทั้งปี เรียงตามผู้จำหน่าย</a></li>
            <li><a href="{{ url('/report/purchase/2/2') }}">ระบบซื้อ 2/2 สั่งซื้อ/PO แสดงรายละเอียดใบสั่งซื้อ</a></li>
            <li><a href="{{ url('/report/purchase/2/3') }}">ระบบซื้อ 2/3 สั่งซื้อ/PO แสดงยอดค้างรับ ตามวันนัดรับ ผู้จำหน่าย</a></li>
            <li><a href="{{ url('/report/purchase/3/2') }}">ระบบซื้อ 3/2 การซื้อสินค้า รายละเอียดการซื้อสินค้า</a></li>
            <li><a href="{{ url('/report/purchase/3/3') }}">ระบบซื้อ 3/3 การซื้อสินค้า เรียงตามผู้จำหน่าย วันที่</a></li>
            <li><a href="{{ url('/report/purchase/3/5') }}">ระบบซื้อ 3/5 การซื้อสินค้า เรียงตามรหัสสินค้า วันที่</a></li>
            <li><a href="{{ url('/report/purchase/4/1') }}">ระบบซื้อ 4/1 การส่งคืนสินค้า รายละเอียดการส่งคืนสินค้า</a></li>
            <li><a href="{{ url('/report/purchase/5/3') }}">ระบบซื้อ 5/3 ใบเสนอซื้อ แสดงรายละเอียดใบเสนอซื้อ แบบที่ 2</a></li>
          </ul>
      </div>
    </div>

  </div>
  <div class="col-lg">
    <div class="card">
      <div class="card-header"><h4>สินค้าคงคลัง</h4></div>
    	<div class="card-body">
          <ul>
            <li><a href="{{ url('/report/inventory/1/1') }}">ระบบสินค้า 1/1 สินค้าคงเหลือ สรุปสินค้าคงเหลือ</a></li>
            <li><a href="{{ url('/report/inventory/2/1') }}">ระบบสินค้า 2/1 ต้นทุนสินค้า ต้นทุนสินค้า/หน่วย</a></li>
            <li><a href="{{ url('/report/inventory/2/6') }}">ระบบสินค้า 2/6 ต้นทุนสินค้า แสดงหลักสินค้า (FIFO)</a></li>
            <li><a href="{{ url('/report/inventory/2/9') }}">ระบบสินค้า 2/9 ต้นทุนสินค้า แสดงรายละเอียดต้นทุน/จำนวนสินค้า (FIFO)</a></li>
            <li><a href="{{ url('/report/inventory/3/2') }}">ระบบสินค้า 3/2 ความเคลื่อนไหว/สต๊อกกาด ความเคลื่อนไหวสินค้า แสดงต้นทุน</a></li>
            <li><a href="{{ url('/report/inventory/3/6') }}">ระบบสินค้า 3/6 ความเคลื่อนไหว/สต๊อกการ์ด สินค้าที่ไม่เคลื่อนไหว</a></li>
            <li><a href="{{ url('/report/inventory/3/13') }}">ระบบสินค้า 3/13 ความเคลื่อนไหว/สต๊อกการ์ด ความเคลื่อนไหวสินค้า แสดงรายละเอียดลูกหนี้</a></li>
            <li><a href="{{ url('/report/inventory/4/4') }}">ระบบสินค้า 4/4 ปรับปรุงเพิ่ม/ลด เรียงตามรหัสสินค้า วันที่</a></li>
          </ul>
    	</div>
    </div>

  </div>
</div>


@endsection