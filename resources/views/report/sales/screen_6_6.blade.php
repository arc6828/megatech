<center>
<h1> บริษัท เมก้า เทค คัตติ้งทูล จำกัด </h1>
<h4>วิเคราะห์ต้นทุนขาย ทั้งปีแยกตามลูกค้า (แสดง 12 เดือน)</h4>
<h4>พิมพ์ ณ วันที่ : 02/09/2019</h4> </center>
<h5>ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019</h5>
<table border=1>
<tr>
		<th>รหัสพนักงาน</th>
		<th>รายละเอียดพนักงาน</th>
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
	@foreach ($users as $users)
	<tr>
			<td> {{$users->short_name}} </td>
			<td> {{$users->name}} </td>
			<td> 0.00 </td>
			<td> 24,597.05 </td>
			<td> 54,219.30 </td>
			<td> 35,442.40 </td>
			<td> 31,900.20</td>
			<td> 46,062.00 </td>
			<td> 61,613.70 </td>
			<td> 110,566.00</td>
			<td> 11,960.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 0.00 </td>
			<td> 376,360.65 </td>
		</tr>
	@endforeach

   
</table>
