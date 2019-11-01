<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">งบอายุลูกหนี้ แบบละเอียด<br>
พิมพ์ ณ วันที่ : 27/09/2019</p>
<div style = "margin-left: 55px;" >
<b>รหัสลูกหนี้ A0001 ถึง Z0002 , สิ้นสุด ณ วันที่ 27/09/2019

<table width="1400" border="2" cellpadding="2" cellspacing="0" style="border-top:solid 2px #000;">
<tr style = "height:30px;">
        <td style=" text-align:center" ><b>เลขที่เอกสาร</td>
        <td style=" text-align:center" ><b>วันที่</td>
        <td style=" text-align:center" ><b>ครบกำหนด</td>
        <td style=" text-align:center" ><b>Term</td>
        <td style=" text-align:center" ><b><=30 วัน</td>
        <td style=" text-align:center" ><b>31-60</td>
        <td style=" text-align:center" ><b>61-90</td>
        <td style=" text-align:center" ><b>> 90</td>
        <td style=" text-align:center" ><b>ยอดรวม</td>
 
    </tr>
<br><br>
@foreach($customer as $customer)
    <tr>
        <td>รหัสลูกหนี้</td>
        <td style="text-align:center">{{ $customer->customer_code}} {{ $customer->company_name}}</td>	
    </tr>
    @foreach($customer->Invoice as $invoices)

        <tr style = "height:60px;">
            <td style="text-align:center" >{{ $invoices->invoice_code }}</td>
            <td style="text-align:center" >{{ $invoices->datetime }}</td>
            <td style="text-align:center" >15/09/2019</td>
            <td style="text-align:center" >30</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >0</td>
        </tr>
        <tr>
            <td>ยอดรวมตามรหัสลูกค้า</td>
            <td style="text-align:center">{{ $customer->customer_code}}</td>
        </tr>
    @endforeach
@endforeach
</table>
</div>
</body>