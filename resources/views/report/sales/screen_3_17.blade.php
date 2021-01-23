<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานราคาสินค้า แต่ละลูกค้า</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสสินค้า K0002 ถึง K0002 , ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 </h5>
<table border=1>
<tr >
		<th>ประเภทสินค้า</th>
		<th>รหัสสินค้า</th>
		<th>รายละเอียด</th>
		<th>ราคา</th>
		<th>ส่วนลด</th>
		
		
	</tr>
@foreach ($customer as $customer)
	<tr>
		<td> รหัสลูกค้า </td>
		<td> {{$customer->customer_code}} </td>
		<td>{{$customer->company_name}}</td>
	</tr>
	@foreach ($customer->Invoice as $Invoice)
	@foreach ($Invoice->InvoiceDetail as $InvoiceDetail)
		
	@endforeach
		<tr>
			<td></td>
			<td> {{$InvoiceDetail->Product->product_code}} </td>
			<td>  {{$InvoiceDetail->Product->product_name}} {{$InvoiceDetail->Product->grade}}</td>
			<td>  </td>
			<td> </td>
			
		</tr>
	@endforeach
	
@endforeach
	
	
</table>
