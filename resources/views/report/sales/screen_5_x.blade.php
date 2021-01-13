<br>
<br>
<table style="widtd:100%"  border="1"  bordercolor="black">
<tr>
    <td><center>เลขที่เอกสาร</center></td>
    <td><center>วันที่เอกสาร</center></td>
    <td><center>รหัสลูกค้า</center></td>
    <td><center>ชื่อลูกค้า</center></td>
    <td><center>จำนวน</center></td>
    <td><center>ส่วนลด %</center></td>
    <td><center>ราคา</center></td>
    <td><center>รวม</center></td>
    <td><center>รหัส</center></td>
    <td><center>รายการ</center></td>
    <td><center>พนักงานขาย</center></td>
    <td><center>รายละเอียดสถานะ</center></td>
    <td><center>รหัสสถานะ</center></td>
  </tr>
@foreach ($QuotationDetail as $QuotationDetail)
  <tr>
    <td><center>{{$QuotationDetail->Quotation->quotation_code}}</center></td>
    <td><center>
        @php    
        $timestamp = $QuotationDetail->Quotation->datetime;
        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];
      @endphp
      {{$date}}
     
    </center></td>
    <td><center>{{$QuotationDetail->Quotation->Customer->customer_code}}</center></td>
    <td><center>{{$QuotationDetail->Quotation->Customer->company_name}}</td>
    <td><center>{{$QuotationDetail->amount}}</center></td>
    <td><center></center></td>
    <td><center>{{$QuotationDetail->discount_price}}</center></td>
    <td><center></center></td>
    <td><center></center></td>
    <td><center></center></td>
    <td><center>{{$QuotationDetail->Quotation->User->name}}</center></td>
    <td><center></center></td>
    <td><center>{{$QuotationDetail->sale_status_id}}</center></td>
  </tr> 
@endforeach
  

  
</table>