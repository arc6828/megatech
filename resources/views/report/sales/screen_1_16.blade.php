<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขาย ยอดขายลูกค้าทั้งปี</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002</h2>
<table border=1>
<tr>
		<th>รหัสลูกค้า</th>
		<th>รายละเอียด</th>
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
		<tr>
			<td> {{$customers->customer_code}} </td>
			<td> {{$customers->company_name}}</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td> 11,140.00 </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td> 11,140.00 </td>
		</tr>
	@endforeach
</table>