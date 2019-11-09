<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายงานแสดงรายละเอียดใบเสนอซื้อ<br>
พิมพ์ ณ วันที่ : 03/09/2019</p>
ตั้งแต่เลขที่เอกสาร PR5712-00002 ถึง PR6209-00020 , ตั้งแต่วันที่ 01/09/2019 - 30/09/2019 , เงื่อนไข : 01- แสดงรายการทั้งหมด
<br><br>
<table  width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000; text-align:center;">
<tr>
    <td style="border-bottom: solid 1px #000; text-align:center;"><b>รหัสสินค้า</td>
    <td style="border-bottom: solid 1px #000; text-align:center;" ><b>รายละเอียดสินค้า</td>
    <td style="border-bottom: solid 1px #000;"><b>จำนวน
        <table align="center">
                <tr><td><b>เสนอซื้อ</td>
                <td>&nbsp;&nbsp;<b>อนุมัติ </td>
                <td>&nbsp;&nbsp;<b>ไม่อนุมัติ </td>
        </tr></table>
    <td style="border-bottom: solid 1px #000;"><b>ราคา/หน่วย</td>
    <td style="border-bottom: solid 1px #000; " width="10"><b>ส่วนลด/รายการ</td>
    <td style="border-bottom: solid 1px #000;"><b>ยอดเงินสินค้า/รายการ</td>
    <td style="border-bottom: solid 1px #000; "><b>สถานะ</td>
    <td style="border-bottom: solid 1px #000;" ><b>วันที่อนุมัติ</td>
    </tr>
    @foreach ($Requisition as $Requisition)
    <tr height="50">
        <td><b>เลขที่เอกสาร : {{$Requisition->purchase_requisition_code}}</td>
        <td width="300"><b>   @php    
            $timestamp = $Requisition->datetime;
            $splitTimeStamp = explode(" ",$timestamp);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];
          @endphp
          {{$date}}</td>
    </tr>  
    <tr height="10">
        <td>รหัสแผน : 01 แผนกฝ่ายขาย</td>
        <td>รหัสเหตุผล : 01 สั่งซื้อเพื่อขายต่อ</td>
    </tr>
    @foreach ($Requisition->RequisitionDetail as $RequisitionDetail)
    <tr>
        <td>1. {{$RequisitionDetail->Product->product_code}} S10L-STLPR09-12A</td>
        <td>HOLDER</td>
        <td style="border-bottom: solid 1px #000;">
            <table align="center">
                    <tr><td><b>2.00</td>
                    <td>&nbsp;&nbsp;<b>-------</td>
                    <td>&nbsp;&nbsp;<b>------- </td>
            </tr></td></table>
        <td>1,486.00</td>
        <td></td>
        <td>2,972.00 03</td>
        <td>- รออนุมัติ</td>
    </tr>
    @endforeach
 
    <tr>
        <td></td>
        <td><b>ยอดรวม-เลขที่เอกสาร PR6209-00013</td>
        <td style="border-bottom: solid 1px #000;">
        <table align="center">
            <td><b>2.00</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>0.00</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>0.00</td>
        </tr></td></table>
        <td></td>
        <td></td>
        <td><b>2,972.00</td>
    </tr>
    @endforeach      

</table>
</div>
</body>
    
        