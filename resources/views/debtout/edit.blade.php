@extends('template/template-1')
@section('content')
<script type="text/javascript" src="{{url('/')}}/js/debtout/debtout_jquery.js"></script>

<h2 style="text-align: center;">ปรับปรุงลูกหนี้คงค้าง</h2>
<div class="container">
@forelse($table_debtout as $row)
<form action="{{ url('/') }}/debtout/{{ $row->id }}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
<br>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab">ข้อมูลลูกหนี้คงค้าง</a></li>
  </ul>
<br><br>	
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
 		<div class="col-xs-6">
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="id_dept">เลขที่เอกสาร: </label>
 			<div class="col-sm-5">
 				<input type="text" name="id_dept" id="id_dept" class="form-control" value="{{ $row->id_dept }}" disabled="">
 			</div>
 		  </div>
 		   <div class="form-group">
 			<label class="control-label col-sm-3" for="id_customer">รหัสลูกค้า: </label>
 			<div class="col-sm-9">
 				<input type="text" name="id_customer" id="id_customer" class="form-control col-sm-5" value="{{ $row->id_customer }}">&nbsp;
 				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เลือกลูกหนี้</button>
 			</div>
 		  </div>
 		   <div class="form-group">
 			<label for="type_tax" class="control-label col-sm-3">ชนิดภาษี: </label>
 			<div class="col-sm-5">
 				<select class="form-control" id="type_tax" style="height: 3em" name="type_tax">
        			<option value disabled="" selected>เลือกชนิดภาษี</option>
        			<option value="include">1. ราคาสินค้ารวมภาษี</option>
        			<option value="separate">2. ราคาสินค้าแยกภาษี</option>
        			<option value="tax0">3. ภาษีอัตรารวม 0</option>
      			</select>
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label for="tax_liability" class="control-label col-sm-3">ภาระภาษี: </label>
 			<div class="col-sm-5">
 				<select class="form-control" id="tax_liability" style="height: 3em" name="tax_liability">
        			<option value disabled="" selected>เลือกภาระภาษี</option>
        			<option value="right">เกณฑ์สิทธิ์</option>
        			<option value="cash">เกณฑ์เงินสด</option>
      			</select>
 			</div>
 		  </div>

 		</div>
 		<div class="col-xs-6">
 			<div class="form-group">
 			<label class="control-label col-sm-3" for="date_dept">วันที่เอกสาร: </label>
 			<div class="col-sm-5">
 				<input type="date" name="date_dept" id="date_dept" class="form-control" value="{{ $row->date_dept }}">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="deadline">วันครบกำหนด: </label>
 			<div class="col-sm-5">
 				<input type="date" name="deadline" id="deadline" class="form-control" value="{{ $row->deadline }}">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="tax_filing">ยื่นภาษีในงวด: </label>
 			<div class="col-sm-5">
 				<textarea id="date" name="tax_filing" class="form-control"></textarea>
 			</div>
 		  </div>
 		</div>
  </div>
  <!-- Modal -->
  <div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
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
          <button type="button" class="btn btn-primary" id="save">Save changes</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<hr>
<br>
<br>
<div class="col-xs-6">
	<div class="form-group">
		<label class="control-label col-sm-6" for="tax_value"></label>
 			<div class="col-sm-5">
 				<input type="float" class="form-control" hidden="">
 			</div>
	</div>
	<div class="form-group">
		<br>
 			<label class="control-label col-sm-6" for="tax">อัตราภาษี: </label>
 			<div class="col-sm-5">
 				<input type="float" name="tax" id="tax" class="form-control" onchange="myFunction(tax)" value="{{ $row->tax }}">
 			</div>
 		  </div>
</div>
<div class="col-xs-6">
		<div class="form-group">
 			<label class="control-label col-sm-3" for="total_dept">ยอดรวม: </label>
 			<div class="col-sm-5">
 				<input type="float" name="total_dept" id="totaldept" class="form-control"onchange="myFunction(total_dept)" value="{{ $row->total_dept }}">
 			</div>
 		  </div>
 		  <div class="form-group">
 			<label class="control-label col-sm-3" for="tax_value">มูลค่าภาษี: </label>
 			<div class="col-sm-5">
 				<input type="float" name="tax_value" id="taxvalue" class="form-control" value="{{ $row->tax_value }}">
 			</div>
 		  </div>
</div>
<button type="submit" class="btn btn-success btn-right">Save</button>
<a href="{{url('/')}}/debtout" class="btn btn-danger " style="text-align: right;">Back</a>
</div>
</form>
</div>
<script type="text/javascript">
var d = new Date();
var month = d.getUTCMonth() + 1;
var year = d.getUTCFullYear();
newdate = month + "/" + year;
document.getElementById("date").innerHTML = newdate;


function myFunction(tax,totaldept) {
    var totaldept= document.getElementById("totaldept").value;
    var tax = document.getElementById("tax").value;
    var taxvalue = document.getElementById("taxvalue");
    taxvalue.value = (totaldept*tax)/100;
}
</script>
@empty
<div>error</div>
@endforelse
@endsection