<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานการซื้อ ตามผู้จำหน่าย วันที่<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่รหัสเจ้าหนี้ DA0001 ถึง DY0002, ตั้งแต่วันที่ 01/08/2019 - 31/08/2019
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่</td>
   <td style="border-bottom: solid 1px #000;"> <b>วันครบกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b>รหัสสินค้า</td>
    <td style="border-bottom: solid 1px #000;"><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;"><b>จำนวน</td>
     <td style="border-bottom: solid 1px #000;"><b>หน่วยนับ</td>
    <td style="border-bottom: solid 1px #000;"><b>ราคา/<br>หน่วย</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดเงินสินค้า/<br>รายการ</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่<br>ใบกำกับภาษี</td>

  </tr>
  @foreach ($Supplier as $Supplier)
  <tr height="50">
    <td>รหัสเจ้าหนี้ {{$Supplier->supplier_code}}</td>
    <td>14/8/2019</td>
    
  </tr>
  @foreach ($Supplier->receives as $receives)
    @foreach ($receives->ReceiveDetail as $ReceiveDetail)
    <tr height="50">
      <td>{{$receives->purchase_receive_code}}</td>
      <td>
        @php    
        $timestamp = $receives->datetime;
        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];
      @endphp
      {{$date}}</td>
      <td></td>
      <td>{{$ReceiveDetail->Product->product_code}}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    @endforeach
 
  @endforeach

  @endforeach
  
  
</table>


</div>
</body>
