<style>
		@font-face{
		 font-family:  'THSarabunNew';
		 font-style: normal;
		 font-weight: normal;
		 src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
		}
		@font-face{
		 font-family:  'THSarabunNew';
		 font-style: normal;
		 font-weight: bold;
		 src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
		}
		@font-face{
		 font-family:  'THSarabunNew';
		 font-style: italic;
		 font-weight: normal;
		 src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
		}
		@font-face{
		 font-family:  'THSarabunNew';
		 font-style: italic;
		 font-weight: bold;
		 src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
		}
		body{
		 font-family: "THSarabunNew";
		}
		
</style>
<center>
<header><h1>บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1></header>
<h3>วิเคราะห์ขายตามยอดขาย ลูกค้า<br>
พิมพ์ ณ วันที่ : 08/08/2019</h3></center>
<h3>ตั้งแต่วันที่ 01/08/2019 - 21/08/2019 , ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002</h3>
<table border=1>
	<tr>
		<th>รหัสลูกค้า</th>
		<th>รายละเอียดลูกค้า</th>
		<th>ยอดขาย/ลดหนี้</th>
	</tr>
	@foreach ($customer as $item)
	@if( $item->invoices->sum('total')  > 0)
	<tr>
		<td>{{ $item->customer_code }} </td>
		<td>{{ $item->company_name }}</td>
        <td style="text-align:right;">{{ number_format($item->invoices->sum('total'),2) }}</td>
	</tr>
	@endif
	@endforeach
    
</table>