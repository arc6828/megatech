@extends('layouts/print')

@section('title','ใบวางบิล')

@section('content')

  <style>
    td , th {
      padding-left : 10px;
      padding-right : 10px;
    }
    table.no-padding-cell  td, table.no-padding-cell th{
      padding-bottom : 0px;
      padding-top : 10px;
    }
    .inline{
      display: inline-block;
    }
    .company_name{
      font-size: xx-large;
      line-height: 0.7;
      font-weight: 700;
    }
    .sub_company_name{
      line-height: 0.8;
    }
  </style>
  
  @php 
  $row = $customerbilling;
  @endphp
  <div>
    <div class="inline" style="width:30%; text-align:center;" >
      <div style="padding-right: 10px; padding-left: 10px;">
        <img src="{{ url('/') }}/images/megatech-logo-small.jpg" style="width:100%">
      </div>
      <div>  <strong>เลขประจำตัวผู้เสียภาษี</strong> 0125555017382</div>
    </div>
    <div class="inline" style="width:69%;">
      <div class="company_name">บริษัท เมก้า เทค คัตติ้งทูล จำกัด</div>
      <div class="company_name">MEGA TECH CUTTING TOOL</div>
      <div class="sub_company_name">17/4  Soi Ramindra 89 Ramindra Khannayao  Bangkok 10230</div>
      <div class="sub_company_name">Tel: 02-943-1591  Fax: 02-943-1592  E-mail: center@megatechcuttingtool.com</div>
      <div class="sub_company_name">www.megatechcuttingtool.com</div>
    </div>
  </div>
  <div style="text-align:center;">
    <div class="inline" style="width:30%;  ">

    </div>
    <div class="inline" style="width:39%;   ">
      <div style="padding-left : 40px; padding-right:40px;">
        <table style="width:100%; text-align:center;">
          <tr>
            <td style="padding: 0px 10px;">
              <div class="company_name" style="border:1px solid; padding: 10px 0px; ">@yield('title')</div>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="inline" style="width:30%;  ">
      <div class="">
      <table class="no-padding-cell" border="1" style="border-collapse: collapse; width:100%; text-align:center;">
        <tr>
          <th>เลขที่</th>
          <td>{{ $row->doc_no }}</td>
        </tr>
        <tr>
          <th>วันที่</th>
          <td>{{ $row->created_at }}</td>
        </tr>
      </table>
      </div>
    </div>
  </div>
  <div style="margin-top:10px;">
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr><td>
        <strong>ลูกค้า :</strong> {{ $row->customer->company_name }} <br>
        <strong>ที่อยู่ :</strong> {{ $row->customer->address }} {{ $row->customer->address2 }}  <br>
        <strong>โทร :</strong> {{ $row->customer->telephone }}
        <strong style="margin-left:150px;">แฟ๊กซ์ :</strong> {{ $row->customer->fax }}
        <strong style="margin-left:150px;">รหัสลูกค้า :</strong> {{ $row->customer->customer_code }}  <br>
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
        <td>30 วัน</td>
        <td>{{ $row->customer->delivery_time }}</td>
        <td>{{ $row->customer->debt_duration }}</td>
        <td>{{ $row->user->name }}</td>
      </tr>
    </table>
  </div>
  <div style="margin-top:10px;">
    <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
        <thead>
            <tr>
                <th class="text-center">เลขที่เอกสาร</th>
                <th class="text-center">วันที่</th>
                <th class="text-center">รหัสลูกค้า</th>
                <th class="text-center">ชื่อบริษัท</th>
                <th class="text-center">ยอดหนี้คงค้าง</th>
                <th class="text-center">ยอดรวม</th>
                <th class="text-center">รหัสพนักงาน</th>
            </tr>
        </thead>
      @foreach($row->customer_billing_details as $row_detail)
        <tr>
            <td> {{ $row_detail->invoice->invoice_code }}  </td>
            <td>{{ $row_detail->invoice->datetime }}</td>
            <td>{{ $row_detail->invoice->Customer->customer_code }}</td>
            <td> {{ $row_detail->invoice->Customer->company_name }} </td>
            <td>{{ $row_detail->invoice->total_debt }}</td>
            <td>{{ number_format($row_detail->invoice->total?$row_detail->invoice->total:0,2) }}</td>
            <td>{{ $row_detail->invoice->User->short_name }}</td>
        </tr>
      @endforeach
      @for($i=0; $i<(10-count($row->customer_billing_details)); $i++)
      <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
        <td><br></td>
        <td><br></td>
        <td><br></td>
        <td><br></td>
      </tr>
      @endfor
      <tr>
        <td colspan="4" style="text-align:left;"><strong>หมายเหตุ</strong><br /> {{ $row->remark !="" ? $row->remark : "-" }}</td>
        <td rowspan="2" colspan="3">
          รวมเป็นเงิน {{ $row->total }}<br>
          ภาษีมูลค่าเพิ่ม 7% {{ $row->total * $row->vat_percent / 100 }}<br>
          รวมทั้งสิ้น {{ $row->total + $row->total * $row->vat_percent / 100 }}<br>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          (...)
        </td>
      </tr>
    </table>
  </div>

  <div style="text-align:center; margin-top:70px;">
    <div class="inline" style="width:5%;"></div>
    <div class="inline" style="width:33%;">
      _______________________________________<br>
      ผู้เสนอราคา<br>
      วันที่ 21/06/2019
    </div>
    <div class="inline" style="width:23%;"></div>
    <div class="inline" style="width:33%;">
      _______________________________________<br>
      ผู้อนุมัติ<br>
      วันที่ 21/06/2019
    </div>
    <div class="inline" style="width:5%;"></div>
  </div>

  <div class="" style="text-align : center; margin-top:30px;">
    <div class="">
      <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->doc_no, "C128") }}" alt="barcode"   />
    </div>
    <div class="">
      {{ $row->doc_no }}
    </div>
  </div>







@endsection
