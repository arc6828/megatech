<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($customerpayment->doc_no) ? $customerpayment->doc_no : ''}}" readonly>
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
@php
    $customer_id = $customer ? $customer->customer_id : '';
    $customer_name = $customer ? $customer->customer_code." ".$customer->company_name : '';
    $customer_billing_id = '';
    $customer_billing_doc_no = '';
    $customer_billing_total = $invoices ? $invoices->sum('total_debt') : '';
    
@endphp
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'รหัสลูกค้า' }}</label> <a href="{{ url('/customer') }}" class="btn btn-sm btn-light">เลือกลูกค้า</a>
    <input class="form-control form-control-sm d-none" name="customer_id" type="number" id="customer_id" value="{{ isset($customerpayment->customer_id) ? $customerpayment->customer_id : $customer_id}}" >
    <input class="form-control form-control-sm"  value="{{ isset($customerpayment->customer_id) ? $customerpayment->customer_id : $customer_name}}" disabled>
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'รหัสแผนก' }}</label>
    <input class="form-control form-control-sm" name="role" type="text" id="role" value="{{ isset($customerpayment->role) ? $customerpayment->role : Auth::user()->role }}" readonly>
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($customerpayment->remark) ? $customerpayment->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('round') ? 'has-error' : ''}}">
    <label for="round" class="control-label">{{ 'ยื่นภาษีในงวด' }}</label>
    <input class="form-control form-control-sm" name="round" type="text" id="round" value="{{ isset($customerpayment->round) ? $customerpayment->round : ''}}" >
    {!! $errors->first('round', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_billing_id') ? 'has-error' : ''}}">
    <label for="customer_billing_id" class="control-label">{{ 'เลขที่ใบวางบิล' }}</label>
    <input class="form-control form-control-sm d-none" name="customer_billing_id" type="number" id="customer_billing_id" value="{{ isset($customerpayment->customer_billing_id) ? $customerpayment->customer_billing_id : $customer_billing_id }}" >
    <input class="form-control form-control-sm" value="{{ isset($customerpayment->customer_billing_id) ? $customerpayment->customer_billing_id : $customer_billing_doc_no }}" disabled>
    {!! $errors->first('customer_billing_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'ส่วนลด ณ รับชำระ' }}</label>
    <input class="form-control form-control-sm" name="discount" type="number" id="discount" value="{{ isset($customerpayment->discount) ? $customerpayment->discount : ''}}" readonly>
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('debt_total') ? 'has-error' : ''}}">
    <label for="debt_total" class="control-label">{{ 'ยอดรวมหนี้' }}</label>
    <input class="form-control form-control-sm" name="debt_total" type="number" id="debt_total" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : $customer_billing_total }}" >
    {!! $errors->first('debt_total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cash') ? 'has-error' : ''}}">
    <label for="cash" class="control-label">{{ 'ยอดเงินสดรับ' }}</label>
    <input class="form-control form-control-sm" name="cash" type="number" id="cash" value="{{ isset($customerpayment->cash) ? $customerpayment->cash : ''}}" readonly >
    {!! $errors->first('cash', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('credit') ? 'has-error' : ''}}">
    <label for="credit" class="control-label">{{ 'ยอดเช็ครับ' }}</label>
    <input class="form-control form-control-sm" name="credit" type="number" id="credit" value="{{ isset($customerpayment->credit) ? $customerpayment->credit : ''}}" readonly>
    {!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('tax') ? 'has-error' : ''}}">
    <label for="tax" class="control-label">{{ 'ภาษี ณ  ที่จ่าย' }}</label>
    <input class="form-control form-control-sm" name="tax" type="number" id="tax" value="{{ isset($customerpayment->tax) ? $customerpayment->tax : ''}}" >
    {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_total') ? 'has-error' : ''}}">
    <label for="payment_total" class="control-label">{{ 'ยอดรวมรับชำระ' }}</label>
    <input class="form-control form-control-sm" name="payment_total" type="number" id="payment_total" value="{{ isset($customerpayment->payment_total) ? $customerpayment->payment_total : $customer_billing_total}}" >
    {!! $errors->first('payment_total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงาน' }}</label>
    <input class="form-control form-control-sm d-none" name="user_id" type="number" id="user_id" value="{{ isset($customerpayment->user_id) ? $customerpayment->user_id : Auth::id() }}" >
    <input class="form-control form-control-sm"  value="{{ isset($customerpayment->user_id) ? $customerpayment->user_id : Auth::user()->name }}" disabled>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<!--for cheque -->
<div class="form-group d-none {{ $errors->has('cheque_type_code') ? 'has-error' : ''}}">
    <label for="cheque_type_code" class="control-label">{{ 'Cheque Type Code' }}</label>
    <input class="form-control form-control-sm" name="cheque_type_code" type="text" id="cheque_type_code" value="{{ isset($cheque->cheque_type_code) ? $cheque->cheque_type_code :  'cheque-in' }}" readonly>
    {!! $errors->first('cheque_type_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cheque_date') ? 'has-error' : ''}}">
    <label for="cheque_date" class="control-label">{{ 'Cheque Date' }}</label>
    <input class="form-control form-control-sm" name="cheque_date" type="date" id="cheque_date" value="{{ isset($cheque->cheque_date) ? $cheque->cheque_date : ''}}" >
    {!! $errors->first('cheque_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cheque_no') ? 'has-error' : ''}}">
    <label for="cheque_no" class="control-label">{{ 'เลขที่เช็ค' }}</label>
    <input class="form-control form-control-sm" name="cheque_no" type="text" id="cheque_no" value="{{ isset($cheque->cheque_no) ? $cheque->cheque_no : ''}}" >
    {!! $errors->first('cheque_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('total_cheque') ? 'has-error' : ''}}">
    <label for="total_cheque" class="control-label">{{ 'ยอดเช็ครับ' }}</label>
    <input class="form-control form-control-sm" name="total_cheque" type="number" id="total_cheque" value="{{ isset($cheque->total_cheque) ? $cheque->total_cheque : ''}}" >
    {!! $errors->first('total_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="control-label">{{ 'รายละเอียดสาขา' }}</label>
    <input class="form-control form-control-sm" name="reference" type="text" id="reference" value="{{ isset($cheque->reference) ? $cheque->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control form-control-sm" name="status" type="text" id="status" value="{{ isset($cheque->status) ? $cheque->status : 'pending'}}"  readonly>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group d-none">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
