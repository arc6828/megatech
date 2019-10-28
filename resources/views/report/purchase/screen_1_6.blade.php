<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">วิเคราะห์การสั่งซื้อ ผู้จำหน่าย สินค้า ตามยอดซื้อ<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่วันที่ 01/08/2019 - 31/08/2019, ตั้งแต่รหัสเจ้าหนี้ DA001 ถึง DY0002 ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04
<br><br>
<table align="center" width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000; text-align:center;"><b>เลขที่เอกสาร</td>
    <td style="border-bottom: solid 1px #000; text-align:center;" ><b>วันที่</td>
    <td style="border-bottom: solid 1px #000; " ><b>เลขใบสั่งซื้อ</td>
    <td style="border-bottom: solid 1px #000; " ><b>รหัสสินค้า</td>
    <td style="border-bottom: solid 1px #000; " ><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000; " ><b>ยอดมูลค่าซื้อ/ลดหนี้</td>
    <td style="border-bottom: solid 1px #000; " ><b>ราคาต่อหน่วย</td>
    <td style="border-bottom: solid 1px #000; " ><b>ยอดจำนวนซื้อ / ลดหนี้</td>
</tr>
@foreach ($Supplier as $Supplier)
    <tr>
        <td>รหัสเจ้าหนี้</td>
        <td>{{$Supplier->supplier_code}}</td>
        <td>{{$Supplier->company_name}}</td>	
    </tr>
    @foreach ($Supplier->Order as $Order)
       
        <tr height="50">
                <td></td> 
                <td>
                    @php    
                        $timestamp = $Order->datetime;
                        $splitTimeStamp = explode(" ",$timestamp);
                        $date = $splitTimeStamp[0];
                        $time = $splitTimeStamp[1];
                    @endphp
                    {{$date}}
                    </td>
                <td>{{$Order->purchase_order_code}}</td>
                <td></td>
                <td>SEKN 1203 AFTN-HPN TT7080</td>
                <td style="text-align:right">3,400.00</td>
                <td>PCS</td>
                <td style="text-align:right"> 10.00</td>
            </tr>
      
          
       
    
        
    @endforeach
   
@endforeach

</table>
</div>
</body>
