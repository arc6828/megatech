<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">งบอายุลูกหนี้ แบบสรุป<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<div style = "margin-left: 55px;" >
<b>รหัสลูกหนี้ A0001 ถึง Z0002 , สิ้นสุด ณ วันที่ 26/09/2019

<table width="1400" border="2" cellpadding="2" cellspacing="0" style="border-top:solid 2px #000;">
    <tr style = "height:30px;">
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>รหัสลูกค้า</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>รายละเอียด</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>วงเงิน</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>Term</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b><=30</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>31-60</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>61-90</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>> 90</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดรวม</td>
    </tr>
<br><br>
    @foreach($customer as $customer)

    <tr style = "height:60px;">
        <td style="border-bottom: solid 0px #000; text-align:center" >{{ $customer->customer_code }}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{ $customer->company_name }}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{ $customer->max_credit }}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{ $customer->debt_duration }}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{ $customer->debt_balance }}</td>
    </tr>

    @endforeach
</table>
</div>
</body>