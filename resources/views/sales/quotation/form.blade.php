<div class="card">
  <div class="card-block">
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="quotation_code"	class="form-control form-control-sm"	value="{{ $row->quotation_code }}"  disabled>
      </div>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสลูกหนี้</label>
      <div class="col-lg-3">
        <input type="hidden" name="customer_id" id="customer_id" class="form-control form-control-sm" value="{{	$row->customer_id }}"  required>
        <input type="text" name="contact_name" id="contact_name" class="form-control form-control-sm" value="{{	$row->contact_name }}"	readonly style="max-width:100px;">

        @include('customer/index_modal')
      </div>
      <label class="col-lg-2 offset-lg-1">วันที่เวลา</label>
      <div class="col-lg-3">
        <input type="datetime-local" name="datetime" class="form-control form-control-sm form-control-line"	value="" readonly>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ระยะเวลาหนี้</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	class="form-control form-control-sm form-control-line"	value="{{ $row->debt_duration }}" required>
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
      <div class="col-lg-3">
        <input type="number" name="billing_duration"	class="form-control form-control-sm form-control-line" value="{{ $row->billing_duration }}" required>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
      <div class="col-lg-3">
        <input name="payment_condition"	class="form-control form-control-sm form-control-line" value="{{ $row->payment_condition }}" required>
      </div>
      <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_delivery_type as $row_delivery_type)
          <option value="{{ $row_delivery_type->delivery_type_id }}" {{ $row_delivery_type->delivery_type_id === $row->delivery_type_id ? "selected":"" }}>
            {{	$row_delivery_type->delivery_type_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ชนิดภาษี</label>
      <div class="col-lg-3">
        <select name="tax_type_id" id="tax_type_id" class="form-control form-control-sm" onkeyup="onChange(this)" onChange="onChange(this)"  required>
          <option value="" >None</option>
          @foreach($table_tax_type as $row_tax_type)
          <option value="{{ $row_tax_type->tax_type_id }}" {{ $row_tax_type->tax_type_id === $row->tax_type_id ? "selected":"" }}>
            {{	$row_tax_type->tax_type_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">ระยะเวลาส่งของ (วัน)</label>
      <div class="col-lg-3">
      <input type="number" name="delivery_time"	class="form-control form-control-sm form-control-line" value="{{ $row->delivery_time }}" required>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสแผนก</label>
      <div class="col-lg-3">
        <select name="department_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_id }}" {{ $row_department->department_id === $row->department_id ? "selected":"" }}>
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">สถานะ</label>
      <div class="col-lg-3">
        <select name="sales_status_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_sales_status as $row_sales_status)
          <option value="{{ $row_sales_status->sales_status_id }}" {{ $row_sales_status->sales_status_id === $row->sales_status_id ? "selected":"" }}>
            {{	$row_sales_status->sales_status_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสพนักงานขาย</label>
      <div class="col-lg-3">
        <select name="user_id" id="user_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_sales_user as $row_sales_user)
          <option value="{{ $row_sales_user->id }}" {{ $row_sales_user->id === $row->user_id ? "selected":"" }}>
            {{	$row_sales_user->name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">เขตการขาย</label>
      <div class="col-lg-3">
        <select name="zone_id" class="form-control form-control-sm" required>
          <option value="" >None</option>
          @foreach($table_zone as $row_zone)
          <option value="{{ $row_zone->zone_id }}" {{ $row_zone->zone_id === $row->zone_id ? "selected":"" }}>
            {{	$row_zone->zone_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>
    <div>
      <input type="hidden" name="remark" id="remark"
        value="{{ $row->remark }}" >
      <input type="hidden" name="vat_percent"  id="vat_percent"
        value="{{ $row->vat_percent }}" />
    </div>
  </div>
</div>


@include('sales/quotation_detail/index')

<div class="card">
	<div class="card-block">
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
					<div class="col-lg-12">
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group form-inline">
					<input type="hidden" name="total" id="total"	class="form-control form-control-sm form-control-line" value="{{ $row->total }}" readonly disabled>
					<label class="col-lg-6">หมายเหตุ</label>
					<label class="col-lg-3">ยอดรวมก่อนภาษี</label>
					<div class="col-lg-3">
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-sm form-control-line" value="" readonly disabled>
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-6">
						<input value="{{ $row->remark }}"
							name="new_remark" id="new_remark"
							class="form-control form-control-sm form-control-line"
							onchange="onRemarkChange()">

					</label>
					<label class="col-lg-3">
						ภาษีมูลค่าเพิ่ม
						<input type="number" value="{{ $row->vat_percent }}"
							name="new_vat_percent"  id="new_vat_percent"
							onkeyup="onChange(this)"
							onChange="onChange(this)"
							class="form-control form-control-sm form-control-line"
							style="width: 50px; margin: 10px;"> %
					</label>
					<div class="col-lg-3">
						<input type="number" name="vat" id="vat" value="{{ $row->vat }}" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-sm form-control-line" readonly disabled >
					</div>
				</div>
				<div class="form-group form-inline">
	   				<label class="col-lg-6">

					</label>
					<label class="col-lg-3">ยอดสุทธิ</label>
					<div class="col-lg-3">
						<input type="number" name="total_after_vat" id="total_after_vat"		value="" class="form-control form-control-sm form-control-line"  readonly >
					</div>
				</div>
			</div>
		</div>



	</div>
</div>


<script>
function onRemarkChange(){
		var new_remark = document.getElementById("new_remark");
		var remark = document.getElementById("remark");
		remark.value = new_remark.value;
}
function onChange(obj){
	var vat = document.getElementById("vat");
	var vat_percent = document.getElementById("vat_percent");
	var new_vat_percent = document.getElementById("new_vat_percent");
	var total = document.getElementById("total");
	var total_before_vat = document.getElementById("total_before_vat");
	var total_after_vat = document.getElementById("total_after_vat");
	var tax_type_id = document.getElementById("tax_type_id");
	//console.log("print",vat,vat_percent,total_before_vat);

	//INPUT DETECTOR
	switch (obj.id) {
		case "new_vat_percent":
			//EFFECT TO #vat
			vat.value = total.value * (new_vat_percent.value) / 100;
			break;
		case "vat":
			//EFFECT TO #vat_percent
			new_vat_percent.value = vat.value / total.value * 100;
			break;
	}
	vat_percent.value = new_vat_percent.value;

	//DISPLAY ON TOTAL
	new_vat_percent.disabled = false;
	new_vat_percent.readonly = false;
	switch (tax_type_id.value) {
		case "1":
			//EFFECT TO #vat
			console.log("CASE 1");
			total_before_vat.value = total.value -  vat.value*1;
			total_after_vat.value = total.value ;
			break;
		case "2":
			//EFFECT TO #vat_percent
			console.log("CASE 2");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value*1 + vat.value*1;
			break;
		default:
			new_vat_percent.disabled = true;
			new_vat_percent.readonly = true;
			new_vat_percent.value = 0;
			vat.value = 0;
			console.log("CASE OTHERS");
			total_before_vat.value = total.value;
			total_after_vat.value = total.value;
			break;
	}
}
document.addEventListener("DOMContentLoaded", function(event) {
  var dateControl = document.querySelector('input[type="datetime-local"]');
  //dateControl.value = '2017-06-01T08:30';
  var str_time = moment("{{ $row->datetime }}").format('YYYY-MM-DDTHH:mm');
  //console.log(str_time);
  dateControl.value = str_time;
});

//window.onload = onChange(document.getElementById("tax_type_id"));
//

</script>
