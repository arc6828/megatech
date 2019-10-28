<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานวิเคระาห์ต้นทุนขายตามรหัสสินค้า</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04 , ตั้งแต่วันที่ 01/08/2019 - 31/08/2019</h5>
<table border=1>
<tr>
		<th>เลขที่เอกสาร</th>
		<th>วันที่</th>
		<th>รหัสลูกค้า</th>
		<th>ชื่อบริษัท</th>
		<th>รหัสพนักงาน</th>
		<th>จำนวน</th>
		<th>หน่วยนับ</th>
		<th>ราคา/หน่วย</th>
		<th>ยอดขาย</th>
		<th>ต้นทุน/หน่วย</th>
		<th>ต้นทุนสินค้า</th>
		<th>กำไรเบื้องต้น</th>
	</tr>
	@foreach ($Product as $Product)
		<tr>
			<td> รหัสสินค้า </td>
			<td> {{$Product->product_code}}</td>
		</tr>
		@foreach ($Product->InvoiceDetail as $InvoiceDetail)
		<tr>
				<td> {{$InvoiceDetail->Invoice->invoice_code}} </td>
				<td> @php    
						$timestamp = $InvoiceDetail->Invoice->datetime;
						$splitTimeStamp = explode(" ",$timestamp);
						$date = $splitTimeStamp[0];
						$time = $splitTimeStamp[1];
					@endphp
					{{$date}}
				</td>
				<td> {{$InvoiceDetail->Invoice->Customer->customer_code}}</td>
				<td>  {{$InvoiceDetail->Invoice->Customer->company_name}} </td>
				<td> {{$InvoiceDetail->Invoice->User->short_name}} </td>
				<td> {{$InvoiceDetail->amount}}</td>
				<td>{{$Product->product_unit}}</td>
				<td>{{$InvoiceDetail->discount_price}}</td>
				<td> {{$InvoiceDetail->discount_price*$InvoiceDetail->amount}} </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>
			
		@endforeach
		<tr>	
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> ยอดรวมตามรหัสสินค้า</td>
				<td> {{$Product->product_code}}</td>
				<td> </td>
			</tr>
	@endforeach
	
</table>
