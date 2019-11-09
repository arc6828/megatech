<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>รายงานความเคลื่อนไหวสินค้า</h3>
<h3>พิมพ์ ณ วันที่ : 03/09/2019</h3>
<h2>ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไข : แสดงเฉพาะรายการที่เคลื่อนไหว</h2>
<table border=1>
	<tr>
		<th>วันที่</th>
		<th>เลขที่เอกสาร</th>
		<th>เลขที่อ้างอิง</th>
		<th>รหัสลูกค้า</th>
		<th>ชื่อบริษัท</th>
		<th>คลัง</th>
		<th>ยอดรับ</th>
		<th>ยอดออก</th>
		<th>ยอดสุทธิ</th>
		<th>หน่วย</th>
	</tr>
	@foreach ($Product as $Product)
	<tr>
		<td> รหัสสินค้า </td>
		<td>  {{$Product->product_code}}</td>
        
	</tr>
	@foreach ($Product->gaurd_stock as $gaurd_stock)
	<tr>
		<td> 3/9/2019 </td>
		<td> AJ6209-00007 </td>
        <td>  </td>
		<td> 01 </td>
		<td> แผนกฝ่ายขาย </td>
        <td> 01 </td>
		<td> 10.0000 </td>
		<td>  </td>
		<td> 20.0000 </td>
		<td>  </td>
	</tr>
	@endforeach
  
	@endforeach
	
</table>