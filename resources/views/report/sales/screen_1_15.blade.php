<h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<h3>วิเคราะห์ขาย ยอดขายพนักงานทั้งปี</h3>
<h3>พิมพ์ ณ วันที่ : 08/08/2019</h3>
<h2>ตั้งแต่วันที่ 01/08/2019 - 31/08/2019 , ตั้งแต่รหัสพนักงาน ถึง SD</h2>
<table border=1>
<tr>
		<th>รหัส</th>
		<th>ชื่อ - สกุล</th>
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
	<style>
		.number{
			text-align:right;
		}
	</style>
	@foreach ($users as $user)
		<tr>
			<td > {{$user->short_name }} </td>
			<td> {{$user->name }} </td>
			<td class="number">  {{number_format($user->invoices_by_month(1)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(2)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(3)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(4)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(5)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(6)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(7)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(8)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(9)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(10)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(11)->sum('total'),2) }}</td>
			<td class="number">  {{number_format($user->invoices_by_month(12)->sum('total'),2)}}</td>
			<td class="number"> {{number_format($user->invoices->sum('total'),2)}}</td>
		</tr>
	@endforeach
</table>