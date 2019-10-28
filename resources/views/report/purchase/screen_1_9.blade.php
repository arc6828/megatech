<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานแสดงยอดซื้อทั้งปี ตามรหัสผู้จำหน่าย<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่รหัสสินค้า DA0001 ถึง DY0002 , ตั้งแต่วันที่ 01/01/2019 - 31/12/2019
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000; text-align:center;"><b>รหัสเจ้าหนี้</td>
    <td style="border-bottom: solid 1px #000; text-align:center;" ><b>รายละเอียดเจ้าหนี้</td>
    <td style="border-bottom: solid 1px #000; " ><b>JAN</td>
    <td style="border-bottom: solid 1px #000; " ><b>FEB</td>
    <td style="border-bottom: solid 1px #000; " ><b>MAR</td>
    <td style="border-bottom: solid 1px #000; " ><b>APR</td>
    <td style="border-bottom: solid 1px #000; " ><b>MAY</td>
    <td style="border-bottom: solid 1px #000; " ><b>JUN</td>
    <td style="border-bottom: solid 1px #000; " ><b>JUL</td>
    <td style="border-bottom: solid 1px #000; " ><b>AUG</td>
    <td style="border-bottom: solid 1px #000; " ><b>SEP</td>
    <td style="border-bottom: solid 1px #000; " ><b>OCT</td>
    <td style="border-bottom: solid 1px #000; " ><b>NOV</td>
    <td style="border-bottom: solid 1px #000; " ><b>DEC</td>
    <td style="border-bottom: solid 1px #000; " ><b>รวม</td>
</tr>
@foreach ($Supplier as $Supplier)
<tr height="50">
        <td>{{$Supplier->supplier_code}}</td>
        <td>{{$Supplier->company_name}}</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>42,152.00</td>
        <td>1,160.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>43,312.00</td>
    </tr>
@endforeach
   
    
    </table>
</div>
</body>