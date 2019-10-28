
<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>รายงานแสดงยอดค้างส่ง ตามวันนัดส่ง ลูกค้า</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019 , ตั้งแต่รหัสพนักงานขาย ถึง SP , เงื่อนไข : 02-แสดงเฉพาะค้างส่ง</h5>
<table border=1>
	<tr>
		<th>วันที่</th>
		<th>เลขที่เอกสาร</th>
		<th>รหัสสินค้า</th>
		<th>รายละเอียดสินค้า</th>
		<th>PO.ลูกค้า</th>
		<th>จำนวนรับจอง</th>
		<th>จำนวนส่ง</th>
		<th>ยอดค้างส่ง</th>
		<th>SALE</th>
		<th>มูลค่าค้างส่ง</th>
		
	</tr>company_name
	@foreach ($customer as $customers)
		<tr>
			<td>รหัสลูกค้า</td>
			<td> {{$customers->customer_code}}  </td>
			<td> {{$customers->company_name}}  </td>	
		</tr>
		@foreach ($customers->Order as $Order)
			@foreach ($customers->Invoice as $invoices)
				@foreach ($invoices->InvoiceDetail as $InvoiceDetail)
					<tr>
						<td>
							@php    
								$timestamp = $Order->datetime;
								$splitTimeStamp = explode(" ",$timestamp);
								$date = $splitTimeStamp[0];
								$time = $splitTimeStamp[1];
							@endphp
							{{$date}}
						</td>
						<td>{{$Order->order_code}}</td>
						<td>{{ $InvoiceDetail->Product->product_code }}</td>
						<td>{{ $InvoiceDetail->Product->product_detail }}</td>
					</tr>
				@endforeach
			@endforeach
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>ยอดรวมตามรหัสลูกค้า</td>
			<td> {{$customers->customer_code}}  </td>
		</tr>
	@endforeach

   
</table>
