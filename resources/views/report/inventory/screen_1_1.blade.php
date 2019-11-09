<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">สรุปสินค้าคงเหลือ<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
<p style="text-indent: 4em;">ตั้งแต่รหัสสินค้า 2ALE30200S60 ถึง ZLHOLDER04 , สิ้นสุด ณ วันที่ 03/09/2019 , เงื่อนไข : 02-แสดงเฉพาะมียอด มากกว่า 0</p>


<table align="center" width="1400" border="0" padding-top="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;"><b>รหัสสินค้า<br></td>
    <td style="border-bottom: solid 1px #000;" width="400"><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;"><b>หน่วยนับหลัก</td>
     <td style="border-bottom: solid 1px #000;"><b>ยอดเงินคงเหลือ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดค้างรับ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดค้างส่ง<br></td>
  </tr>
  @foreach ($Product as $Product)
  <tr height="40">
    <td>298 &nbsp; {{$Product->product_code}}</td>
    <td>{{$Product->product_detail}} &nbsp; Holder</td>
    <td>{{$Product->product_unit}}</td>
    <td>2.00</td>
    <td>0.00</td>
    <td>0.00</td>
  </tr>
  @endforeach
 

 
</table>
</div>
</body>
