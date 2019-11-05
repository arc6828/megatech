2
<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="form-control" name="doc_no" type="text" id="doc_no" value="{{ isset($customerdebt->doc_no) ? $customerdebt->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'วันที่เอกสาร' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($customerdebt->date) ? $customerdebt->date : ''}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'รหัสลูกค้า' }}</label>
    <input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ isset($customerdebt->customer_id) ? $customerdebt->customer_id : ''}}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'ส่วนลด' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" value="{{ isset($customerdebt->discount) ? $customerdebt->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($customerdebt->amount) ? $customerdebt->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat_percent') ? 'has-error' : ''}}">
    <label for="vat_percent" class="control-label">{{ 'อัตราภาษี' }}</label>
    <input class="form-control" name="vat_percent" type="number" id="vat_percent" value="{{ isset($customerdebt->vat_percent) ? $customerdebt->vat_percent : ''}}" >
    {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat') ? 'has-error' : ''}}">
    <label for="vat" class="control-label">{{ 'มูลค่าภาษี' }}</label>
    <input class="form-control" name="vat" type="number" id="vat" value="{{ isset($customerdebt->vat) ? $customerdebt->vat : ''}}" >
    {!! $errors->first('vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : ''}}">
    <label for="total_before_vat" class="control-label">{{ 'ยอดหนี้ก่อนภาษี' }}</label>
    <input class="form-control" name="total_before_vat" type="number" id="total_before_vat" value="{{ isset($customerdebt->total_before_vat) ? $customerdebt->total_before_vat : ''}}" >
    {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'ยอดหนี้สุทธิ' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($customerdebt->total) ? $customerdebt->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax_type_id') ? 'has-error' : ''}}">
    <label for="tax_type_id" class="control-label">{{ 'ชนิดภาษี' }}</label>
    <input class="form-control" name="tax_type_id" type="number" id="tax_type_id" value="{{ isset($customerdebt->tax_type_id) ? $customerdebt->tax_type_id : ''}}" >
    {!! $errors->first('tax_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('completed_at') ? 'has-error' : ''}}">
    <label for="completed_at" class="control-label">{{ 'วันครบกำหนด' }}</label>
    <input class="form-control" name="completed_at" type="date" id="completed_at" value="{{ isset($customerdebt->completed_at) ? $customerdebt->completed_at : ''}}" >
    {!! $errors->first('completed_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax_category') ? 'has-error' : ''}}">
    <label for="tax_category" class="control-label">{{ 'ภาระภาษี' }}</label>
    <input class="form-control" name="tax_category" type="text" id="tax_category" value="{{ isset($customerdebt->tax_category) ? $customerdebt->tax_category : ''}}" >
    {!! $errors->first('tax_category', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('round') ? 'has-error' : ''}}">
    <label for="round" class="control-label">{{ 'ยื่นภาษีในงวด' }}</label>
    <input class="form-control" name="round" type="text" id="round" value="{{ isset($customerdebt->round) ? $customerdebt->round : ''}}" >
    {!! $errors->first('round', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_debt') ? 'has-error' : ''}}">
    <label for="type_debt" class="control-label">{{ 'ประเภทหนี้' }}</label>
    <input class="form-control" name="type_debt" type="text" id="type_debt" value="{{ isset($customerdebt->type_debt) ? $customerdebt->type_debt : ''}}" >
    {!! $errors->first('type_debt', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('debt_duration') ? 'has-error' : ''}}">
    <label for="debt_duration" class="control-label">{{ 'ระยะเวลาหนี้' }}</label>
    <input class="form-control" name="debt_duration" type="text" id="debt_duration" value="{{ isset($customerdebt->debt_duration) ? $customerdebt->debt_duration : ''}}" >
    {!! $errors->first('debt_duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงานขาย' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($customerdebt->user_id) ? $customerdebt->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'รหัสแผนก' }}</label>
    <input class="form-control" name="role" type="text" id="role" value="{{ isset($customerdebt->role) ? $customerdebt->role : ''}}" >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="control-label">{{ 'เลขที่อ้างอิง' }}</label>
    <input class="form-control" name="reference" type="text" id="reference" value="{{ isset($customerdebt->reference) ? $customerdebt->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zone_id') ? 'has-error' : ''}}">
    <label for="zone_id" class="control-label">{{ 'เขตการขาย' }}</label>
    <input class="form-control" name="zone_id" type="number" id="zone_id" value="{{ isset($customerdebt->zone_id) ? $customerdebt->zone_id : ''}}" >
    {!! $errors->first('zone_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_id') ? 'has-error' : ''}}">
    <label for="cheque_id" class="control-label">{{ 'เลขที่เช็ค' }}</label>
    <input class="form-control" name="cheque_id" type="number" id="cheque_id" value="{{ isset($customerdebt->cheque_id) ? $customerdebt->cheque_id : ''}}" >
    {!! $errors->first('cheque_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
    <label for="payment_method" class="control-label">{{ 'วิธีชำระเงิน' }}</label>
    <input class="form-control" name="payment_method" type="number" id="payment_method" value="{{ isset($customerdebt->payment_method) ? $customerdebt->payment_method : ''}}" >
    {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
