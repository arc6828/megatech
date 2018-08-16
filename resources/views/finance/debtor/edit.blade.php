@extends('template/template-1')
@section('content')
<script type="text/javascript" src="{{url('/')}}/js/debtor/debtor.js"></script> 
</head>
<h1>เพิ่มลูกค้า</h1>
@forelse($table_customer as $row)
	<form action="{{ url('/') }}/finance/debtor/{{ $row->id }}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="row">
	<div class="col-sm-3 col-form-control">
		<label class="col-sm-3 col-form-lable">รหัสลูกค้า:</label>
		<input type="text" name="id_customer" disabled placeholder="รหัสลูกค้า" class="form-control" style="width: 60%" value="{{ $row->id_customer }}">
	</div>
		<label class="col-sm-0 col-form-lable">ประเภทลูกหนี้:</label>
		<div class="col-sm-4">
			<select name="type_customer" class="form-control" style="width: 40%; height: 4%">
				<option selected disabled>เลือกประเภทลูกหนี้</option>
  				<option value="consumer">consumer</option>
  				<option value="industries">industries</option>
  				<option value="north">ภาคเหนือ</option>
  				<option value="south">ภาคใต้</option>
  				<option value="north_east">ภาคตะวันออกเฉียงเหนือ</option>
			</select>
		</div>
	</div>
	<br>
	<div class="row" style="border: 0px">
		<div class="col-sm-8">
		<strong class="col-sm-1">ชื่อบริษัท : </strong>
		<input type="text" name="name_company" placeholder="ชื่อบริษัท" class="form-control" style="width: 50%" value="{{ $row->name_company }}">
	</div>
	</div>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">รายละเอียด</a></li>
    <li><a data-toggle="tab" href="#menu1">ยอดหนี้</a></li>
    <li><a data-toggle="tab" href="#menu2">การ์ดลูกหนี้</a></li>
    <li><a data-toggle="tab" href="#menu3">ยอดคงค้าง</a></li>
    <li><a data-toggle="tab" href="#menu4">ผู้ติดต่อ</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="row">

      	<label class="col-sm-1 form-label">รหัสผังบัญชี :</label><input class="form-control" type="number" name="id_account" style="width: 10%" id="account" value="{{$row->id_account}}">&nbsp;<button type="button" class="glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#exampleModal">
</button></div>
		<div class="row">
		<label class="col-sm-1 col-form-lable">ชื่อผู่ติดต่อ : </label>
		<input type="text" name="name_customer" placeholder="ชื่อผู่ติดต่อ" class="form-control" style="width: 50%" value="{{$row->name_customer}}">
		</div>
		<div class="row">
		<label class="col-sm-1 col-form-lable">ที่อยู่ : </label>
		<input type="text" name="address" placeholder="ที่อยู่" class="form-control" style="width: 50%" value="{{$row->address}}">
		</div>
		<div class="row">
		<label class="col-sm-1 col-form-lable">สถานที่ส่งของ : </label>
		<input type="text" name="place_delivery" placeholder="สถานที่ส่งของ" class="form-control" style="width: 50%" value="{{$row->place_delivery}}">
		</div>
		<div class="row">
      	<label class="col-sm-1 form-label">รหัสพนักงาน :</label><input class="form-control" type="text" name="id_user" style="width: 10%" id="id_user" value="{{$row->id_user}}">&nbsp;<button type="button" class="glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#user">
</button></div>
		<div class="row">
		<label class="col-sm-1 col-form-lable">เบอร์โทรศัพท์ : </label>
		<input type="text" name="telephone" placeholder="เบอร์โทรศัพท์" class="form-control" style="width: 30%" value="{{$row->telephone}}">
		<label class="col-sm-1 col-form-lable">เบอร์FAX : </label>
		<input type="text" name="fax_number" placeholder="เบอร์FAX" class="form-control" style="width: 30%" value="{{$row->fax_number}}">
		</div>
		<div class="row">
		<label class="col-sm-1 col-form-lable">เขตการขาย:</label>
			<select name="sales_area" class="form-control" style="width: 20%; height: 4%">
				<option selected disabled value>เขตการขาย</option>
  				<option value="bankok">เขตกรุงเทพฯ</option>
  				<option value="industries">ภาคกลาง</option>
  				<option value="south">ภาคใต้</option>
  				<option value="north_east">ภาคตะวันออกเฉียงเหนือ</option>
  				<option value="north">ภาคเหนือ</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label class="col-sm-1 col-form-lable">ขนส่งโดย:</label>
			<select name="transpot" class="form-control" style="width: 20%; height: 4%">
				<option selected disabled value>การขนส่ง</option>
				  <option value="postoffice">ไปรษณีย์</option>
  				<option value="carcompany">รถบริษัท</option>
  			</div>

  			</select>

  			
  		</div>
      <div class="row">
    <label class="col-sm-1 col-form-lable">หมายเหตุ : </label>
    <input type="text" name="note" class="form-control" style="width: 30%" value="{{$row->note}}">
    <label class="col-sm-1 col-form-lable">สถานที่ประกอบการ:</label>
      <select name="location" class="form-control" style="width: 10%; height: 4%">
        <option selected disabled value>สถานที่ประกอบการ</option>
        <option value="headquarters">สำนักงานใหญ่</option>
          <option value="branch">สาขา</option>
        </select>
        <label class="col-sm-1 col-form-lable">สำนักงาน/สาขา : </label>
        <input type="text" name="branch" class="form-control" style="width: 10%" value="{{$row->branch}}">
    </div>
    <div class="row">
    <label class="col-sm-1 col-form-lable">วงเงินเครดิต : </label>
    <input type="number" name="credit" placeholder="วงเงินเครดิต" class="form-control" style="width: 10%" value="{{$row->credit}}"> 
    </div>
    <div class="row">
    <label class="col-sm-1 col-form-lable">ระยะเวลาหนี้ : </label>
    <input type="number" name="debt_period" placeholder="ระยะเวลาหนี้" class="form-control" style="width: 10%" value="{{$row->debt_period}}">
    <label class="col-sm-1 col-form-lable">วัน</label>
    </div>
    <div class="row">
    <label class="col-sm-1 col-form-lable">ระดับของราคาสินค้า : </label>
    <input type="number" name="degree_product"  class="form-control" style="width: 10%" value="{{$row->degree_product}}">
    <label class="col-sm-1 col-form-lable">ส่วนลดประจำ : </label>
    <input type="number" name="deposit_discount"  class="form-control" style="width: 10%" value="{{$row->deposit_discount}}">
    <label class="col-sm-1 col-form-lable">เลขที่ภาษี : </label>
    <input type="number" name="tax_number"  class="form-control" style="width: 10%" value="{{$row->tax_number}}">
    </div>

    <div class="row">
    <label class="col-sm-1 col-form-lable">เงื่อนไขวางบิล:</label>
      <select name="bill_condition" class="form-control" style="width: 20%; height: 4%">
        <option selected disabled value=>เงื่อนไขวางบิล</option>
          <option value="fist_mon">ทุกวัน วันจันทร์แรกของทุกเดือน</option>
          <option value="fist_tues">ทุกวัน วันอังคารแรกของทุกเดือน</option>
          <option value="fist_wed">ทุกวัน วันพุธแรกของทุกเดือน</option>
          <option value="fist_thurs">ทุกวัน วันพฤหัสบดีแรกของทุกเดือน</option>
          <option value="fist_fri">ทุกวัน วันศุกร์แรกของทุกเดือน</option>
          <option value="last_mon">ทุกวัน วันจันทร์สุดท้ายของทุกเดือน</option>
          <option value="last_tues">ทุกวัน วันอังคารสุดท้ายของทุกเดือน</option>
          <option value="last_wed">ทุกวัน วันพุธสุดท้ายของทุกเดือน</option>
          <option value="last_mon">ทุกวัน วันพฤหัสบดีสุดท้ายของทุกเดือน</option>
          <option value="last_mon">ทุกวัน วันศุกร์สุดท้ายของทุกเดือน</option>
      </select>
      <label class="col-sm-1 col-form-lable">เงื่อนไขรับเช็ค:</label>
      <select name="check_condition" class="form-control" style="width: 20%; height: 4%">
        <option selected disabled value=>เงื่อนไขรับเช็ค</option>
          <option value="fist_mon">ทุกวัน วันจันทร์แรกของทุกเดือน</option>
          <option value="fist_tues">ทุกวัน วันอังคารแรกของทุกเดือน</option>
          <option value="fist_wed">ทุกวัน วันพุธแรกของทุกเดือน</option>
          <option value="fist_thurs">ทุกวัน วันพฤหัสบดีแรกของทุกเดือน</option>
          <option value="fist_fri">ทุกวัน วันศุกร์แรกของทุกเดือน</option>
          <option value="last_mon">ทุกวัน วันจันทร์สุดท้ายของทุกเดือน</option>
          <option value="last_tues">ทุกวัน วันอังคารสุดท้ายของทุกเดือน</option>
          <option value="last_wed">ทุกวัน วันพุธสุดท้ายของทุกเดือน</option>
          <option value="last_thurs">ทุกวัน วันพฤหัสบดีสุดท้ายของทุกเดือน</option>
          <option value="last_fri">ทุกวัน วันศุกร์สุดท้ายของทุกเดือน</option>
      </select>
    </div>
    <br>
    <button type="submit" class="btn btn-outline-primary">Save</button>
    <a class="btn btn-outline-danger" href="{{url('/')}}/debtor">Back</a>
	</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ผังบัญชี</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <table class="table">
          <th></th>
        	<th>รหัสผังบัญชี</th>
        	<th>รายละเอียด</th>
             @foreach($table_account as $row_account)
          <tr>
            <td><input type="radio" name="account" value="{{ $row_account->id_account }}"></td>
            <td>{{ $row_account->id_account }}</td>
            <td>{{ $row_account->note_account }}</td>
          </tr>
           @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">พนักงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <table class="table">
           <th></th>
        	<th>รหัสพนักงาน</th>
        	<th>ชื่อพนักงาน</th>
           @foreach($table_user as $row_user)
          <tr>
            <td><input type="radio" name="id_user" value="{{ $row_user->id_user }}"></td>
            <td>{{ $row_user->id_user }}</td>
            <td>{{ $row_user->name }}</td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_user">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    
  </div>
</form>
@empty	
	<div>This Customer id does not exist</div>
@endforelse
@endsection
