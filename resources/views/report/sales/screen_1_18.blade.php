<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขาย จำนวนขายสินค้าทั้งปี</h3>
<h3>พิมพ์ ณ วันที่ : 02/09/2019</h3>
<h2>ตั้งแต่วันที่ 01/01/2019 - 31/12/2019 , ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04</h2>
<table border=1>
<tr>
		<th>รหัสสินค้า</th>
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
	@foreach ($InvoiceDetail as $InvoiceDetails)
		
	
	<tr>
		<td> {{$InvoiceDetails->Product->product_code}} </td>
		<td> {{$InvoiceDetails->Product->product_detail}} </td>	
        <td> 20.00 </td>
		<td> 20.00 </td>
		<td> 80.00 </td>
        <td> 20.00 </td>
		<td> 20.00 </td>
		<td> 60.00 </td>
        <td> 80.00 </td>
		<td> 60.00 </td>
		<td>  </td>
        <td>  </td>
		<td>  </td>
		<td>  </td>
        <td> 360.00 </td>
	</tr>
    @endforeach
</table>