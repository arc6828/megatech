
@php
$checklist = $customer->checklist;
@endphp
<div class="card  mt-4 bg-info">
  <div class="card-body">
    <h2>เครดิต</h2>
    <div class="row">      

      <div class="form-group col-lg-3">
        <label >วิธีการขาย</label>
        <select class="form-control form-control-sm"  name="payment_method"  id="payment_method" >
          <option value="credit">ขายเชื่อ</option>
          <option value="cash">ขายสด</option>
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >วงเงินเครดิต</label>
        <input type="number" name="max_credit"  id="max_credit" class="form-control form-control-sm  "   >
      </div>
      <div class="form-group col-lg-3">
        <label >ระยะเวลาหนี้</label>
          <input type="number" name="debt_duration"  id="debt_duration" class="form-control form-control-sm  "    >
      </div>
      <div class="form-group col-lg-3">
        <label >วันที่ตัดรอบบิล <span class="text-red">*</span></label>
        <select class="form-control form-control-sm"  name="billing_cycle_date"  id="billing_cycle_date" >          
          @for($i=1; $i<=31; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
          @endfor
          <option value="last-day" selected>วันสุดท้ายของเดือน</option>
        </select>
      </div>
    </div>



    
    
    <div class="text-center">
      <a href="{{ url('full-calendar') }}?customer_id={{$customer->customer_id}}" class="btn btn-warning btn-sm">ดูปฏิทินวางบิลและรับเช็ค</a>
    </div>
  </div>
</div>

<div class="card  mt-4 bg-info">
  <div class="card-body">
    <h2>วางบิล</h2>
    <div class="row">      


      <div class="form-group col-lg-3">
        <label >เงื่อนไขวางบิล </label>
        <input name="billing_duration" id="billing_duration" class="form-control form-control-sm  " >
      </div>
      <div class="form-group col-lg-3">
        <label >ช่องทางการวางบิล<span class="text-red">*</span></label>
        <select name="billing_method" id="billing_method" class="form-control form-control-sm  ">
          <option value="drive">ไปวางเอง</option>
          <option value="post">ไปรษณีย์</option>
          <option value="email">อีเมล์</option>
        </select>
      </div>
      
      <div class="form-group col-lg-6">
        <label >หมายเหตุการวางบิล<span class="text-red">*</span></label>
        <input name="billing_remark" id="billing_remark" class="form-control form-control-sm  "  >
      </div>
      
    </div>
    
    <div class="row">      
      <div class="form-group col-lg-3 {{ $errors->has('billing_invoice') ? 'has-error' : ''}}">
          <label for="billing_invoice" class="control-label">
            <input type="checkbox" {{ $checklist->billing_invoice === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_invoice').value = this.checked"> 
            {{ 'ใบกำกับภาษี' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_invoice" type="text" id="billing_invoice" value="{{ isset($checklist->billing_invoice) ? $checklist->billing_invoice : ''}}" >
          {!! $errors->first('billing_invoice', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group col-lg-3 {{ $errors->has('billing_po') ? 'has-error' : ''}}">
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
      <div class="form-group col-lg-3 {{ $errors->has('billing_reference') ? 'has-error' : ''}}">
          <label for="billing_reference" class="control-label">
            <input type="checkbox" {{ $checklist->billing_reference === "true" ? 'checked' : ''}} onclick="document.querySelector('#billing_reference').value = this.checked"> 
            {{ 'พิมพ์เอกสารแนบใบวางบิล' }}
          </label>
          <input class="form-control form-control-sm checklist" name="billing_reference" type="text" id="billing_reference" value="{{ isset($checklist->billing_reference) ? $checklist->billing_reference : ''}}" >
          {!! $errors->first('billing_reference', '<p class="help-block">:message</p>') !!}
      </div>
    </div>



    <div class="text-center">
      <a href="{{ url('full-calendar') }}?customer_id={{$customer->customer_id}}" class="btn btn-warning btn-sm">ดูปฏิทินวางบิลและรับเช็ค</a>
    </div>

  </div>
</div>
