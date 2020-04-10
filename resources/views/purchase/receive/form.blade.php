<div class="card">
  <div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/') }}/purchase/receive" title="Back" class="btn btn-warning btn-sm">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="purchase_receive_code"	id="purchase_receive_code" class="form-control form-control-sm"	disabled>
      </div>
      <label class="col-lg-2 offset-lg-1">รหัสเอกสารเจ้าหนี้</label>
      <div class="col-lg-3">
        <input name="external_reference_doc" id="external_reference_doc" class="form-control form-control-sm form-control-line"	required>
      </div>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">เลขที่ใบขาย</label>
      <div class="col-lg-3">
        <input name="internal_reference_doc" id="internal_reference_doc" class="form-control form-control-sm"  readonly>

      </div>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเจ้าหนี้</label>
      <div class="col-lg-4">
        <input type="hidden" name="supplier_id" id="supplier_id" class="form-control form-control-sm"  required>
        <div class="input-group input-group-sm ">
          <div class="input-group-prepend">
            <span class="input-group-text" name="supplier_code" id="supplier_code" ></span>
          </div>
          <input class="form-control" name="company_name" id="company_name" readonly>
          <div class="input-group-append">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#supplierModal">
              <i class="fa fa-plus"></i> เลือกเจ้าหนี้
            </button>
          </div>
        </div>
      </div>

      @include('purchase/receive/supplier_modal')
      <label class="col-lg-2 ">วันที่เวลา</label>
      <div class="col-lg-3">
        <input name="datetime" id="datetime" class="form-control form-control-sm form-control-line"	readonly>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ระยะเวลาหนี้</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line"	required>
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
      <div class="col-lg-3">
        <input type="number" name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  required>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
      <div class="col-lg-3">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line" required>
      </div>
      <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_delivery_type as $row_delivery_type)
          <option value="{{ $row_delivery_type->delivery_type_id }}" >
            {{	$row_delivery_type->delivery_type_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ชนิดภาษี</label>
      <div class="col-lg-3">
        <select name="tax_type_id" id="tax_type_id" class="form-control form-control-sm" onChange="onChange(this)"  required>
          <option value="" >None</option>
          @foreach($table_tax_type as $row_tax_type)
          <option value="{{ $row_tax_type->tax_type_id }}" >
            {{	$row_tax_type->tax_type_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">ระยะเวลาส่งของ (วัน)</label>
      <div class="col-lg-3">
      <input type="number" name="delivery_time"	id="delivery_time" class="form-control form-control-sm form-control-line" required>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสแผนก</label>
      <div class="col-lg-3">
        <select name="department_id" id="department_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_role }}" >
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">สถานะ</label>
      <div class="col-lg-3">
        <select name="purchase_status_id" id="purchase_status_id" class="form-control form-control-sm" required>
          @foreach($table_purchase_status as $row_purchase_status)
          <option value="{{ $row_purchase_status->purchase_status_id }}" >
            {{	$row_purchase_status->purchase_status_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสพนักงานจัดซื้อ</label>
      <div class="col-lg-3">
        <select name="user_id" id="user_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_purchase_user as $row_purchase_user)
          <option value="{{ $row_purchase_user->id }}" >
            {{	$row_purchase_user->name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1 d-none">เขตการขาย</label>
      <div class="col-lg-3 d-none">
        <select name="zone_id" id="zone_id" class="form-control form-control-sm" >
          <option value="" >None</option>
          @foreach($table_zone as $row_zone)
          <option value="{{ $row_zone->zone_id }}" >
            {{	$row_zone->zone_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>


@include('purchase/receive/detail')

<div class="card mt-4">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
					<div class="col-lg-12">
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group form-inline">
					<input type="hidden" name="total" id="total"	class="form-control form-control-sm form-control-line"  >
					<label class="col-lg-6">หมายเหตุ</label>
					<label class="col-lg-3">ยอดรวมก่อนภาษี</label>
					<div class="col-lg-3">
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly >
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-6">
						<input name="remark" id="remark" class="form-control form-control-sm form-control-line" >

					</label>
					<label class="col-lg-3">
						ภาษีมูลค่าเพิ่ม
						<input type="number"
							name="vat_percent" id="vat_percent"
							onkeyup="onChange(this)"
							onChange="onChange(this)"
							class="form-control form-control-sm form-control-line roundnum"
							style="width: 50px; margin: 10px;"> %
					</label>
					<div class="col-lg-3">
						<input type="number" step="0.01" name="vat" id="vat" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-sm form-control-line  roundnum" readonly  >
					</div>
				</div>
				<div class="form-group form-inline">
	   				<label class="col-lg-6">

					</label>
					<label class="col-lg-3">ยอดสุทธิ</label>
					<div class="col-lg-3">
						<input type="number"  name="total_after_vat" id="total_after_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly >
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>


function refreshTotal(){
  var total = 0;
  document.querySelectorAll("#table-purchase_receive-detail .total_edit").forEach(function(element,index){
    total += parseFloat(element.value);
  }); //END foreach\
  //console.log("Total : " + total);
  document.getElementById("total").value = total;
}

function onChange(obj){
  //RECALCULATE TOTAL FIRST
  refreshTotal();
  //MAIN
	var vat = document.getElementById("vat");
	var vat_percent = document.getElementById("vat_percent");
	var total = document.getElementById("total");
	var total_before_vat = document.getElementById("total_before_vat");
	var total_after_vat = document.getElementById("total_after_vat");
	var tax_type_id = document.getElementById("tax_type_id");
	//console.log("print",vat,vat_percent,total_before_vat);

	//INPUT DETECTOR
	switch (obj.id) {
		case "vat_percent":
			//EFFECT TO #vat
			vat.value = total.value * (vat_percent.value) / 100;
			break;
		case "vat":
			//EFFECT TO #vat_percent
			vat_percent.value = vat.value / total.value * 100;
			break;
	}

	//DISPLAY ON TOTAL
	vat_percent.disabled = false;
	vat_percent.readonly = false;
	switch (tax_type_id.value) {
		case "1":
			//EFFECT TO #vat
			//console.log("CASE 1");
			total_before_vat.value = total.value -  vat.value*1;
			total_after_vat.value = total.value ;
			break;
		case "2":
			//EFFECT TO #vat_percent
			//console.log("CASE 2");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value*1 + vat.value*1;
			break;
		default:
			vat_percent.disabled = true;
			vat_percent.readonly = true;
			vat_percent.value = 0;
			vat.value = 0;
			//console.log("CASE OTHERS");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value;
			break;
	}
  //roundnum
  document.querySelectorAll(".roundnum").forEach(function(element) {
    //console.log(element);
    //element.value = parseFloat(element.value).toFixed(2)
  });


}

function onKeyPressEnter(e){
  var code = (e.keyCode ? e.keyCode : e.which);
  if(code == 13) { //Enter keycode
    alert('enter press');
    onChangePO();
  }
}

function onChangePO(){
  console.log("");
  var purchase_order_code = $("#purchase_order_code").val();
  console.log(purchase_order_code);
  fillPurchase_receivePO(purchase_order_code);
}

function fillPurchase_receivePO(purchase_order_code){
  console.log(supplier_id,"{{ url('/') }}/api/purchase/order_detail/order_code/"+purchase_order_code+"?purchase_order_detail_status_id=5");

  $.ajax({
      url: "{{ url('/') }}/api/purchase/order_detail/order_code/"+purchase_order_code+"?purchase_order_detail_status_id=5",
      type: "GET",
      dataType : "json",
  }).done(function(result){
    fillReceive(result);
    fillReceiveDetail(result);
    //ALL ABOUT EVENT
    refreshDetailTableEvent();
    //AVOID TO EDIT
    //$('#table-purchase_receive-detail input').prop('readonly', true);


    $("#isbn").focus();

  }); //END AJAX

  //document.querySelector("#btn-close-receive").click();

}


function onChangeCustomer(){
  console.log("");
  var supplier_id = $("#supplier_id").val();
  console.log(supplier_id);
  fillPurchase_receive(supplier_id);
}

function fillPurchase_receive(supplier_id){
  console.log(supplier_id,"{{ url('/') }}/api/purchase/order_detail/supplier/"+supplier_id+"?purchase_order_detail_status_id=5");

  $.ajax({
      url: "{{ url('/') }}/api/purchase/order_detail/supplier/"+supplier_id+"?purchase_order_detail_status_id=5",
      type: "GET",
      dataType : "json",
  }).done(function(result){
    fillReceive(result);
    fillReceiveDetail(result);
    //ALL ABOUT EVENT
    refreshDetailTableEvent();
    //AVOID TO EDIT
    //$('#table-purchase_receive-detail input').prop('readonly', true);

  }); //END AJAX

  document.querySelector("#btn-close-receive").click();

}
function fillReceive(result){
  var element = result[0];
  if(element){
    //document.querySelector("#invoice_code").value = element.invoice_code ;
    document.querySelector("#internal_reference_doc").value = "{{ request('purchase_order_code') }}" ;
    //document.querySelector("#external_reference_doc").value = element.external_reference_doc;
    document.querySelector("#supplier_id").value = element.supplier_id;
    document.querySelector("#supplier_code").innerHTML  = element.supplier_code;
    document.querySelector("#company_name").value = element.company_name;
    //var str_time = moment(element.datetime).format('YYYY-MM-DDTHH:mm');  //console.log(str_time);
    //var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = element.debt_duration;
    document.querySelector("#billing_duration").value = element.billing_duration ;
    document.querySelector("#payment_condition").value = element.payment_condition ;
    document.querySelector("#delivery_type_id").value = element.delivery_type_id ;
    document.querySelector("#tax_type_id").value = element.tax_type_id ;
    document.querySelector("#delivery_time").value = element.delivery_time;
    document.querySelector("#department_id").value = element.department_id ;
    //document.querySelector("#purchase_status_id").value = element.sales_status_id ;
    document.querySelector("#user_id").value = element.user_id ;
    document.querySelector("#zone_id").value = element.zone_id ;
    document.querySelector("#total").value = element.total ;
    document.querySelector("#remark").value = element.remark ;
    document.querySelector("#vat_percent").value = element.vat_percent;

    onChange(document.querySelector("#vat_percent"));
  }



}
function fillReceiveDetail(result){
  //console.log(result);
  var dataSet = [];
  result.forEach(function(element,index) {
    var id = element.purchase_order_detail_id;
    console.log("ELEMENT id : ",id,element);
    //1 : means approved
    if(element.purchase_order_detail_status_id == 5){
      var row = createRow(id, element);
      dataSet.push(row);
    }
  });
  //console.log(dataSet);
  var table = $('#table-purchase_receive-detail').DataTable();
  table
      .clear()
      .rows.add(dataSet)
      .draw();
}

function showProduct(){}

</script>
