<div class="card">
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-lg-4">
        <a href="{{ url('/sales/quotation') }}" title="Back" class="btn btn-warning btn-sm" >
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </a>
      </div>
      @if(isset($table_quotation))
        <div class="col-lg-4 text-center">
          <div class="">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->quotation_code, 'C128') }}" alt="barcode"   />
          </div>
          <div class="">
            {{ $row->quotation_code }}
          </div>        
        </div>
        <script>
          function duplicate(){
            //alert('hey'); 
            let elements = document.querySelector("#form-duplicate").children;
            // console.log("want to approved", elements);
            for(var item of elements){
              item.removeAttribute("disabled");
            };
            //click
            document.querySelector('#btn-duplicate').click();          
          }
          function approved(){
            //document.querySelector("#sales_status_id").removeAttribute("disabled");
            //document.querySelector("#sales_status_id").setAttribute("readonly","");
            //document.querySelector("#sales_status_id").value=1;
            //document.querySelector("#form-submit").removeAttribute("disabled");
            //document.querySelector("#form-submit").removeAttribute("disabled");
            //document.querySelector("#form-approve-submit").removeAttribute("disabled");
            
            let elements = document.querySelector("#form-approve").children;

            console.log("want to approved", elements);
            for(var item of elements){
              item.removeAttribute("disabled");
            };

            document.querySelector("#form-approve-submit").click();
            
          }

          function onDelete(id){
            //--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

            //GET FORM BY ID
            var form = document.getElementById("form_delete");
            let elements = form.children;
            console.log("want to delete", elements);
            for(var item of elements){
              item.removeAttribute("disabled");
            };
            //CHANGE ACTION TO SPECIFY ID
            //form.action = "{{ url('/') }}/sales/quotation/"+id;
            //SUBMIT
            var want_to_delete = confirm('Are you sure to delete this quotation ?');
            if(want_to_delete){
              form.submit();
            }
          }
        </script>
        <div class="col-lg-4 text-right">
          @if($mode == "edit")
            @if($row->sales_status_id == 0)
            <a class="px-2 btn btn-sm btn-success" href="javascript:void(0)" onclick="approved()">
              <i class="fas fa-check"></i> อนุมัติ QT
            </a>
            <a href="javascript:void(0)" onclick="onDelete( {{ $row->quotation_id }} )" class="px-2 btn btn-sm btn-danger">
              <span class="fa fa-trash"> ลบทิ้ง</span>
            </a>
            @endif
            @if($row->sales_status_id != -1)
              @if($row->sales_status_id != 0)   
              
              <button class="px-2 btn btn-sm btn-warning" type="button" onclick="document.querySelector('#btn-change-status').click();">              
                <i class="fas fa-refresh"></i> เปลี่ยนสถานะ
              </button>
              <a class="px-2 btn btn-sm btn-primary" href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/pdf" target="_blank">              
                <i class="fas fa-print"></i> พิมพ์
              </a>
              @endif          
            @endif
          @elseif($mode == "show")
            @if($row->sales_status_id != -1)
              @if($row->sales_status_id != 0)
              <a href="javascript:void(0)" onclick="duplicate();" class="px-2 btn btn-sm btn-warning">              
                <i class="fas fa-copy"></i> copy QT
              </a>
              <a class="px-2 btn btn-sm btn-primary" href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/pdf" target="_blank">              
                <i class="fas fa-print"></i> พิมพ์
              </a>
              @endif
              @if($row->sales_status_id != 5)
              <a class="px-2 btn btn-sm btn-primary" href="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/edit">
                <i class="fas fa-edit"></i> แก้ไข
              </a>
              @endif
            @else
            <a class="px-2 btn btn-sm btn-danger" href="#">
              <i class="fas fa-ban"></i> void
            </a>
            @endif
          
          @endif
        </div>
      @endif
    </div>
    <input type="hidden" name="quotation_id" value="{{ isset($quotation->quotation_id)? $quotation->quotation_id : '' }}" />

    <div class="form-group form-inline">
      <label class="col-lg-2">รหัสเอกสาร</label>
      <div class="col-lg-3">
        <input name="quotation_code"	id="quotation_code" class="form-control form-control-sm"	readonly> 

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
            <button class="btn btn-success" type="button" id="btn-customer" data-toggle="modal" data-target="#customerModal">
              <i class="fa fa-plus"></i> เลือกลูกหนี้
            </button>
          </div>
        </div>
      </div>
      @include('sales/quotation/customer_modal')

      <label class="col-lg-2">CC</label>
      <div class="col-lg-3">
        <select name="contact_name" id="contact_name" class="form-control form-control-sm"	>
          <option>ระบุผู้ติดต่อถ้ามี...</option>
        </select>
      </div>

    </div>



    <div class="form-group form-inline">
    

      <label class="col-lg-2">ขนส่งโดย</label>
      <div class="col-lg-3">
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm" required >

          @foreach($table_delivery_type as $row_delivery_type)
          <option value="{{ $row_delivery_type->delivery_type_id }}" >
            {{	$row_delivery_type->delivery_type_name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>



    <div class="form-group form-inline">
      <label class="col-lg-2">ระยะเวลาหนี้ (วัน)</label>
      <div class="col-lg-3">
        <input name="debt_duration"	id="debt_duration"	class="form-control form-control-sm form-control-line"	required >
      </div>
      <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา (วัน)</label>
      <div class="col-lg-3">
        <input  name="billing_duration"	id="billing_duration"	 class="form-control form-control-sm form-control-line"  required >
      </div>
    </div>

    <div class="form-group form-inline d-none">
      <label class="col-lg-2  d-none">ระยะเวลาส่งของ (วัน)</label>
      <div class="col-lg-3   d-none">
      <input type="number" name="delivery_time"	id="delivery_time" class="form-control form-control-sm form-control-line" required >
      </div>
      
    </div>

    <div class="form-group form-inline">
      <label class="col-lg-2">ชนิดภาษี</label>
      <div class="col-lg-3">
        <select name="tax_type_id" id="tax_type_id" class="form-control form-control-sm" onChange="onChange(this)"  required >

          @foreach($table_tax_type as $row_tax_type)
          <option value="{{ $row_tax_type->tax_type_id }}" >
            {{	$row_tax_type->tax_type_name }}
          </option>
          @endforeach
        </select>
      </div>

      <label class="col-lg-2  offset-lg-1">สถานะ</label>
      <div class="col-lg-3">
        @if(isset($mode))
          @if( $row->sales_status_id == 1  )
            <a  href="#"
              href2="{{ url('/') }}/sales/order/create?quotation_code={{ $row->quotation_code }}"
              title="{{ $row->sales_status_name }}"
              class="btn btn-primary btn-sm d-none"
              >
              รอเปิด Order
            </a>
            <span class="badge badge-pill badge-primary">{{ $row->sales_status_name }}</span>
          @elseif( $row->sales_status_id == 4    )
            <span class="badge badge-pill badge-danger">{{ $row->sales_status_name }}</span>							
          @elseif( $row->sales_status_id == 5    )
            <span class="badge badge-pill badge-success">{{ $row->sales_status_name }}</span>
          @elseif( $row->sales_status_id == -1    )
            <span class="badge badge-pill badge-secondary">{{ $row->sales_status_name }}</span>
            
          @else
            <span class="badge badge-pill badge-warning">{{ $row->sales_status_name }}</span>
            
          @endif
        @endif
        <select name="sales_status_id" id="sales_status_id" class="d-none form-control form-control-sm" required onchange="document.querySelector('#sales_status_id').value > 1 ? $('#reason').removeClass('d-none') : $('#reason').addClass('d-none') " >

          @foreach($table_sales_status as $row_sales_status)
          <option value="{{ $row_sales_status->sales_status_id }}"
                {{ $row_sales_status->sales_status_id == "5" ? "disabled" : "" }} >
            {{	$row_sales_status->sales_status_name }}
          </option>
          @endforeach
        </select>
        @if(isset($mode))
          @if($mode=="edit")
          <input name="reason" id="reason" class="d-none" value="">
          @elseif($mode=="show")
          <input name="reason" id="reason" value="{{ $row->reason }}">
          @endif
        @endif
      </div>
      
      
      
    </div>

    <div class="form-group form-inline d-none">
    
      <label class="col-lg-2 d-none">เงื่อนไขการชำระเงิน (วัน)</label>
      <div class="col-lg-3 d-none">
        <input name="payment_condition"	id="payment_condition"	class="form-control form-control-sm form-control-line" disabled>
      </div>
      
      <label class="col-lg-2 offset-lg-1 d-none">เขตการขาย</label>
      <div class="col-lg-3 d-none">
        <select name="zone_id" id="zone_id" class="form-control form-control-sm" >

          @foreach($table_zone as $row_zone)
          <option value="{{ $row_zone->zone_id }}" >
            {{	$row_zone->zone_name }}
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
      <label class="col-lg-2 offset-lg-1 d-none">รหัสแผนก</label>
      <div class="col-lg-3  d-none">
        <select name="department_id" id="department_id" class="form-control form-control-sm"  >

          @foreach($table_department as $row_department)
          <option value="{{ $row_department->department_role }}" >
            {{	$row_department->department_name }}
          </option>
          @endforeach
        </select>
      </div>

      
    </div>
  </div>
</div>


@include('sales/quotation/detail')

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
						<input type="number" step="0.01" name="vat" id="vat" onkeyup="onChange(this)" onChange="onChange(this)" class="form-control form-control-sm form-control-line  roundnum" readonly >
					</div>
				</div>
				<div class="form-group form-inline">
	   				<label class="col-lg-6">
              <div>
                @if( isset($customer) )
                  @if(isset($customer->contacts))
                    @foreach ($customer->contacts as $contact)
                        @if(isset($contact->ref_qt))

                          ติดต่อ : {{ $contact->name}} / Email : {{ $contact->email}}
                        @endif
                    @endforeach
                    @if (session('flash_message'))
                    <script>
                      alert(""
                        @foreach ($customer->contacts as $contact)
                            @if(isset($contact->ref_qt))
                              +"ติดต่อ : {{ $contact->name}} / Email : {{ $contact->email}}"
                            @endif
                        @endforeach
                      
                      );
                    </script>
                    @endif
                  @endif
                @endif
              </div>
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
  document.querySelectorAll(".total_edit").forEach(function(element,index){
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

  total.value = parseFloat(total.value).toFixed(2);
  total_before_vat.value = parseFloat(total_before_vat.value).toFixed(2);
  total_after_vat.value = parseFloat(total_after_vat.value).toFixed(2);
  vat.value = parseFloat(vat.value).toFixed(2);
  //roundnum
  document.querySelectorAll(".roundnum").forEach(function(element) {
    //console.log(element);
    //element.value = parseFloat(element.value).toFixed(2)
  });



}

function onChangeCustomer(){

}



</script>
