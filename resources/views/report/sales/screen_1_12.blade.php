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
				<td><strong>รหัสลูกค้า</strong></td> 
				<td><strong>{{ $customers->customer_code }}</strong></td>
				<td colspan="5"><strong>{{ $customers->company_name }}</strong></td>
			</tr>
			@foreach ($invoices->InvoiceDetail as $InvoiceDetail)
				<tr>
					<td>{{ $invoices->invoice_code }}</td>
					<td>{{ $invoices->datetime }}</td>
					<td>{{ $InvoiceDetail->Product->product_code }}</td>
					<td>{{ $InvoiceDetail->Product->product_name }} / {{ $InvoiceDetail->Product->grade }}</td>
					<td>{{ $invoices->User->short_name }}</td>
					<td>{{ $InvoiceDetail->discount_price }}</td>	
					<td>{{ $InvoiceDetail->amount }}</td>
				</tr>		
			@endforeach
		@endforeach
	@endforeach

	
</table>