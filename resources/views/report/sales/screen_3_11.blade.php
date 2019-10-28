<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานการขายตามรหัสสินค้า วันที่</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสสินค้า 2ALE03200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019 </h5>
<table border=1>
<tr>
		<th>วันที่</th>
		<th>เลขที่เอกสาร</th>
		<th>รหัสลูกค้า</th>
		<th>ชื่อบริษัท</th>
		<th>จำนวน</th>
		<th>ส่วนลด(%)</th>
		<th>ราคาขาย</th>
		<th>ยอดเงิน</th>
		
		
	</tr>
	@foreach ($Product as $Product)
		<tr>
			<td>รหัสสินค้า </td>
			<td> {{$Product->product_code}} </td>
		</tr>
		@foreach ($Product->InvoiceDetail as $InvoiceDetail)
		
				<tr>
					<td> </td>
					<td>{{ $InvoiceDetail->invoice->invoice_code}} </td>
					
					<td> {{ $InvoiceDetail->invoice->Customer->customer_code}}  </td>
					<td> {{ $InvoiceDetail->invoice->Customer->company_name}}</td>
					<td> {{ $InvoiceDetail->amount}} </td>	
					<td> </td>
					<td> {{ $InvoiceDetail->discount_price}}</td>
					<td>  {{ $InvoiceDetail->discount_price*$InvoiceDetail->amount}} </td>
				</tr>
		
			
		@endforeach
	@endforeach
	
    
</table>
