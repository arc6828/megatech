<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานสรุปการขายลูกค้า เรียงตามยอดขาย</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสสินค้า A0001 ถึง Z0002  </h5>
<table border=1>
<tr>
		<th>รหัสลูกค้า</th>
		<th>รายละเอียดลูกค้า</th>
		<th>ยอดขาย/ลดหนี้</th>
		<th>ภาษีมูลค่าเพิ่ม</th>
		<th>ยอดขายสุทธิ</th>
		
		
	</tr>
	@foreach ($customer as $customer)
	<tr>
			<td> {{$customer->customer_code}} </td>
			<td> {{$customer->company_name}} </td>
			<td> 326,215.00 </td>
			<td> 22,835.05 </td>
			<td> 349,050.05</td>
	
			
		</tr>
	@endforeach
	
 
</table>
