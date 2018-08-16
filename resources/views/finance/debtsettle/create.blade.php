@extends('template/template-1')
@section('content')
<script src="{{url('/')}}/js/settle/settle_jquery.js"></script>
<div class="container" style="text-align: center;">
	<h1>เพิ่มหนี้ลูกหนี้</h1>
	<br>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">การตั้งหนี้</a></li>
    <li><a data-toggle="tab" href="#menu1">รายละเอียดการลงบัญชี</a></li>
  </ul>
<form action="{{ url('/') }}/settle" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		{{ method_field('POST') }}
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
		<br>
		<div class="col-xs-6">
		<div class="form-group">
 			<label class="control-label col-sm-3" for="id_settle">เลขที่เอกสาร: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_settle" id="id_settle" class="form-control">
 			</div>
 		  </div>
 		<div class="form-group">
 			<label class="control-label col-sm-3" for="id_customer">รหัสลูกค้า: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_customer" id="id_customer" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1">รหัสลูกค้า</button>
 			</div>
 		</div>
 		   <div class="form-group">
 			<label for="type_tax" class="control-label col-sm-3">ชนิดภาษี: </label>
 			<div class="col-sm-5">
 				<select class="form-control" id="type_tax" style="height: 2.5em" name="type_tax">
        			<option value disabled="" selected>เลือกชนิดภาษี</option>
        			<option value="include">1. ราคาสินค้ารวมภาษี</option>
        			<option value="separate">2. ราคาสินค้าแยกภาษี</option>
        			<option value="tax0">3. ภาษีอัตรารวม 0</option>
      			</select>
 			</div>
 		  </div>
 		<div class="form-group">
 			<label class="control-label col-sm-3" for="id_user">รหัสพนักงาน: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_user" id="id_user" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">รหัสพนักงาน</button>
 			</div>
 		</div>
 		<div class="form-group">
 			<label class="control-label col-sm-3" for="id_department">รหัสแผนก: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_department" id="id_department" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3">รหัสแผนก</button>
 			</div>
 		</div>
 		 <div class="form-group">
 			<label for="sales_area" class="control-label col-sm-3">เขตการขาย: </label>
 			<div class="col-sm-5">
 				<select class="form-control" id="sale_area" style="height: 2.5em" name="sale_area">
        			<option value disabled="" selected>เลือกเขตการขาย</option>
        			<option value="right">เขตกรุงเทพฯ</option>
        			<option value="cash">ภาคใต้</option>
        			<option value="right">ภาคเหนือ</option>
        			<option value="cash">ภาคตะวันออกเฉียงเหนือ</option>
        			<option value="right">ภาคเหนือ</option>
        			
      			</select>
 			</div>
 		  </div>
 		 <div class="form-group">
 			<label for="tax_liability" class="control-label col-sm-3">ภาระภาษี: </label>
 			<div class="col-sm-5">
 				<select class="form-control" id="tax_liability" style="height: 2.5em" name="tax_liability">
        			<option value disabled="" selected>เลือกภาระภาษี</option>
        			<option value="right">เกณฑ์สิทธิ์</option>
        			<option value="cash">เกณฑ์เงินสด</option>
      			</select>
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="id_account">รหัสผังบัญชี: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_account" id="id_account" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal4">รหัสผังบัญชี</button>
 			</div>
 		</div>
 		<div class="form-group">
 			<label class="control-label col-sm-3" for="id_deposit">เลขที่มัดจำ: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_deposit" id="id_deposit" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal5">เลขที่มัดจำ</button>
 				<input type="number" name="total_deposit" id="total_deposit" class="form-control" placeholder="ยอดหลังหักค่ามัดจำ" onchange="calculate(total_deposit)">
 			</div>
 		</div>
		</div>
		<div class="col-xs-6">
		<div class="form-group">
 			<label class="control-label col-sm-3" for="date_settle">วันที่เอกสาร: </label>
 			<div class="col-sm-5">
 				<input type="date" name="date_settle" id="date_settle" class="form-control" onchange="date(date_settle)">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="debt_period">ระยะเวลาหนี้: </label>
 			<div class="col-sm-5">
 				<input type="text" name="debt_period" id="debt_period" class="form-control" onchange="date(debt_period)">
 			</div>
 		  </div>
 		 <div class="form-group">
 			<label class="control-label col-sm-3" for="deadline_settle">วันครบกำหนด: </label>
 			<div class="col-sm-5">
 				<input type="date" name="deadline_settle" id="deadline_settle" class="form-control">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="id_job">รหัสJob: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_job" id="id_job" class="form-control col-sm-5">
 				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal6">รหัสJob</button>
 			</div>
 		</div>
 		<div class="form-group">
 			<label class="control-label col-sm-3" for="ref_number">เลขที่อ้างอิง: </label>
 			<div class="col-sm-5">
 				<input type="text" name="ref_number" id="ref_number" class="form-control">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="tax_filing">ยื่นภาษีในงวด: </label>
 			<div class="col-sm-5">
 				<textarea type="text" id="tax_filing" name="tax_filing" id="tax_filing" class="form-control"></textarea>
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="total_settle">ยอดรวม: </label>
 			<div class="col-sm-5">
 				<input type="number" name="total_settle" id="total_settle" class="form-control" onchange="calculate(total_settle)">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="discount">ส่วนลด: </label>
 			<div class="col-sm-5">
 				<input type="text" name="discount" id="discount" class="form-control" onchange="calculate(discount)">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="tax">อัตรภาษี: </label>
 			<div class="col-sm-5">
 				<input type="number" name="tax" id="tax" class="form-control" value="7" onchange="calculate(tax)">
 			</div>
 		  </div>
 		   <div class="form-group">
 			<label class="control-label col-sm-3" for="tax_value">มูลค่าภาษี: </label>
 			<div class="col-sm-5">
 				<textarea id="tax_value" type="float" name="tax_value" id="tax_value" class="form-control"></textarea> 
 			</div>
 		  </div>
 		   <div class="form-group">
 			<label class="control-label col-sm-3" for="cash_receipt">ยอดรับเงินสด: </label>
 			<div class="col-sm-5">
 				<input type="number" name="cash_receipt" id="cash_receipt" class="form-control" onchange="calculate(cash_receipt)">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="total">หนี้ทั้งหมด: </label>
 			<div class="col-sm-5">
 				<textarea id="total" type="float" name="total" id="total" class="form-control"></textarea>
 			</div>
 		  </div>

		</div>

    </div>
    <div id="menu1" class="tab-pane fade">
  	
    </div>
  </div>
<button type="submit" class="btn btn-success btn-right">Save</button>
		<a href="{{url('/')}}/settle" class="btn btn-danger " style="text-align: right;">Back</a>
</form>
  <!-- Modal1 -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal1 content-->
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">ลูกค้า</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
          
          <thead>
            <th></th>
            <th>รหัสลูกค้า</th>
            <th>ชื่อบริษัท</th>
            <th>ที่อยู่</th>
            <th>เบอร์โทรศัพท์</th>
          </thead>
          @foreach($table_customer as $row_customer)
          <tr>
            <td><input type="radio" name="id_customer" value="{{ $row_customer->id_customer }}"></td>
            <td>{{ $row_customer->id_customer}}</td>
            <td>{{ $row_customer->name_company}}</td>
            <td>{{ $row_customer->address}}</td>
            <td>{{ $row_customer->telephone}}</td>
          </tr>
        @endforeach
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savecustomer">Save</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal2 -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal2 content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveuser">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal3 content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <table class="table">
           <th></th>
          <th>รหัสแผนก</th>
          <th>ชื่อแผนก</th>
           @foreach($table_department as $row_department)
          <tr>
            <td><input type="radio" name="id_department" value="{{ $row_department->id_department }}"></td>
            <td>{{ $row_department->id_department }}</td>
            <td>{{ $row_department->name_department }}</td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savedepartment">Save</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal4 -->
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal4 content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       
        <table class="table">
          <th></th>
          <th>รหัสผังบัญชี</th>
          <th>รายละเอียด</th>
          @foreach($table_account as $row_account)
          <tr>
            <td><input type="radio" name="id_account" value="{{ $row_account->id_account }}"></td>
            <td>{{ $row_account->id_account }}</td>
            <td>{{ $row_account->note_account }}</td>
          </tr>
           @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveaccount">Save</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal5 -->
<div id="myModal5" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal5 content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
          <th></th>
          <th>เลขที่เอกสาร</th>
          <th>วันที่</th>
          <th>ยอดคงเหลือ</th>
          @foreach($table_deposit as $row_deposit)
          <tr>
            <td><input type="radio" name="id_deposit" value="{{ $row_deposit->id_deposit }}"></td>
            <td>{{ $row_account->id_deposit }}</td>
            <td>{{ $row_account->date_deposit }}</td>
            <td>{{ $row_account->total_deposit }}</td>
          </tr>
           @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savedeposit">Save</button>
      </div>
    </div>

  </div>
</div>
 <!-- Modal6 -->
<div id="myModal6" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal6 content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <table class="table">
          <th></th>
          <th>รหัสJob</th>
          <th>รายละเอียด</th>
          @foreach($table_job as $row_job)
          <tr>
            <td><input type="radio" name="id_job" value="{{ $row_job->id_job }}"></td>
            <td>{{ $row_job->id_job }}</td>
            <td>{{ $row_job->note_job }}</td>
          </tr>
           @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savejob">Save</button>
      </div>
    </div>

  </div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="{{url('/')}}/js/settle/settle.js"></script>
@endsection