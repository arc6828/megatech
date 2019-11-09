<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>รายงานสินค้าที่ไม่เคลื่อนไหว</h3>
<h3>พิมพ์ ณ วันที่ : 03/09/2019</h3>
<h2>ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , เงื่อนไข : ไม่เคลื่อนไหวตั้งแต่ 180 วันขึ้นไป</h2>
<table border=1>
	<tr>
		<th>รหัสสินค้า</th>
		<th>รายละเอียดสินค้า</th>
		<th>จำนวน</th>
		<th>หน่วยรับ</th>
		<th>มูลค่า</th>
		<th>ทุน/หน่วย</th>
		<th>วันล่าสุด</th>
		<th>วัน</th>
	</tr>
	@foreach ($Product as $Product)
	<tr>
		<td>  {{$Product->product_code}}</td>
		<td> TOP 3275-32T2-09 HOLDER </td>
        <td> 1.00 </td>
		<td> {{$Product->product_unit}} </td>
		<td> 6,625.000 </td>
        <td> 6,625.000 </td>
		<td> 26/1/2018 </td>
		<td> 585 </td>
	</tr>
	@endforeach

   
</table>