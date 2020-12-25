<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานแสดงการขายสินค้า/พนักงานที่มียอดเก็บเงิน</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัส CM ถึง CM </h5>
<table border=1>
<tr>
		<th>เอกสารขาย</th>
		<th>ลูกค้า</th>
		<th>สินค้า</th>
		<th>รายละเอียด</th>
		<th>จำนวน </th>
		<td>หน่วย</td>
		<th>ราคา</th>
		<th>ยอดเงิน</th>
		<th>เอกสารรับชำระ</th>
		<th>วันที่ชำระ</th>
		
	</tr>
	@foreach ($users as $users)
		<tr>
			<td>รหัสพนักงานขาย</td>
			<td> {{$users->short_name}} 
			 {{$users->name}} 
			</td>	
		</tr>
		@foreach ($users->Invoice as $Invoice)
			@foreach ($Invoice->InvoiceDetail as $InvoiceDetail)
				<tr>
					<td> {{$Invoice->invoice_code}}  </td>
					<td> {{$Invoice->Customer->company_name}} </td>
					<td> {{$InvoiceDetail->Product->product_code}}  </td>
					<td> {{$InvoiceDetail->Product->product_detail}} </td>
					<td>{{$InvoiceDetail->amount}} </td>
					<td>  {{$InvoiceDetail->Product->product_unit}}</td>	
					<td>  </td>	
					<td>  </td>
					<td>  </td>
					<td> </td>
			
				</tr>
			@endforeach
		
		@endforeach
		
	@endforeach
	
</table>
