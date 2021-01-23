<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">ยอดหนี้คงเหลือเรียงตามลูกหนี้<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<div style = "margin-left: 55px;" >
<b>รหัสลูกหนี้ A0001 ถึง Z0002 , วันที่ 01/09/2019 - 30/09/2019, เงื่อนไข : 02-แสดงเฉพาะยอดหนี้คงเหลือ

<table width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
    <tr style = "height:30px;">
        <td style="border-bottom: solid 0px #000; text-align:center" width="15%" ><b>รหัสลูกค้า</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ชื่อบริษัท</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดต้นงวด</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดหนี้</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดรับชำระ</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดลดหนี้</td>
        <td style="border-bottom: solid 0px #000; text-align:center" ><b>ยอดหนี้คงเหลือ</td>
    </tr>
    
<br><br>

@foreach($customer as $customer)
    <tr style = "height:30px;">
        <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->customer_code}}</td>
        <td style="border-bottom: solid 0px #000; " >{{$customer->company_name}}</td>
        <!-- //ยอดต้นงวด,ยอดหนี้ หาในตารางไม่เจอ -->
        <td style="border-bottom: solid 0px #000; text-align:center" >36,369.30</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >19,688.00</td>
        <!-- //ยอดรับชำระ,ยอดลดหนี้ -->
        <td style="border-bottom: solid 0px #000; text-align:center" >11,449.00</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >0.00</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->debt_balance}}</td>
    </tr>

@endforeach


   
    
</table>
</div>
</body>