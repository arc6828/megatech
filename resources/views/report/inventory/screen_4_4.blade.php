<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>รายงาน ปรับปรุงเพิ่ม/ลด ตามรหัสสินค้า วันที่</h3>
<h3>พิมพ์ ณ วันที่ : 03/09/2019</h3>
<h2>ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ชนิดรายการ : 01-แสดงรายการทั้งหมด</h2>
<table border=1>
	<tr>
		<th>วันที่</th>
		<th>เลขที่เอกสาร</th>
		<th>รหัสพนักงาน</th>
		<th>ชื่อพนักงาน</th>
		<th>รายละเอียดการปรับปรุง</th>
		<th>จำนวน</th>
		<th>หน่วยนับ</th>
		<th>ต้นทุน/หน่วย</th>
		<th>มูลค่าต้นทุน</th>
		<th>รหัสคลัง</th>
		<th>ชนิด</th>
	</tr>
	@foreach ($Product as $Product)
	<tr>
		<td>รหัสสินค้า</td>
		<td> {{$Product->product_code}} </td>
      
	</tr>
	

	@foreach ($Product->gaurd_stock as $gaurd_stock)
	<tr>
		<td> 15/8/2019 </td>
		<td> AJ6208-00029 </td>
        <td>  </td>
		<td>  </td>
		<td> ใบส่งของชั่วคราว </td>
        <td> -1.00 </td>
		<td> PCS </td>
		<td> 0.00 </td>
		<td> 0.00 </td>
		<td> 01 </td>
		<td> 02-ปรับปรุงลด </td>
	</tr>
	@endforeach
	@endforeach
</table>