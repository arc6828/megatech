<div class="row">
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
            <label for="doc_no" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
            <input class="form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($customerdebt->doc_no) ? $customerdebt->doc_no : ''}}" >
            {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            <label for="date" class="control-label">{{ 'วันที่เอกสาร' }}</label>
            <input class="form-control form-control-sm" name="date" type="date" id="date" value="{{ isset($customerdebt->date) ? $customerdebt->date : ''}}" >
        </div>
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
  </div>
  
</div>


<div class="row">
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
            <label for="customer_id" class="control-label">{{ 'รหัสลูกค้า' }}</label>
            <input class="form-control form-control-sm" name="customer_id" type="number" id="customer_id" value="{{ isset($customerdebt->customer_id) ? $customerdebt->customer_id : ''}}" >
            {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
  <div class="col-sm-6">

  </div>
  
</div>



<div class="row">
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('tax_type_id') ? 'has-error' : ''}}">
            <label for="tax_type_id" class="control-label">{{ 'ชนิดภาษี' }}</label>
            <input class="form-control form-control-sm" name="tax_type_id" type="number" id="tax_type_id" value="{{ isset($customerdebt->tax_type_id) ? $customerdebt->tax_type_id : ''}}" >
            {!! $errors->first('tax_type_id', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('completed_at') ? 'has-error' : ''}}">
            <label for="completed_at" class="control-label">{{ 'วันครบกำหนด' }}</label>
            <input class="form-control form-control-sm" name="completed_at" type="date" id="completed_at" value="{{ isset($customerdebt->completed_at) ? $customerdebt->completed_at : ''}}" >
            {!! $errors->first('completed_at', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
</div>



<div class="row">
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('tax_category') ? 'has-error' : ''}}">
            <label for="tax_category" class="control-label">{{ 'ภาระภาษี' }}</label>
            <input class="form-control form-control-sm" name="tax_category" type="text" id="tax_category" value="{{ isset($customerdebt->tax_category) ? $customerdebt->tax_category : ''}}" >
            {!! $errors->first('tax_category', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
  <div class="col-sm-6">
        <div class="form-group {{ $errors->has('round') ? 'has-error' : ''}}">
            <label for="round" class="control-label">{{ 'ยื่นภาษีในงวด' }}</label>
            <input class="form-control form-control-sm" name="round" type="text" id="round" value="{{ isset($customerdebt->round) ? $customerdebt->round : ''}}" >
            {!! $errors->first('round', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
</div>


<hr>


<div class="row">
  
  <div class="col-sm-8">

  </div>
  
  <div class="col-sm-4">
        <div class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : ''}}">
            <label for="total_before_vat" class="control-label">{{ 'ยอดหนี้ก่อนภาษี' }}</label>
            <input class="form-control form-control-sm" name="total_before_vat" type="number" id="total_before_vat" value="{{ isset($customerdebt->total_before_vat) ? $customerdebt->total_before_vat : ''}}" >
            {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
</div>



<div class="row">
  
  <div class="col-sm-4">

  </div>
  
  <div class="col-sm-4">
        <div class="form-group {{ $errors->has('vat_percent') ? 'has-error' : ''}}">
            <label for="vat_percent" class="control-label">{{ 'อัตราภาษี' }}</label>
            <input class="form-control form-control-sm" name="vat_percent" type="number" id="vat_percent" value="{{ isset($customerdebt->vat_percent) ? $customerdebt->vat_percent : ''}}" >
            {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!}
        </div>

  </div>

    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('vat') ? 'has-error' : ''}}">
            <label for="vat" class="control-label">{{ 'มูลค่าภาษี' }}</label>
            <input class="form-control form-control-sm" name="vat" type="number" id="vat" value="{{ isset($customerdebt->vat) ? $customerdebt->vat : ''}}" >
            {!! $errors->first('vat', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
</div>



<div class="row">
  
  <div class="col-sm-8">

  </div>
  
  <div class="col-sm-4">
        <div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
            <label for="total" class="control-label">{{ 'ยอดหนี้สุทธิ' }}</label>
            <input class="form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($customerdebt->total) ? $customerdebt->total : ''}}" >
            {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
        </div>

  </div>
  
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
