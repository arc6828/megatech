<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">รายงาน เอกสารขายที่ยังไม่วางบิล<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<div style = "margin-left: 55px;" >
<b>รหัสลูกหนี้ A0001 ถึง Z0002 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019, เงื่อนไข : แสดงรายการเฉพาะยอดคงค้าง

<table width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
<tr style = "height:30px;">
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เลขที่เอกสาร</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันที่</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันนัดรับ</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ยอดเงินรวม</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ภาษีมูลค่าเพิ่ม</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>มูลค่าสินค้า</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>รหัสพนักงาน</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ชื่อ</td>
    </tr>
<br><br>
@foreach($customer as $customer)
    <tr>
        <td>รหัสลูกค้า</td>
        <td style="border-bottom: solid 0px #000; text-align:center">{{ $customer->customer_code}} {{ $customer->company_name}}</td>	
    </tr>
    @foreach($customer->Invoice as $invoices)

        <tr style = "height:60px;">
            <td style="border-bottom: solid 0px #000; text-align:center" >{{ $invoices->invoice_code }}</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >{{ $invoices->datetime }}</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >15/09/2019</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >30</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >000</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >KC</td>
            <td style="border-bottom: solid 0px #000; text-align:center" >KANTACHAI</td>
        </tr>
        <tr>
            <td>ยอดรวมตามรหัสลูกค้า</td>
            <td style="border-bottom: solid 0px #000; text-align:center">{{ $customer->customer_code}}</td>
        </tr>
    @endforeach
@endforeach
</table>
</div>
</body>