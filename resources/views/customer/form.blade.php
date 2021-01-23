<div class="card">
  <div class="card-body">
  <div class="row mb-4">
      <div class="col-lg-4">
        <!-- <a href="{{ url('/sales/order') }}" title="Back" class="btn btn-warning btn-sm" >
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </a> -->
      </div>
      @if(isset($customer))
      <div class="col-lg-4 text-center"></div>
      <div class="col-lg-4 text-right">
        @if($mode == "show")
          <a class="px-2 btn btn-sm btn-warning" href="{{ url('/customer') }}/{{ $customer->customer_id }}/edit" title="แก้ไข" >
            <i class="fas fa-edit"></i> แก้ไข
		      </a>
        @endif
        
		  	<!-- <a class="px-2 btn btn-sm btn-primary" href="{{ url('/') }}/sales/order/{{ $customer->customer_id }}/pdf" target="_blank"  title="พิมพ์">
		      <i class="fas fa-print"></i> พิมพ์
		    </a>        -->
      </div>
      @endif
    </div>

    <h2>ข้อมูลพื้นฐานลูกค้า</h2>
    <div class="row">
      <div class="form-group col-lg-2">
        <label>รหัสลูกค้า <span class="text-red">*</span> </label>
        <input name="customer_code"  id="customer_code" class="form-control form-control-sm " value=""  required="" >
        
      </div>
      <div class="form-group col-lg-6">
        <label>ชื่อบริษัท <span class="text-red">*</span></label>
        <input type="text" name="company_name"   id="company_name"   class="form-control form-control-sm  "  required>
      </div>
      <div class="form-group col-lg-4">
        <label >ชื่อพนักงานที่ดูแล <span class="text-red">*</span></label>
        <div class="input-group">
          <input name="short_name" id="name"  class="form-control form-control-sm  "  readonly>
          <div class="input-group-append">
            <button class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#exampleModal2">
              <i class="fa fa-plus"></i> รหัสพนักงาน
            </button>
          </div>
        </div>
        <input type="text" class="d-none" name="user_id" id="user_id"  required="" />
        @include('customer/modal-user')
      </div>
      <div class="form-group col-lg-2 d-none">
        <label >ประเภทลูกค้า</label>
        <select name="customer_type" id="customer_type"  class="form-control form-control-sm  ">
          @foreach ($table_customer_type as $cus)
          <option value="{{ $cus->customer_type_id }}">{{ $cus->customer_type_name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-3">
        <label >เลขภาษี <span class="text-red">*</span></label>
        <input name="tax_number" id="tax_number"  class="form-control form-control-sm  tax-format"    maxlength="13"  required>
      </div>
      <div class="form-group col-lg-3">
        <label >ชนิดสถานที่ประกอบการ <span class="text-red">*</span></label>
        <select name="location_type_id" id="location_type_id" class="form-control form-control-sm  "  >
            @foreach ($table_location as $location)
            <option value="{{ $location->location_type_id }}">{{ $location->location_type_name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label  >สำนักงาน/สาขา (แสดงในภาษี) (ถ้ามี) </label>
        <input name="branch_id" id="branch_id"  class="form-control form-control-sm  "  value="" >
      </div>
      <div class="form-group col-lg-3">
        <label >รหัสผังบัญชี (ถ้ามี)</label>
        <div class="input-group">
          <input name="account_id" id="account_id"  class="form-control form-control-sm  ">
          <div class="input-group-append">
            <button class="btn btn-outline-primary btn-sm" type="button"  data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> รหัสผังบัญชี
            </button>
          </div>
        </div>
        @include('customer/modal-account')
        <div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-lg-4">
        <label >ที่อยู่ <span class="text-red">*</span></label>
        <input type="text" name="address"  id="address" class="form-control form-control-sm"  required>
      </div>
      <div class="form-group col-lg-2">
        <label >จังหวัด <span class="text-red">*</span></label>
        <select class="form-control form-control-sm" name="province"  id="province" onchange="showAmphoes('address')" required>
          <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label >อำเภอ <span class="text-red">*</span></label>
        <select class="form-control form-control-sm"  name="district"  id="district"  onchange="showDistricts('address')" required>
        <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label>ตำบล <span class="text-red">*</span></label>
        <select class="form-control form-control-sm"  name="sub_district" id="sub_district" onchange="showZipcode('address')" required>
        <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label  >รหัสไปรษณีย์ <span class="text-red">*</span></label>
        <input class="form-control form-control-sm"  name="zipcode"  id="zipcode" placeholder="รหัสไปรษณีย์" required />
        
      </div>
    </div>

    <div class="row">
      <div class="form-group  col-lg-6 d-none">
          <label >รายชื่อผู้ติดต่อ (ถ้ามี)</label>
          <input name="contact_name" id="contact_name" class="form-control form-control-sm "  >
      </div>
      <div class="form-group col-lg-3">
          <label >เบอร์โทรศัพท์ <span class="text-red">*</span></label>
          <input name="telephone" id="telephone" class="form-control form-control-sm " required >
      </div>
      <div class="form-group col-lg-3">
        <label >เบอร์ FAX (ถ้ามี)</label>
        <input name="fax" id="fax"  class="form-control form-control-sm  "   >
      </div>
      <div class="form-group col-lg-3">
      <label >หมายเหตุ (ถ้ามี)</label>
        <input name="remark" id="remark"  class="form-control form-control-sm  "   >
      </div>
    </div>
    
    
  </div>
</div>

<div class="card mt-4">
  <div class="card-body">
    <h2>ข้อมูลสถานที่ส่งของ</h2>

    <div class="row">
      <div class="form-group col-lg-4">
        <label >สถานที่ส่งของ (ถ้ามี)</label>
        <input type="text" name="delivery_address" id="delivery_address" class="form-control form-control-sm  " >
      </div>
      <div class="form-group col-lg-2">
        <label >จังหวัด (ถ้ามี)</label>
        <select class="form-control form-control-sm" name="delivery_province"  id="delivery_province" onchange="showAmphoes('delivery_address')">
        <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label >อำเภอ (ถ้ามี)</label>
        <select class="form-control form-control-sm"  name="delivery_district"  id="delivery_district"  onchange="showDistricts('delivery_address')">
        <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label>ตำบล (ถ้ามี)</label>
        <select class="form-control form-control-sm"  name="delivery_sub_district" id="delivery_sub_district" onchange="showZipcode('delivery_address')">
        <option value="">ไม่ระบุ</option>
        </select>
        
      </div>
      <div class="form-group col-lg-2">
        <label  >รหัสไปรษณีย์ (ถ้ามี)</label>
        <input class="form-control form-control-sm"  name="delivery_zipcode"  id="delivery_zipcode" placeholder="รหัสไปรษณีย์" />
        
      </div>
    </div>
    @include('customer/district_script')

    <div class="row">
      <div class="form-group col-lg-3  d-none">
        <label >เขตการขายของ</label>
        <select name="zone_id" id="zone_id" class="form-control form-control-sm  " >
          @foreach ($table_zone as $zone)
          <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >ขนส่งโดย <span class="text-red">*</span></label>
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm  " required>
          @foreach ($table_delivery_type as $d)
            <option value="{{ $d->delivery_type_id }}">{{ $d->delivery_type_name }}</option>
          @endforeach
        </select>
      </div>

    </div>
    
  </div>
</div>

<div class="card  mt-4">
  <div class="card-body">
    <h2>เครดิต</h2>
    <div class="row">      

      <div class="form-group col-lg-3">
        <label >วิธีการขาย <span class="text-red">*</span></label>
        <select class="form-control form-control-sm"  name="payment_method"  id="payment_method" >
          <option value="credit">ขายเชื่อ</option>
          <option value="cash">ขายสด</option>
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >วงเงินเครดิต (บาท) <span class="text-red">*</span></label>
        @if( Auth()->user()->role == "admin" )
        <input type="number" name="max_credit"  id="max_credit" class="form-control form-control-sm  " value="{{ isset($customer) ? number_format($customer->max_credit) : '-1'  }}"   required>
        @else
        <div>{{ isset($customer) ? number_format($customer->max_credit) : "-1"  }} </div>
        @endif
      </div>
      <div class="form-group col-lg-3">
        <label >ระยะเวลาหนี้ (วัน) <span class="text-red">*</span></label>
          <input type="number" name="debt_duration"  id="debt_duration" class="form-control form-control-sm  "    required>
      </div>
      <div class="form-group col-lg-3">
        <label >วันที่ตัดรอบบิล <span class="text-red">*</span></label>
        <select class="form-control form-control-sm"  name="billing_cycle_date"  id="billing_cycle_date" >                    
          @for($i=1; $i<=28; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
          @endfor
          <option value="last-day" selected>วันสุดท้ายของเดือน</option>
          <option value="calendar" >ตามปฏิทินที่ให้ไว้</option>
        </select>
      </div>
    </div>



    
    @if(isset($customer))
    <div class="text-center">
      <a href="{{ url('full-calendar') }}?customer_id={{$customer->customer_id}}" class="btn btn-warning btn-sm">ดูปฏิทินวางบิลและรับเช็ค</a>
    </div>
    @endif
  </div>
</div>

<div class="card  mt-4">
  <div class="card-body">
    <h2>วางบิล</h2>
    <div class="row">      


      
      <div class="form-group col-lg-3">
        <label >ช่องทางการวางบิล <span class="text-red">*</span></label>
        <select name="billing_method" id="billing_method" class="form-control form-control-sm  ">
          <option value="drive">ไปวางเอง</option>
          <option value="post">ไปรษณีย์</option>
          <option value="email">อีเมล์</option>
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >เงื่อนไขวางบิล (ถ้ามี)</label>
        <input name="billing_duration" id="billing_duration" class="form-control form-control-sm  " >
      </div>
      
      <div class="form-group col-lg-6">
        <label >หมายเหตุการวางบิล (ถ้ามี)</label>
        <input name="billing_remark" id="billing_remark" class="form-control form-control-sm  "  >
      </div>
      
    </div>
    @if(isset($checklist))
    <div class="row">      
      <div class="form-group col-lg-3 {{ $errors->has('billing_invoice') ? 'has-error' : ''}} d-none">
          <label for="billing_invoice" class="control-label">
            <input type="checkbox" {{ $checklist->billing_invoice === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_invoice').value = this.checked"> 
            {{ 'ใบกำกับภาษี' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_invoice" type="text" id="billing_invoice" value="{{ isset($checklist->billing_invoice) ? $checklist->billing_invoice : ''}}" >
          {!! $errors->first('billing_invoice', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('billing_po') ? 'has-error' : ''}} d-none">
          <label for="billing_po" class="control-label">
            <input type="checkbox" {{ $checklist->billing_po === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_po').value = this.checked"> 
            {{ 'P/O' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_po" type="text" id="billing_po" value="{{ isset($checklist->billing_po) ? $checklist->billing_po : ''}}" >
          {!! $errors->first('billing_po', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('billing_receipt') ? 'has-error' : ''}}">
          <label for="billing_receipt" class="control-label">
            <input type="checkbox" {{ $checklist->billing_receipt === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_receipt').value = this.checked"> 
            {{ 'ใบเสร็จรับเงิน' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_receipt" type="text" id="billing_receipt" value="{{ isset($checklist->billing_receipt) ? $checklist->billing_receipt : ''}}" >
          {!! $errors->first('billing_receipt', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('billing_envelope') ? 'has-error' : ''}}">
          <label for="billing_envelope" class="control-label">
            <input type="checkbox" {{ $checklist->billing_envelope === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_envelope').value = this.checked"> 
            {{ 'ซองจดหมายติดแสตมป์' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_envelope" type="text" id="billing_envelope" value="{{ isset($checklist->billing_envelope) ? $checklist->billing_envelope : ''}}" >
          {!! $errors->first('billing_envelope', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('billing_delivery') ? 'has-error' : ''}}">
          <label for="billing_delivery" class="control-label">
            <input type="checkbox" {{ $checklist->billing_delivery === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_delivery').value = this.checked"> 
            {{ 'ส่งของพร้อมวางบิล' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_delivery" type="text" id="billing_delivery" value="{{ isset($checklist->billing_delivery) ? $checklist->billing_delivery : ''}}" >
          {!! $errors->first('billing_delivery', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 d-none {{ $errors->has('billing_reference') ? 'has-error' : ''}}">
          <label for="billing_reference" class="control-label">
            <input type="checkbox" {{ $checklist->billing_reference === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_reference').value = this.checked"> 
            {{ 'พิมพ์เอกสารแนบใบวางบิล' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_reference" type="text" id="billing_reference" value="{{ isset($checklist->billing_reference) ? $checklist->billing_reference : ''}}" >
          {!! $errors->first('billing_reference', '<p class="help-block">:message</p>') !!}
      </div>
    </div>
    @endif

    @if(isset($customer))
    <div class="text-center">
      <a href="{{ url('full-calendar') }}?customer_id={{$customer->customer_id}}" class="btn btn-warning btn-sm">ดูปฏิทินวางบิลและรับเช็ค</a>
    </div>
    @endif

  </div>
</div>


<div class="card  mt-4">
  <div class="card-body">
    <h2>การจ่ายชำระ</h2>
    <div class="row">            
      <div class="form-group col-lg-3">
        <label  >ช่องทางการชำระเงิน <span class="text-red">*</span></label>
        <select class="form-control form-control-sm  " id="payment" name="payment">
          <option>รับเช็ค (พร้อมใบเสร็จรับเงิน)</option>
          <option>โอน</option>
        </select>
        
      </div>
      <div class="form-group col-lg-3">
        <label  >เงื่อนไขการจ่ายชำระ (ถ้ามี)</label>
        <input name="cheqe_condition"  id="cheqe_condition"  class="form-control form-control-sm  "  >
      </div>
      <div class="form-group col-lg-6">
        <label >หมายเหตุการจ่ายชำระ (ถ้ามี)</label>
        <input name="remark_cheque" id="remark_cheque" class="form-control form-control-sm  "  >
      </div>
    </div>
    @if(isset($checklist))
    <div class="row d-none">      
      <div class="form-group col-lg-3 {{ $errors->has('billing_invoice') ? 'has-error' : ''}}">
          <label for="cheque_billing" class="control-label">
            <input type="checkbox" {{ $checklist->cheque_billing === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_billing').value = this.checked"> 
            {{ 'เอกสารวางบิล' }}
          </label>
          <input class="form-control form-control-sm checklist" name="cheque_billing" type="text" id="cheque_billing" value="{{ isset($checklist->cheque_billing) ? $checklist->cheque_billing : ''}}" >
          {!! $errors->first('cheque_billing', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('cheque_receipt') ? 'has-error' : ''}}">
          <label for="cheque_receipt" class="control-label">
            <input type="checkbox" {{ $checklist->cheque_receipt === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_receipt').value = this.checked"> 
            {{ 'ใบเสร็จรับเงิน' }}
          </label>
          <input class="form-control form-control-sm checklist" name="cheque_receipt" type="text" id="cheque_receipt" value="{{ isset($checklist->cheque_receipt) ? $checklist->cheque_receipt : ''}}" >
          {!! $errors->first('cheque_receipt', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('cheque_po') ? 'has-error' : ''}}">
          <label for="cheque_po" class="control-label">
            <input type="checkbox" {{ $checklist->cheque_po === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_po').value = this.checked"> 
            {{ 'P/O' }}
          </label>
          <input class="form-control form-control-sm checklist" name="cheque_po" type="text" id="cheque_po" value="{{ isset($checklist->cheque_po) ? $checklist->cheque_po : ''}}" >
          {!! $errors->first('cheque_po', '<p class="help-block">:message</p>') !!}
      </div>
      
      
      
      
    </div>
    @endif
  </div>
</div>


@include('customer/form-upload')


<div>
  <div class="form-group col-lg-3 d-none">
    <label >ระดับของราคาสินค้า</label>
    <input type="number" name="degree_product"  class="form-control form-control-sm  "   value="" >
  </div>
  <div class="form-group col-lg-3 d-none">
    <label >ส่วนลด </label>
    <input type="number" name="loyalty_discount"  class="form-control form-control-sm  " value="" >
  </div>
</div>

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
