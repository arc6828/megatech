<body>
<h1 style="text-align:center">บริษัท เมก้า เทค คัตติ้งทูล จำกัด</h1>
<p style="text-align:center"><b>รายงานงบอายุเจ้าหนี้ แบบละเอียด
<p style="text-align:center"><b>พิมพ์ ณ วันที่ : 26/09/2019<br></p>
<b>ตั้งแต่รหัสเจ้าหนี้ DC0002 ถึง DX0001 , สิ้นสุด ณ วันที่ 26/09/2019
<table align="center" width="1400" height="50" border="" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<td style="border-bottom: solid 1px #000;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000;"><b>วันที่</td>
    <td style="border-bottom: solid 1px #000;"><b>ครบกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b>Term</td>
    <td style="border-bottom: solid 1px #000;"><b>ไม่ถึงกำหนด</td>
    <td style="border-bottom: solid 1px #000;"><b><= 30 วัน</td>
    <td style="border-bottom: solid 1px #000;"><b>31-60</td>
    <td style="border-bottom: solid 1px #000;"><b>61-90</td>
    <td style="border-bottom: solid 1px #000;"><b> >90 </td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดรวม</td>
    </tr>
 @foreach($suppliers as $supplier)
        @foreach($supplier->receives as $receive)
<td style="border-bottom: solid 1px #000;"><b>{{$receive->purchase_receive_code}}</td>
    <td><b>{{$receive->datetime}}</td>
    <td><b>21/9/2019</td>
    <td><b>30</td>
    <td></td>
    <td>7,997.18</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>   
    @endforeach
        @endforeach
<tr hight="50">
    <td hight="30"><b>ยอดรวมตามรหัสเจ้าหนี้ DS0006</td>
    <td><b>27,727.88</td>
    <td><b>15,123.92</td>
    <td><b>0.00</td>
    <td><b>0.00</td>
    <td><b>0.00</td>
    <td><b>42,851.80</td>
    <td></td>
    <td></td>
    <td></td>
</tr></table>