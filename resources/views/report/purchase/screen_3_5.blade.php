<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานการซื้อ ตามสินค้า วันที่<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่รหัสสินค้า 2ALE30200506 ถึง ZYHOL,DERO4 ตั้งแต่วันที่ 01/08/2019 - 31/08/2019
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่</td>
   <td style="border-bottom: solid 1px #000;"> <b>วันครบกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b>รหัสเจ้าหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;"><b>จำนวน</td>
    <td style="border-bottom: solid 1px #000;"><b>ราคา/<br>หน่วย</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดเงินสินค้า/<br>รายการ</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่<br>ใบกำกับภาษี</td>

  </tr>
  @foreach ($Product as $Product)
  <tr height="50">
    <td>รหัสสินค้า {{$Product->product_code}}</td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  @foreach ($Product->ReceiveDetail as $ReceiveDetail)
    <tr height="50">
      <td>{{$ReceiveDetail->Receive->purchase_receive_code}}</td>
      <td>  @php    
        $timestamp = $ReceiveDetail->Receive->datetime;
        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];
      @endphp
      {{$date}}</td>
      <td></td>
      <td>{{$ReceiveDetail->Receive->Supplier->supplier_code}}</td>
      <td>{{$ReceiveDetail->Receive->Supplier->company_name}}</td>
      <td>1.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>IV62-1221</td>
    </tr>
  @endforeach
  
  @endforeach
 
  
</table>


</div>
</body>
