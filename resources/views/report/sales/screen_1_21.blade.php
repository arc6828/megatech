<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขาย จำนวนขาย ลูกค้า สินค้าทั้งปี</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04</h2>
<table border=1 style="width:100%">
	<tr>
		<th>รหัสสินค้า</th>
		<th>รายละเอียดสินค้า</th>
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
	<style>
		.number{
			text-align:right;
		}
	</style>

	@foreach ($customer as $customers)
		@foreach ($customers->Invoice as $invoices)
			<tr>
				<td><strong>รหัสลูกค้า</strong></td> 
				<td colspan="14"><strong>{{ $customers->customer_code }} {{ $customers->company_name }}</strong></td>
			</tr>
			@foreach ($invoices->InvoiceDetail as $InvoiceDetail)
				<tr>
					<td> {{ $InvoiceDetail->Product->product_code }} </td>
					<td> {{ $InvoiceDetail->Product->product_name }} / {{$InvoiceDetail->Product->grade}} </td>	
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 1 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 2 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 3 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 4 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 5 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 6 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 7 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 8 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 9 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 10 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 11 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ date("n",strtotime($invoices->datetime)) == 12 ? number_format($InvoiceDetail->amount,0) : '' }}</td>
					<td class="number">  {{ number_format($InvoiceDetail->amount,0) }}</td>
					
				</tr>	
			@endforeach
			
		@endforeach
	@endforeach
    
</table>