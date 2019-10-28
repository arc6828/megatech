<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานยอดค้างรับตาม วันนัดรับ ผู้จำหน่าย<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่วันนัดส่ง 01/08/2019-31/08/2019, ตั้งแต่รหัสเจ้าหนี้ DA0001 ถึง DY0002, เงื่อนไข : 02-แสดงเฉพาะค้างรับ
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่</td>
   <td style="border-bottom: solid 1px #000;" ><b>รหัสสินค้า</td>
   <td style="border-bottom: solid 1px #000;  width:300;"><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;  width:300;"><b>จำนวนสั่งซื้อ</td>
    <td style="border-bottom: solid 1px #000;"><b>จำนวนรับแล้ว</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดค้างรับ</td>
     
    </tr>
    @foreach ($OrderDetail as $OrderDetail)
    <tr height="50">
        <td>วันที่ส่งสินค้า</td>
         <td></td> 
      
      
    </tr>
    <tr height="50">
        <td>รหัสเจ้าหนี้</td>
        <td>{{$OrderDetail->Order->Supplier->supplier_code}}</td>
        
        
      </tr>     
      <tr height="50">
        <td>{{$OrderDetail->Order->purchase_order_code}}</td>
        <td>
            @php    
              $timestamp = $OrderDetail->Order->datetime;
              $splitTimeStamp = explode(" ",$timestamp);
              $date = $splitTimeStamp[0];
              $time = $splitTimeStamp[1];
            @endphp
          {{$date}}
  </td>
        <td>{{$OrderDetail->Product->product_code}}</td>
        <td>{{$OrderDetail->Product->product_detail}}</td>
        <td>{{$OrderDetail->amount}}</td>
        <td>0.00</td>
        <td>1.00</td>
       
      </tr>
      <tr height="50">
        <td></td>
        <td></td>
        <td></td>
        <td>ยอดรวมตามรหัสเจ้าหนี้</td>
        <td></td>
        <td></td>
        <td></td>
        
      </tr>
      <tr height="50">
          <td></td>
          <td></td>
          <td></td>
          <td>ยอดรวมตามวันส่งสินค้า</td>
          <td></td>
          <td></td>
          <td></td>
          
        </tr>
    @endforeach

 
</table>


</div>
</body>
