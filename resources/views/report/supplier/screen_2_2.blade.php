<body>
<h1 style="text-align:center">บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<p style="text-align:center"><b>รายงานตั้งหนี้เจ้าหนี้ ตามรหัสเจ้าหนี้ วันที่
<p style="text-align:center"><b>พิมพ์ ณ วันที่ : 26/09/2019<br></p>
<b>ตั้งแต่รหัสเจ้าหนี้ DA0001 ถึง DY0002 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไขรายงาน แสดงเฉพาะยอดคงค้าง
<br><br>
<table align="center" width="1400" height="50" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr> 
    <td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันครบรอบกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดตั้งหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดรับชำระ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดหนี้คงเหลือ</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่ PO</td>
    <td style="border-bottom: solid 1px #000;"><b>รหัสแผนก</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่ใบกำกับภาษี</td>
    </tr>
    @foreach($suppliers as $supplier)
        @foreach($supplier->receives as $receive)
<tr height="50">
    <td>{{$receive->purchase_receive_code}}</td>
    <td>{{$receive->datetime}}</td>
    <!-- หาวันครบรอบกำหนดไม่เจอ-->
    <!-- หายอดตั้งหนี้ ยอดรับชำระ ยอดหนี้คงเหลือไม่เจอ-->
    <td>7/10/2019 </td>
    <td>240.75</td>
    <td>0.00</td>
    <td>240.75</td>
    <!---->
    <td>{{$receive->internal_reference_doc}}</td>
    <td>01</td>
    <td>IV6209174</td>
    </tr>
<tr hight="50">
    <td colspan="3" hight="30"><b>ยอดรวมตามรหัสเจ้าหนี้ DC0002</td>
    <td><b>27,727.88</td>
    <td><b>0.00</td>
    <td><b>27,727.88</td>
<tr>
    <td><b>รหัสเจ้าหนี้</td>
    <td><b>{{$supplier->supplier_code}} {{$supplier->company_name}}</td>  
    <tr hight="50">
    <td>{{$receive->purchase_receive_code}}</td>   
</tr>
 @endforeach
        @endforeach
</tr></table>