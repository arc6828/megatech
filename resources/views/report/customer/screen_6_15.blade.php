<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<b><p style="text-align:center">รายงานภาษีขายแสดงยอดรวม<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>
<br>
<b>ชื่อผู้ประกอบการ :บริษัท เมก้า คัตติ้งทูล จำกัด<br>
สถานที่ประกอบการ : 17/4 : ซ.รามอินทรา 89 แขวงรามอินทรา เขตคันนายาว กรุงเทพฯ 10230 
17/4 Soi Ramindra 89 Ramindra Khannayao Bangkok 10230<br>

<style type="text/css">
#div1 {
    float:left;
    text-align:left;
}
#div2 {
    float:right;
    text-align:right;
}
</style>
 
<div id='div1'>เลขที่ประจำผู้เสียภาษี : 0125555017382, สำนักงานใหญ่</div>
<div id='div2'>ตั้งแต่วันที่ 01/09/2019 - 30/09/2019</div>

<br>
ฺ<center><table border="2" width="100%">
<tr>
  <th rowspan="2" style=" text-align:center">ลำดับ</th>
  <th colspan="2" width="20%" style=" text-align:center">ใบกำกับภาษี</th>
  <th rowspan="2" width="20%" style=" text-align:center">ชื่อผู้ซื้อสินค้า/ผู้รับบริการ</th>
  <th rowspan="2"  width="20% style=" text-align:center">เลขประจำตัวผู้เสียภาษีอากร<br>ของผู้ซื้อสินค้าผู้รับบริการ</th>
  <th colspan="2" style=" text-align:center">สถานที่ประกอบการ</th>
  <th rowspan="2" style=" text-align:center">มูลค่าสินค้า/บริการ</th>
  <th rowspan="2" style=" text-align:center">จำนวนเงินภาษี</th>
  <th rowspan="2" style=" text-align:center">ยอดรวม</th>
</tr>
<tr>
  <td  width="10%" style=" text-align:center"><b>วันที่</td>
  <td style=" text-align:center"><b>เลขที่เอกสาร</td>
  <td  width="10%" style=" text-align:center"><b>สำนักงานใหญ่</td>
  <td width="10%" style=" text-align:center"><b>สาขาที่</td>
</tr>

@foreach($customer as $customer)
    @foreach($customer->Invoice as $invoices)
        <tr style = "height:60px;">
            <td style="text-align:center" >{{ $invoices->invoice_id }}</td>
            <td style="text-align:center" >{{ $invoices->datetime }}</td>
            <td style="text-align:center" >{{ $invoices->invoice_code }}</td>
            <td style="text-align:center" >{{ $customer->company_name }}</td>
            <td style="text-align:center" >0</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >000</td>
            <td style="text-align:center" >0</td>
            <td style="text-align:center" >0</td>
        </tr>
    @endforeach
@endforeach

</table>

</body>
