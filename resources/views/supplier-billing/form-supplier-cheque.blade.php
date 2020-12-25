
@php
$checklist = $supplier->checklist;
@endphp

<div class="card  mt-4 bg-info">
  <div class="card-body">
    <h2>รับเช็ค</h2>
    <div class="row">            
      <div class="form-group col-lg-3">
        <label  >เงื่อนไขรับเช็ค </label>
        <input name="cheqe_condition"  id="cheqe_condition"  class="form-control form-control-sm  "  >
      </div>
      <div class="form-group col-lg-6">
        <label >หมายเหตุการรับเช็ค</label>
        <input name="remark_cheque" id="remark_cheque" class="form-control form-control-sm  "  >
      </div>
    </div>
    <div class="row">      
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
  </div>
</div>
