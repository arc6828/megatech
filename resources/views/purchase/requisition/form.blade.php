<div class="card">
  <div class="card-body">
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="purchase_requisition_code"	id="purchase_requisition_code" class="form-control form-control-sm"	>
      </div>
      <label class="col-lg-2 offset-lg-1">เอกสารอ้างอิง</label>
      <div class="col-lg-3">
        <input name="internal_reference_id" id="internal_reference_id" class="form-control form-control-sm form-control-line"	required>
      </div>
      <div class="col-lg-3 d-none">
        <input name="external_reference_id" id="external_reference_id" class="form-control form-control-sm form-control-line">
      </div>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสลูกหนี้</label>
      <div class="col-lg-4">
        <input type="hidden" name="customer_id" id="customer_id" class="form-control form-control-sm"  required>
        <div class="input-group input-group-sm ">
          <div class="input-group-prepend">
            <span class="input-group-text" name="customer_code" id="customer_code" ></span>
          </div>
          <input class="form-control" name="company_name" id="company_name" readonly>
          <div class="input-group-append">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#customerModal">
              <i class="fa fa-plus"></i> เลือกลูกหนี้
            </button>
          </div>
        </div>
        @include('purchase/requisition/customer_modal')
      </div>
      <label class="col-lg-2 ">วันที่เวลา</label>
      <div class="col-lg-3">
        <input name="datetime" id="datetime" class="form-control form-control-sm form-control-line"	readonly>
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2">ระยะเวลาหนี้</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line"	>
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
      <div class="col-lg-3">
        <input type="number" name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  >
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
      <div class="col-lg-3">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line" >
      </div>
      <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm" >
          <option value="" >None</option>
          @foreach($table_delivery_type as $row_delivery_type)
          <option value="{{ $row_delivery_type->delivery_type_id }}" >
            {{	$row_delivery_type->delivery_type_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2">ชนิดภาษี</label>
      <div class="col-lg-3">
        <select name="tax_type_id" id="tax_type_id" class="form-control form-control-sm" onChange="onChange(this)"  >
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
      <input type="number" name="delivery_time"	id="delivery_time" class="form-control form-control-sm form-control-line" >
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
        <select name="purchase_status_id" id="purchase_status_id" class="d-none form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_purchase_status as $row_purchase_status)
          <option value="{{ $row_purchase_status->purchase_status_id }}" >
            {{	$row_purchase_status->purchase_status_name }}
          </option>
          @endforeach
        </select>
        @if(isset($purchase_requisition))
        @switch($purchase_requisition->purchase_status_id)
          @case("-1") 
            <span class="badge badge-pill badge-secondary">Void</span>
            @break
          @case("0")								
            <span class="badge badge-pill badge-primary">อนุมัติทั้งหมด / บางส่วน / รอการอนุมัติ</span>
            @break
          @default
            @if($purchase_requisition->requisition_details->sum("purchase_requisition_detail_status_id") == $purchase_requisition->requisition_details->count("purchase_requisition_detail_status_id")  )
            <span class="badge badge-pill badge-success">อนุมัติทั้งหมด</span>
            @elseif( $purchase_requisition->requisition_details->sum("purchase_requisition_detail_status_id") == $purchase_requisition->requisition_details->count("purchase_requisition_detail_status_id")*3 )
            <span class="badge badge-pill badge-info">รอการอนุมัติ</span>
            @elseif( $purchase_requisition->requisition_details->sum("purchase_requisition_detail_status_id") == $purchase_requisition->requisition_details->count("purchase_requisition_detail_status_id")*2 )
            <span class="badge badge-pill badge-danger">ไม่อนุมัติ</span>
            @else
            <span class="badge badge-pill badge-primary">อนุมัติบางส่วน</span>
            @endif
        @endswitch
        @endif
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสพนักงานขาย</label>
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


@include('purchase/requisition/detail')

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
					<label class="col-lg-3 d-none">ยอดรวมก่อนภาษี</label>
					<div class="col-lg-3  d-none">
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly disabled>
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-6">
						<input name="remark" id="remark" class="form-control form-control-sm form-control-line" >

					</label>
					<label class="col-lg-3  d-none">
						ภาษีมูลค่าเพิ่ม
						<input type="number"
							name="vat_percent" id="vat_percent"
							onkeyup="onChange(this)"
							onChange="onChange(this)"
							class="form-control form-control-sm form-control-line roundnum"
							style="width: 50px; margin: 10px;"> %
					</label>
					<div class="col-lg-3  d-none">
						<input type="number" step="0.01" name="vat" id="vat" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-sm form-control-line  roundnum" readonly disabled >
					</div>
				</div>
				<div class="form-group form-inline  d-none">
	   				<label class="col-lg-6">

					</label>
					<label class="col-lg-3">ยอดสุทธิ</label>
					<div class="col-lg-3">
						<input type="number"  name="total_after_vat" id="total_after_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly disabled>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>

function onChangeCustomer(){

}

function refreshTotal(){
  var total = 0;
  document.querySelectorAll("#table-purchase_requisition-detail .total_edit").forEach(function(element,index){
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

</script>




<!-- START DISABLE WHEN SHOW -->
@if(isset($mode))
    @if( $mode == "edit" )
    <!-- <div class="form-group text-center">
        <input class="btn btn-success" type="submit" value="Save">
    </div> -->
    @elseif( $mode == "show" )
    <script>
      setTimeout(function(){ 
          let elements = document.querySelectorAll("input, button.btn-success, select");
          // console.log("want to approved", elements);
          for(var item of elements){
            item.setAttribute("disabled","");
          };

        }, 500);
        
    </script>
    @endif
@else 
    <!-- <div class="form-group text-center">
        <input class="btn btn-success" type="submit" value="Save">
    </div>  -->
@endif

<!-- END DISABLE WHEN SHOW -->