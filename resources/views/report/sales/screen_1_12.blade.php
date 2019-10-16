<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขายตามยอดขายตาม ลูกค้า + วันที่</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 21/08/2019 , ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , ตั้งแต่รหัสคลัง 01 ถึง 01</h2>
<table border=1>

	<tr>
		<th>เลขที่เอกสาร</th>
		<th>วันที่</th>
		<th>รหัสสินค้า</th>
		<th>รายละเอียดสินค้า</th>
		<th>รหัสพนักงานขาย</th>
		<th>ยอดขาย/ลดหนี้</th>
		<th>จำนวนขาย/ลดหนี้</th>
	</tr>
	@foreach ($customer as $customers)
		@foreach ($customers->Invoice as $invoices)
		<tr>
			<td>{{ $invoices->invoice_code }}</td>
			<td>{{ $invoices->datetime }}</td>
			<td></td>
			<td></td>
			<td>{{ $customers->user->short_name }}</td>
			<td></td>
			<td></td>
		</tr>		
		@endforeach
	@endforeach

	
</table>