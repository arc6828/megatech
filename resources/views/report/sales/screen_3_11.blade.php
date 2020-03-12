<center>
<style>
	.number{
		text-align:right;
	}
</style>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานการขายตามรหัสสินค้า วันที่</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสสินค้า 2ALE03200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019 </h5>
<table border=1 style="width:100%">
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
	@foreach ($Products as $Product)
		<tr>
			<td colspan="8">
				<strong>
					รหัสสินค้า {{$Product->product_code}} {{$Product->product_name}} {{$Product->grade}} 
				</strong>
			</td>
		</tr>
		@foreach ($Product->InvoiceDetail as $InvoiceDetail)
		
			<tr>
				<td>{{ $InvoiceDetail->invoice->datetime}}  </td>
				<td>{{ $InvoiceDetail->invoice->invoice_code}} </td>
				
				<td> {{ $InvoiceDetail->invoice->Customer->customer_code}}  </td>
				<td> {{ $InvoiceDetail->invoice->Customer->company_name}}</td>
				<td class="number"> {{ $InvoiceDetail->amount }} </td>	
				<td class="number">  </td>
				<td class="number"> {{ number_format($InvoiceDetail->discount_price,2)}}</td>
				<td class="number"> {{ number_format($InvoiceDetail->discount_price*$InvoiceDetail->amount,2) }} </td>
			</tr>	
			
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td class="number">
				<strong>
					ยอดรวมตามรหัสสินค้า {{$Product->product_code}}
				</strong>
			</td>			
			<td class="number">{{ number_format($Product->InvoiceDetail->sum('amount'),0) }}</td>			
			<td></td>	
			<td></td>
			<td class="number">{{ number_format($Product->InvoiceDetail->sum('discount_price'),2) }}</td>
		</tr>

	@endforeach
	
    
</table>
