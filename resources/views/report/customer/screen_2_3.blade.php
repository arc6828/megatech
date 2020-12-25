<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">รายงานตั้งหนี้ลูกหนี้ ตามรหัสลูกหนี้ วันที่<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<div style = "margin-left: 55px;" >
<b>ตั้งแต่รหัสลูกหนี้ A0001 ถึง Z0002 , วันที่ 01/09/2019 - 30/09/2019, เงื่อนไข : แสดงทั้งหมด

<table width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
<tr style = "height:30px;">
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เลขที่เอกสาร</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันที่เอกสาร</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันครบกำหนด</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เครดิต</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ยอดตั้งหนี้</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ยอดรับชำระ</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ยอดหนี้คงเหลือ</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เลขที่ PO</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>รหัสพนักงานขาย</td>
    </tr>
<br><br>

@foreach($customer as $customer)
    @foreach ($customer->Invoice as $invoices)
      
            <tr>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$invoices->invoice_code}}</td>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$invoices->datetime}}</td>
                <!-- หาวันครบกำหนดไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >9/10/2019</td>
                <!-- หาวันเครดิตไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >30</td>
                <!-- หายอดตั้งหนี้ไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >1,391.00</td>
                 <!-- ยอดรับชำระไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >1,391.00</td>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->debt_balance}}</td>
                <!-- เลขที่ PO -->
                <td style="border-bottom: solid 0px #000; text-align:center" ></td>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$invoices->User->short_name}}</td>
            </tr>
            
        @endforeach
    @endforeach
   
   
</table>
</div>
</body>
