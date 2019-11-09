<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">ต้นทุนสินค้า/หน่วย<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
<p style="text-indent: 4em;">ตั้งแต่รหัสสินค้า 2ALE30200S06 ถึง ZYHOLDER04 , สิ้นสุด ณ วันที่ 03/09/2019 , เงื่อนไข : 02-แสดงเฉพาะมียอด มากกว่า 0</p>


<table align="center" width="1400" border="0" padding-top="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000;" width="200"><b>รหัสสินค้า<br></td>
    <td style="border-bottom: solid 1px #000;" width="400"><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;"align = 'right'><b>ยอดคงเหลือ&nbsp;</td>
    <td style="border-bottom: solid 1px #000;" align = 'left'>&nbsp;<b>หน่วยนับหลัก</td>
    <td style="border-bottom: solid 1px #000;"><b>ต้นทุน/หน่วย</td>
    <td style="border-bottom: solid 1px #000;"><b>มูลค่าปลายงวด<br></td>
  </tr>
@foreach ($Product as $Product)
<tr height="40" >
  <td align = 'left'>{{$Product->product_code}}</td>
  <td align = 'left'>{{$Product->product_detail}} &nbsp; TT9080</td>
  <td align = 'right'>280.00 &nbsp;</td>
  <td align = 'left'>&nbsp; {{$Product->product_unit}}</td>
  <td>325.00</td>
  <td>91,000.00</td>
</tr>
@endforeach
  

</table>
</div>
</body>
