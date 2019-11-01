<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">รายงานรับชำระหนี้ ตามรหัสลูกหนี้ วันที่<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<div style = "margin-left: 55px;" >
<b>ตั้งแต่รหัสลูกค้า A0001 ถึง Z0002 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019

<table width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
<tr style = "height:30px;">
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เลขที่เอกสาร</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันที่</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เลขที่เอกสารตั้งหนี้</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>วันที่ตั้งหนี้</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ครบกำหนดชำระ</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ยอดรับชำระหนี้</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ระยะเวลารับ</td>
 
    </tr>
<br><br>
@foreach($customer as $customer)
    @foreach ($customer->Invoice as $invoices)
        
            <tr>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$invoices->invoice_code}}</td>
                <td style="border-bottom: solid 0px #000; text-align:center" >{{$invoices->datetime}}</td>
                 <!-- หาเลขที่เอกสารตั้งหนี้ไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >IV6207-00141</td>
                 <!-- หาวันที่ตั้งหนี้ไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >15/7/2019</td>
                 <!-- หาวันครบกำหนดชำระไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >14/8/2019</td>
                 <!-- หายอดรับชำระหนี้ไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >8,313.90</td>
                 <!-- หาวันครบกำหนดไม่เจอ -->
                <td style="border-bottom: solid 0px #000; text-align:center" >67</td>
        
            </tr>
          
    @endforeach
@endforeach
    
</table>
</div>
</body>

