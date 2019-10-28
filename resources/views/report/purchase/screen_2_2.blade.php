<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานแสดงรายละเอียดใบสั่งซื้อ<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่เลขที่เอกสาร PO5803-00150 ถึง PO6209-00004, ตั้งแต่วันที่ 01/08/2019 - 31/08/2019
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;"><b>รหัสสินค้า</td>
    <td style="border-bottom: solid 1px #000;" width="500"><b>รายละเอียดสินค้า</td>
   <td style="border-bottom: solid 1px #000;"> <b>จำนวนสั่งซื้อ</td>
    <td style="border-bottom: solid 1px #000;"><b>หน่วยนับ</td>
    <td style="border-bottom: solid 1px #000;"><b>ราคา/<br>หน่วย</td>
    <td style="border-bottom: solid 1px #000;"><b>ส่วนลด/<br>รายการ</td>
     <td style="border-bottom: solid 1px #000;"><b>ยอดเงินสินค้า/<br>รายการ</td>
    <td style="border-bottom: solid 1px #000;"><b>ภาษีมูลค่าเพิ่ม</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่ PR <br>ยอดเงิน</td>
  </tr>
  @foreach ($Order as $Order)
  <tr height="50">
      <td><b>เลขที่เอกสาร</td>
      <td width="500"><b>{{$Order->purchase_order_code}}  
        วันที่เอกสาร    
       @php    
          $timestamp = $Order->datetime;
          $splitTimeStamp = explode(" ",$timestamp);
          $date = $splitTimeStamp[0];
          $time = $splitTimeStamp[1];
        @endphp
        {{$date}}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr height="50">
        <td><b>รหัสเจ้าหนี้</td>
        <td width="500"><b>{{$Order->Supplier->supplier_code}}  {{$Order->Supplier->company_name}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @foreach ($Order->OrderDetail as $OrderDetail)
    <tr height="50">
        <td>{{$OrderDetail->Product->product_code}}</td>
        <td width="500">{{$OrderDetail->Product->product_detail}}</td>
        <td>{{$OrderDetail->amount}}</td>	
        <td>{{$OrderDetail->Product->product_unit}}</td>
        <td>{{$OrderDetail->Product->product_unit}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @endforeach
   
  @endforeach
  
</table>
</div>
</body>
