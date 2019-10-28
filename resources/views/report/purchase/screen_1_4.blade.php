<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">วิเคราะห์การสั่งซื้อ ผู้จำหน่าย สินค้า ตามยอดซื้อ<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่วันที่ 01/08/2019 - 31/08/2019, ตั้งแต่รหัสเจ้าหนี้ DA001 ถึง DY0002 ตั้งแต่รหัสสินค้า 2ALE030200S06 ถึง ZYHOLDER04
<br><br>
<table width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
    <tr>
        <td style="border-bottom: solid 1px #000; text-align:center;"><b>รหัสสินค้า</td>
            
        <td style="border-bottom: solid 1px #000; " ><b>รายละเอียดสินค้า</td>
        <td style="border-bottom: solid 1px #000; " ><b>จำนวนซื้อ / ลดหนี้</td>
        <td style="border-bottom: solid 1px #000; " ><b>หน่วย</td>
        <td style="border-bottom: solid 1px #000; " ><b>ยอดซื้อ / ลดหนี้</td>
    </tr>
    @foreach ($OrderDetail as $OrderDetail)
      
        
            <tr >
                    <td >{{$OrderDetail->Product->product_code}}</td> 
                    <td>{{$OrderDetail->Product->product_detail}}</td>
                    <td>{{$OrderDetail->amount}}</td>	
                    <td>{{$OrderDetail->Product->product_unit}}</td>
                    <td></td>
                </tr>
          
       
   
        
    @endforeach
   
   
</table>
</div>
</body>
