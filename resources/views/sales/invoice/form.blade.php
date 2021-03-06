<div class="card ">
  <div class="card-body">
    <div class="row my-4">
      <div class="col-lg-4">
        <a href="{{ url('/sales/invoice') }}" title="Back" class="btn btn-warning btn-sm" >
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </a>
      </div>
      <div class="col-lg-4">
        @if(isset($invoice))
          @if($mode == "show")
          <div class="text-center"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->invoice_code, "C128") }}" alt="barcode"   /></div>
				  <div class="text-center">{{ $row->invoice_code }}</div>
          @endif        
        @endif
      </div>
      <div class="col-lg-4  text-right">
        @if(isset($invoice))
          @if($mode == "show")
          <a class="btn btn-primary btn-sm btn-print mr-2" href="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}/pdf" target="_blank"  title="พิมพ์">
            <i class="fas fa-print"></i> พิมพ์
          </a>
          <a class="btn btn-warning btn-sm" href="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}/edit" title="แก้ไข">
            <i class="fas fa-edit"></i> แก้ไข
          </a>
          @endif      
        @endif
        
        @if(isset($row->sales_status_id))
          @if($row->sales_status_id > 0)
            @if($mode == "edit")
            <a href="javascript:void(0)" onclick="document.querySelector('#form-cancel-submit').click(); " class="px-2 btn btn-sm btn-danger">
              <span class="fa fa-trash"> ยกเลิก Invoice</span>
            </a>
            @endif
          @endif
        @endif
      </div>

    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="invoice_code"	id="invoice_code" class="form-control form-control-sm"	disabled>
      </div>
      <label class="col-lg-2 offset-lg-1">วันที่เวลา</label>
      <div class="col-lg-3">
        <input name="datetime" id="datetime" class="form-control form-control-sm form-control-line"	readonly>
      </div>
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสลูกหนี้</label>
      <div class="col-lg-3">
        <input type="hidden" name="customer_id" id="customer_id" class="form-control form-control-sm"  required>
        <div class="input-group input-group-sm ">
          <div class="input-group-prepend">
            <span class="input-group-text" name="customer_code" id="customer_code" ></span>
          </div>
          <input class="form-control" name="company_name" id="company_name" readonly>
          <div class="input-group-append">
            <button class="btn btn-success" id="btn-customer" type="button" data-toggle="modal" data-target="#customerModal">
              <i class="fa fa-plus"></i> เลือกลูกหนี้
            </button>
          </div>
        </div>
        @include('sales/invoice/customer_modal')
      </div>
      <label class="col-lg-2 offset-lg-1">เลขที่ใบจอง</label>
      <div class="col-lg-3">
        <input name="internal_reference_id" id="internal_reference_id" class="form-control form-control-sm"  readonly style="max-width:120px;">
        <!-- include('sales/invoice/create_from_order_modal') -->
      </div>
    </div>
    
    <div class="form-group form-inline">

      <label class="col-lg-2">PO ลูกค้า</label>
      <div class="col-lg-3">
        <input name="external_reference_id" id="external_reference_id" class="form-control form-control-sm form-control-line"	value="{{ isset($invoice->order) ? $invoice->order->external_reference_id :'' }}" required readonly>
        @if(isset($invoice->order))        
          @if(!empty($invoice->order->po_file) )
          <a href="{{ url('storage/'.$invoice->order->po_file) }}" id="po-file-link" target="_blank">ดูไฟล์ P/O</a>
          @else
          <a href="#" id="po-file-link"  target="_blank"></a>
          @endif
        @else
        <a href="#" id="po-file-link"  target="_blank"></a>
        @endif
      </div>
      <!-- <label class="col-lg-2 offset-lg-1">วันที่ส่งของ</label>
      <div class="col-lg-3">
      <input type="date" name="delivery_time"	id="delivery_time" class="form-control form-control-sm form-control-line" >
      </div> -->
    </div>
    

    <div class="form-group form-inline">
      <label class="col-lg-2">ระยะเวลาหนี้ (วัน)</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line" 	>
      </div>
      <label class="col-lg-2 offset-lg-1">วันที่ชำระเงิน</label>
      <div class="col-lg-3">
        <input type="date" name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  >
      </div>
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">วิธีการชำระเงิน</label>
      <div class="col-lg-3">
        <input type="hidden" name="payment_method"	id="payment_method"	class="form-control form-control-sm form-control-line" readonly 	required>
        <input id="payment_method_th"	 class="form-control form-control-sm form-control-line" value="" readonly 	>
      </div>
      <label class="col-lg-2 offset-lg-1">วงเงินเครดิต</label>
      <div class="col-lg-3">
        <input type="number" name="max_credit"	id="max_credit"	 class="form-control form-control-sm form-control-line"   value="100" readonly required>
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
      <label class="col-lg-2 ">พนักงานขาย</label>
      <div class="col-lg-3">
        <select name="staff_id" id="staff_id" class="form-control form-control-sm" required readonly>

          @foreach($table_sales_user as $row_sales_user)
          <option value="{{ $row_sales_user->id }}" >
            {{	$row_sales_user->name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2  offset-lg-1">พนักงานผู้บันทึก</label>
      <div class="col-lg-3">
        <select name="user_id" id="user_id" class="form-control form-control-sm" required readonly>

          @foreach($table_sales_user as $row_sales_user)
          <option value="{{ $row_sales_user->id }}" >
            {{	$row_sales_user->name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2  offset-lg-1 d-none">รหัสแผนก</label>
      <div class="col-lg-3 d-none">
        <select name="department_id" id="department_id" class="form-control form-control-sm" required>

          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_role }}" >
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>

    </div>

    <div class="form-group form-inline d-none">
      
      <label class="col-lg-2 offset-lg-1 d-none">สถานะ</label>
      <div class="col-lg-3 d-none">
        <select name="sales_status_id" id="sales_status_id" class="form-control form-control-sm" required>

          @foreach($table_sales_status as $row_sales_status)
          <option value="{{ $row_sales_status->sales_status_id }}" >
            {{	$row_sales_status->sales_status_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน (วัน)</label>
      <div class="col-lg-3">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line" disabled>
      </div>

      <label class="col-lg-2 offset-lg-1">เขตการขาย</label>
      <div class="col-lg-3">
        <select name="zone_id" id="zone_id" class="form-control form-control-sm" >

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


@include('sales/invoice/detail')

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
            <textarea name="remark" id="remark" class="form-control form-control-line"></textarea>

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
						<input type="number"  name="total_after_vat" id="total_after_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>

function onChangeCustomer(id){
  $("#btn-ref-order").click();
  $("#btn-ref-order").attr("data-id",id);
}
function refreshTotal(){
  var total = 0;
  document.querySelectorAll("#table-invoice-detail .total_edit").forEach(function(element,index){
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
function showProduct(){}

</script>


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
