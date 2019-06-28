@extends('layouts/print')

@section('title','ใบเสนอราคา')

@section('content')
<style>
  .inline{
    display: inline-block;
  }
</style>
  <div>
    <div class="inline" style="width:30%;">
      <img src="{{ url('/') }}/images/megatech-logo-small.jpg" width="100%">
    </div>
    <div class="inline" style="width:70%;">
      <div>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</div>
      <div>MEGA TECH CUTTING TOOL</div>
      <div>17/4  Soi Ramindra 89 Ramindra Khannayao  Bangkok 10230</div>
      <div>Tel: 02-943-1591  Fax: 02-943-1592  E-mail: center@megatechcuttingtool.com</div>
    </div>
  </div>
  <div style="text-align:center;">
    <div class="inline" style="width:33%;">
      <strong>เลขประจำตัวผู้เสียภาษี</strong> 0125555017382
    </div>
    <div class="inline" style="width:33%;">
      <h2>ใบเสนอราคา</h2>
    </div>
    <div class="inline" style="width:33%;">
      <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
        <tr>
          <th>เลขที่</th>
          <td>QT6206-00143</td>
        </tr>
        <tr>
          <th>วันที่</th>
          <td>21/06/2019</td>
        </tr>
      </table>
    </div>
  </div>
  <div style="margin-top:10px;">
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr><td>
        <strong>ผู้ติดต่อ :</strong> คุณไพศาล <br>
        <strong>ลูกค้า :</strong> บรษัท ซีเอ็นพี จำกัด  <br>
        <strong>ที่อยู่ :</strong> 44ด5หดก564ด564ด564ฟ56ดก4หฟ564ด56หฟ4ด  <br>
        <strong>โทร :</strong> 02-152-7250 <strong>แฟ๊กซ์ :</strong> 02-152-7250  <strong>รหัสลูกค้า :</strong> C0001  <br>
      </td></tr>
    </table>
  </div>
  <div style="margin-top:10px;">
    <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
      <tr>
        <th>กำหนดยืนราคา</th>
        <th>วันที่ส่งของ</th>
        <th>ระยะเวลาหนี้</th>
        <th>พนักงานขาย</th>
      </tr>
      <tr>
        <td>...</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
      </tr>
    </table>
  </div>
  <div style="margin-top:10px;">
    <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
      <tr >
        <th>ลำดับ</th>
        <th>รหัสสินค้า</th>
        <th>รายละเอียด</th>
        <th>จำนวน</th>
        <th>หน่วยละ</th>
        <th>จำนวนเงิน</th>
      </tr>
      <tr>
        <td>...</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
      </tr>
      <tr>
        <td colspan="3"><strong>หมายเหตุ</strong><br /> ....</td>
        <td rowspan="2" colspan="3">...</td>
      </tr>
      <tr>
        <td colspan="3">...</td>
      </tr>
    </table>
  </div>

  <div style="text-align:center; margin-top:100px;">
    <div class="inline" style="width:33%;">
      __________________________<br>
      ผู้เสนอราคา<br>
      วันที่ 21/06/2019
    </div>
    <div class="inline" style="width:33%;">

    </div>
    <div class="inline" style="width:33%;">
      __________________________<br>
      ผู้อนุมัติ<br>
      วันที่ 21/06/2019
    </div>
  </div>






@endsection
