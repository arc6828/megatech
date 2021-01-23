<body>
<h1 style="text-align:center">บริษัท เมก้า คัตติ้งทูล จำกัด</h1>
<p style="text-align:center">รายละเอียดลูกค้าแยกตามรหัสพนักงานขาย<br>
พิมพ์ ณ วันที่ : 26/09/2019</p>

<div style = "margin-left: 55px;" >
<b>ตั้งแต่รหัสพนักงาน CM ถึง SD

<table  width="1400" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #000;">
 
    <tr style = "height:50px;">
        <td style="border-bottom: solid 1px #000; text-align:center"  width="10%"><b>รหัสลูกค้า</td>
        <td style="border-bottom: solid 1px #000; text-align:center" width="30%"><b>ชื่อบริษัท / ผู้ติดต่อ</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>ที่อยู่/Email</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เบอร์โทรศัพท์</td>
        <td style="border-bottom: solid 1px #000; text-align:center" ><b>เบอร์ FAX</td>
    </tr>
<br><br>
    @foreach($customer as $customer)

    <tr style = "height:60px;">
        <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->customer_code}}</td>
        <td style="border-bottom: solid 0px #000; " >{{$customer->company_name}} <br>
        {{$customer->contact_name}}</td>
        <td style="border-bottom: solid 0px #000; " >{{$customer->address}}
        <br>{{$customer->email}}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->telephone}}</td>
        <td style="border-bottom: solid 0px #000; text-align:center" >{{$customer->fax}}</td>


    </tr>
    @endforeach
</table>
</div>
</body>
