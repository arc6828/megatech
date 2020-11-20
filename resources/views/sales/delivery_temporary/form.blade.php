<div class="card">
  <div class="card-body">
  <div class="row mb-4">
      <div class="col-lg-4">
        <a href="{{ url('/sales/delivery_temporary') }}" title="Back" class="btn btn-warning btn-sm" >
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </a>
      </div>
      @if(isset($table_delivery_temporary))
      <div class="col-lg-4 text-center">
        <div class="">
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->delivery_temporary_code, 'C128') }}" alt="barcode"   />
        </div>
        <div class="">
        {{ $row->delivery_temporary_code }}
        </div>        
      </div>
      <div class="col-lg-4 text-right">
        @if($mode == "edit")
          @if($row->sales_status_id == 0)
          <a class="px-2 btn btn-sm btn-success" href="javascript:void(0)" onclick="document.querySelector('#sales_status_id').value='10'; document.querySelector('#delivery_temporary_code').value='';  document.querySelector('#form-submit').click(); console.log(5565);" title="สร้าง">
            <i class="fas fa-check"></i> สร้างใบส่งของชั่วคราว
          </a>          
          <a class="px-2 btn btn-sm btn-danger" href="javascript:void(0)" onclick="document.querySelector('#form-delete-submit').click();" title="ลบทิ้ง">
            <i class="fas fa-trash"></i> ลบทิ้ง
          </a>
          @endif
          
          @if($row->sales_status_id == 10)
          <a class="px-2 btn btn-sm btn-success" href="javascript:void(0)" onclick="document.querySelector('#form-cancel-submit').click(); console.log(5565);" title="ยกเลิก">
            <i class="fas fa-trash"></i> ปิดใบส่งของชั่วคราว
          </a>
          @endif
        @elseif($mode == "show")
          @if($row->sales_status_id != 11)
          <a class="px-2 btn btn-sm btn-warning" href="{{ url('/') }}/sales/delivery_temporary/{{ $row->delivery_temporary_id }}/edit" title="แก้ไข" >
            <i class="fas fa-edit"></i>  แก้ไข
          </a>
          @endif
        @endif
        
        <a class="px-2 btn btn-sm btn-primary" href="{{ url('/') }}/sales/delivery_temporary/{{ $row->delivery_temporary_id }}/pdf" target="_blank"  title="พิมพ์">
          <i class="fas fa-print"></i> พิมพ์
        </a>

      </div>
      @endif
    </div>
    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
      <input type="hidden" name="delivery_temporary_id" value="{{ isset($delivery_temporary->delivery_temporary_id)? $delivery_temporary->delivery_temporary_id : '' }}" />
        <input name="delivery_temporary_code"	id="delivery_temporary_code" class="form-control form-control-sm"	readonly>
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
            <span class="input-group-text" name="customer_code" id="customer_code" >......</span>
          </div>
          <input class="form-control" name="company_name" id="company_name" readonly>
          <div class="input-group-append">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#customerModal">
              <i class="fa fa-plus"></i> เลือกลูกหนี้
            </button>
          </div>
        </div>
      </div>
      @include('sales/delivery_temporary/customer_modal')
      <label class="col-lg-2">ผู้ติดต่อ</label>
      <div class="col-lg-3">
        <input name="contact_name" id="contact_name" class="form-control form-control-sm"	>
      </div>
    </div>



    <div class="form-group form-inline d-none">
      <label class="col-lg-2">ระยะเวลาหนี้ (วัน) (deplicated)</label>
      <div class="col-lg-3">
        <input type="number" name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line" disabled>
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา (วัน) (deplicated)</label>
      <div class="col-lg-3">
        <input type="number" name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  disabled>
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2">เงื่อนไขการชำระเงิน (วัน) (deplicated)</label>
      <div class="col-lg-3">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line"  disabled>
      </div>
      
      <label class="col-lg-2 offset-lg-1">ระยะเวลาส่งของ (วัน)(deplicated)</label>
      <div class="col-lg-3">
      <input type="number" name="delivery_time"	id="delivery_time" class="form-control form-control-sm form-control-line"  disabled>
      </div>
      
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ชนิดภาษี</label>
      <div class="col-lg-3">
        <select name="tax_type_id" id="tax_type_id" class="form-control form-control-sm" onChange="onChange(this)"  required readonly>

          @foreach($table_tax_type as $row_tax_type)
          <option value="{{ $row_tax_type->tax_type_id }}" >
            {{	$row_tax_type->tax_type_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm" required readonly>

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
      <label class="col-lg-2 d-none">รหัสแผนก</label>
      <div class="col-lg-3  d-none">
        <select name="department_id" id="department_id" class="form-control form-control-sm" required readonly>

          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_role }}" >
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>
      <label class="col-lg-2 offset-lg-1 d-none">เขตการขาย</label>
      <div class="col-lg-3 d-none">
        <select name="zone_id" id="zone_id" class="form-control form-control-sm" readonly>

          @foreach($table_zone as $row_zone)
          <option value="{{ $row_zone->zone_id }}" >
            {{	$row_zone->zone_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group form-inline">
      

      <label class="col-lg-2  offset-lg-6">สถานะ</label>
      <div class="col-lg-3">
        <input type="text" name="sales_status_id"	id="sales_status_id"	 class="d-none form-control form-control-sm form-control-line"   value="{{ isset($delivery_temporary)? $delivery_temporary->sales_status_id  : '0'  }}" readonly>
        <input type="text" name=""	id=""	 class="d-none form-control form-control-sm form-control-line "   value="{{ isset($delivery_temporary)? $delivery_temporary->sales_status->sales_status_name  : '0'  }}" readonly>
        @if(isset($delivery_temporary))
          @switch($delivery_temporary->sales_status_id)							
          @case(-1)
            <span class="badge badge-pill badge-secondary">Void</span>
            @break
          @case(0)
            <span class="badge badge-pill badge-primary">Draft</span>
            @break
          @case(10)
            <span class="badge badge-pill badge-warning">เปิดใบส่งของชั่วคราว</span>
            @break
          @case(11)
            <span class="badge badge-pill badge-success">ปิดใบส่งของชั่วคราว</span>
            @break	
          @endswitch
        @endif
      </div>
    </div>
  </div>
</div>


@include('sales/delivery_temporary/detail')

<div class="card mt-3">
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
					<input type="hidden" name="total" id="total"	class="form-control form-control-sm form-control-line"  >
					<label class="col-lg-6">หมายเหตุ</label>
					<label class="col-lg-3">ยอดรวมก่อนภาษี</label>
					<div class="col-lg-3">
						<input type="number" name="total_before_vat" id="total_before_vat"	class="form-control form-control-sm form-control-line roundnum"  readonly disabled>
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
						<input type="number" step="0.01" name="vat" id="vat" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-sm form-control-line  roundnum" readonly disabled >
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
  document.querySelectorAll("#table-delivery_temporary-detail .total_edit").forEach(function(element,index){
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

function onChangeCustomer(){

}

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
