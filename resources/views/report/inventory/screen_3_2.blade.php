<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>รายงานความเคลื่อนไหวสินค้า แสดงต้นทุน</h3>
<h3>พิมพ์ ณ วันที่ : 03/09/2019</h3>
<h2>ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไข : 02-แสดงเฉพาะรายการที่เคลื่อนไหว</h2>
<table border=1>
	<tr>
		<th>วันที่</th>
		<th>รหัสคลัง</th>
		<th>เลขที่เอกสาร</th>
		<th>ยอดรับ</th>
		<th>มูลค่ารับ</th>
		<th>ต้นทุน/หน่วย</th>
		<th>ยอดออก</th>
		<th>มูลค่าออก</th>
		<th>ต้นทุน/หน่วย</th>
		<th>ยอดสุทธิ</th>
		<th>หน่วย</th>
		<th>มูลค่าสุทธิ</th>
		<th>ต้นทุน/หน่วย(สุทธิ)</th>
		<th>เลขที่อ้างอิง</th>
	</tr>
	@foreach ($Product as $Product)
	<tr>
		<td>รหัสสินค้า</td>
		<td> {{$Product->product_code}} </td>
      
	</tr>
	@foreach ($Product->gaurd_stock as $gaurd_stock)
	<tr>
		<td> 2/9/2019 </td>
		<td> 01 </td>
        <td> IV6209-00014 </td>
		<td>  </td>
		<td>  </td>
        <td>  </td>
		<td> 10.000 </td>
		<td>  </td>
        <td>  </td>
		<td> 85.000 </td>
		<td> PCS </td>
        <td> 86,125.000 </td>
		<td> 1,013.2353 </td>
		<td> OE6209-00003 </td>
	</tr>
	@endforeach

	@endforeach

    
</table>