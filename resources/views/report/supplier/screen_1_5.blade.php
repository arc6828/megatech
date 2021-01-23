<body>
<h1 style="text-align:center">บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<p style="text-align:center"><b>รายละเอียดยอดเจ้าหนี้คงเหลือ แบบที่ 2</p>
<p style="text-align:center"><b>พิมพ์ ณ วันที่ : 26/09/2019<br></p>
<b>ตั้งแต่รหัสเจ้าหนี้ DA0001 ถึง DY0002 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไข : 02-แสดงเฉพาะยอดหนี้คงเหลือ
<br><br>
<table align="center" width="1400" height="50" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<table align="center" width="1400" height="50" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr> 
    <td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันครบกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดตั้งหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดชำระ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดลดหนี้</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดหนี้คงเหลือ</td>
    <td style="border-bottom: solid 1px #000;"><b>เลขที่ใบกำกับภาษี</td>
    </tr>
    @foreach($suppliers as $supplier)
        @foreach($supplier->receives as $receive)
<tr height="50">  
    <td><b>รหัสเจ้าหนี้</td>
    <td><b>{{$supplier->supplier_code}} {{$supplier->company_name}}</td>  
<tr hight="50">
    <td><b>{{$receive->purchase_receive_code}}</td>   
    <td>{{$receive->datetime}}</td>
    <!--หายอดตั้งหนี้ ยอดชำระ ยอดลดหนี้ ยอดหนี้คงเหลือ-- ไม่เจอ-->
    <td>04/09/2019</td>
    <td style="border-bottom: solid 1px #000;">1,2410.20</td>
    <td style="border-bottom: solid 1px #000;">0.00</td>
    <td style="border-bottom: solid 1px #000;">0.00</td>
    <td style="border-bottom: solid 1px #000;">1,2410.20</td>
    <td>20190805K327<td>
    </tr>
      @endforeach
    @endforeach
    </tr></table>
      