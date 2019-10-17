<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขายตามยอดขายลูกค้าของพนักงาน</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสพนักงาน ถึง SD</h2>
<table border=1>
	<tr>
		<th>รหัสลูกค้า</th>
		<th>รายละเอียดลูกค้า</th>
		
		<th>ยอดขาย/ลดหนี้</th>
	</tr>
	@foreach ($users as $users)
	<tr>
		<td> รหัสพนักงานขาย </td>
		<td>{{ $users->short_name }}  {{ $users->name }}</td>
		<td></td>
	</tr>
	@foreach ($users->customer as $item)
	<tr>
			<td>{{ $item->customer_code }}</td>
			<td>{{ $item->company_name }}</td>
			<td></td>
	</tr>
	
	@endforeach
	
	@endforeach
	
    
</table>