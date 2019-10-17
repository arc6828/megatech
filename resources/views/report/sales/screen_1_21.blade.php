<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขาย จำนวนขาย ลูกค้า สินค้าทั้งปี</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04</h2>
<table border=1>
	<tr>
		<th>รหัสสินค้า</th>
		<th colspan="2">รายละเอียดสินค้า</th>
		<th>เดือน 1</th>
		<th>เดือน 2</th>
		<th>เดือน 3</th>
		<th>เดือน 4</th>
		<th>เดือน 5</th>
		<th>เดือน 6</th>
		<th>เดือน 7</th>
		<th>เดือน 8</th>
		<th>เดือน 9</th>
		<th>เดือน 10</th>
		<th>เดือน 11</th>
		<th>เดือน 12</th>
		<th>รวม</th>
	</tr>

	@foreach ($customer as $customers)
		@foreach ($customers->Invoice as $invoices)
			<tr>
				<td><strong>รหัสลูกค้า</strong></td> 
				<td><strong>{{ $customers->customer_code }}</strong></td>
				<td col	span="2"><strong>{{ $customers->company_name }}</strong></td>
			</tr>
			@foreach ($invoices->InvoiceDetail as $InvoiceDetail)
				<tr>
					<td>{{ $InvoiceDetail->Product->product_code }}</td>
					<td>{{ $InvoiceDetail->Product->product_detail }}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>		
			@endforeach
		@endforeach
	@endforeach
    
</table>