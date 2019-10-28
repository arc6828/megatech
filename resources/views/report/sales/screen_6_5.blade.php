<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>วิเคราะห์ต้นทุนขาย ทั้งปีแยกตามลูกค้า (แสดง 12 เดือน)</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019</h5>
<table border=1>
<tr>
		<th>รหัสลูกค้า</th>
		<th>รายละเอียดลูกค้า</th>
		<th>JAN</th>
		<th>FEB</th>
		<th>MAR</th>
		<th>APR</th>
		<th>MAY</th>
		<th>JUN</th>
		<th>JUL</th>
		<th>AUG</th>
		<th>SEP</th>
		<th>OCT</th>
		<th>NOV</th>
		<th>DEC</th>
		<th>รวม</th>
	</tr>
	@foreach ($customer as $customer)
		<tr>
			<td> {{$customer->customer_code}}</td>
			<td>{{$customer->company_name}} </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 1,100.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 5,300.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 6,400.00 </td>
		</tr>
	@endforeach
	
  
</table>
