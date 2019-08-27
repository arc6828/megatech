<div class="card">
  <div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/sales/order') }}" title="Back" class="btn btn-warning btn-sm" >
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
      </a>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="order_code"	id="order_code" class="form-control form-control-sm"	disabled>
      </div>
      <label class="col-lg-2 offset-lg-1">วันที่เวลา</label>
      <div class="col-lg-3">
        <input name="datetime" id="datetime" class="form-control form-control-sm form-control-line"	readonly>
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
      </div>
      @include('sales/order/customer_modal')
      <label class="col-lg-2">P/O ลูกหนี้</label>
      <div class="col-lg-3">
        <input name="external_reference_id" id="external_reference_id" class="form-control form-control-sm form-control-line" onchange="validate_po()" data="" placeholder="ใส่ '-' ถ้าไม่มี po"	required>

      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ระยะเวลาหนี้ (วัน)</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line"	required>
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา (วัน)</label>
      <div class="col-lg-3">
        <input type="number" name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  required>
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน (วัน)</label>
      <div class="col-lg-3">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line" required>
      </div>
      <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm" required>

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

          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_role }}" >
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">สถานะ</label>
      <div class="col-lg-3">
        <select name="sales_status_id" id="sales_status_id" class="form-control form-control-sm" required>

          @foreach($table_sales_status as $row_sales_status)
          <option value="{{ $row_sales_status->sales_status_id }}" >
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

          @foreach($table_sales_user as $row_sales_user)
          <option value="{{ $row_sales_user->id }}" >
            {{	$row_sales_user->name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">เขตการขาย</label>
      <div class="col-lg-3">
        <select name="zone_id" id="zone_id" class="form-control form-control-sm" required>

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


@include('sales/order/detail')

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
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly>
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-lg-6">
            <textarea name="remark" id="remark" class="form-control" style="width:100%"></textarea>

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
  document.querySelectorAll("#table-order-detail .total_edit").forEach(function(element,index){
    //console.log("Total");
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
  total.value = parseFloat(total.value).toFixed(2);
  total_before_vat.value = parseFloat(total_before_vat.value).toFixed(2);
  total_after_vat.value = parseFloat(total_after_vat.value).toFixed(2);
  vat.value = parseFloat(vat.value).toFixed(2);
  document.querySelectorAll(".roundnum").forEach(function(element) {
    //console.log(element);
    //element.value = parseFloat(element.value).toFixed(2)
  });

}

function onChangeCustomer(){
  $("#btn-ref-quotation").click();
}

function validate_po(){
  var customer_id = $("#customer_id").val();
  var external_reference_id = $("#external_reference_id").val();
  console.log("URL : " , "{{ url('/') }}/api/order/validate_po?customer_id="+customer_id+"&external_reference_id="+external_reference_id);
  if(external_reference_id != "-"){
    $.ajax({
        url: "{{ url('/') }}/api/order/validate_po?customer_id="+customer_id+"&external_reference_id="+external_reference_id,
        type: "GET",
        dataType : "json",
    }).done(function(result){
        console.log(result);
        if(result.length > 0){
          console.log("repeat",result.length);

          $("#external_reference_id").addClass("bg-danger");
          if(result.length == 1){
            $("#external_reference_id").addClass("bg-dander");
            if($("#external_reference_id").val() === $("#external_reference_id").attr("data")){
              $("#external_reference_id").removeClass("bg-danger");
            }
          }
        }else{
          console.log("identical",result.length);

          $("#external_reference_id").removeClass("bg-danger");
        }
      }); //END AJAX
  }


}

</script>
