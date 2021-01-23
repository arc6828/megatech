<body>
<h1 style="text-align:center">รายงานยอดหนี้คงเหลือเรียงตามรหัสเจ้าหนี้</h1>
<p style="text-align:center"><b>พิมพ์ ณ วันที่ : 26/09/2019<br></p>
<b>ตั้งแต่รหัสเจ้าหนี้ DA0001 ถึง DY0002 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไข : 02-แสดงเฉพาะยอดหนี้คงเหลือ
<br><br>
<table align="center" width="1400" height="50" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr> 
    <td style="border-bottom: solid 1px #000;"><b>รหัสเจ้าหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ชื่อบริษัท</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดต้นงวด</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดจ่ายชำระ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดลดหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดหนี้คงเหลือ</td>

</tr>
<br><br>

@foreach($suppliers as $supplier)
<tr height="50">
    <td>{{$supplier->supplier_code}}</td>
    <td>{{$supplier->company_name}} </td>
<!--ยอดต้นงวด ยอดหนี้ -->
    <td>46,343.84</td>
    <td>0.00</td>
<!--ยอดจ่ายชำระ ยอดลดหนี้-->
    <td>45,102.64</td>
    <td>0.00</td>
    <td>{{$supplier->debt_balance}}</td></tr>
    @endforeach
<tr hight="50">
    <td colspan="2" hight="30"><b>ยอดรวมทั้งหมด</td>
    <!--ยอดต้นงวด ยอดหนี้ -->
    <td><b>4,426,596.16</td>
    <td><b>1,332,261.96</td>
    <!--ยอดจ่ายชำระ ยอดลดหนี้-->
    <td><b>2,000,368.46</td>
    <td><b>7,842.03</td>
    <!--ยอดหนี้คงเหลือ-->
    <td><b>3,750,647.63</td>
</tr>
</table>
</div>
</body>