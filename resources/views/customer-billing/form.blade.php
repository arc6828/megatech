<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($customerbilling->doc_no) ? $customerbilling->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    @php
        $total = count($table_invoice) > 0 ? $table_invoice->sum('total_debt') : 0;
    @endphp
    <label for="total" class="control-label">{{ 'ยอดเงินรวม' }}</label>
    <input class="form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($customerbilling->total) ? $customerbilling->total : $total }}" readonly >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
@php
    $customer_id = $customer ? $customer->customer_id : '';
    $customer_name = $customer ? $customer->customer_code." ".$customer->company_name : '';
    $condition_billing = $customer ? $customer->billing_duration : '';
    $condition_cheque = $customer ? $customer->cheque_condition : '';
    $date_billing = $customer ? $customer->date_billing : '';
    $date_cheque = $customer ? $customer->date_cheque : '';
@endphp
<div class="form-group d-none {{ $errors->has('customer_id') ? 'has-error' : ''}}">  
    <label for="customer_id" class="control-label">{{ 'รหัสลูกค้า' }}</label> 
    <input class="form-control form-control-sm" name="customer_id" type="number" id="customer_id" value="{{ isset($customerbilling->customer_id) ? $customerbilling->customer_id : $customer_id }}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">    
    <label for="customer_id" class="control-label">{{ 'รหัสลูกค้า' }}</label> <a href="{{ url('/customer') }}" class="btn btn-sm btn-light">เลือกลูกค้า</a>
    <input class="form-control form-control-sm"  value="{{ isset($customerbilling->customer_id) ? $customerbilling->customer_id : $customer_name  }}" disabled>
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition_billing') ? 'has-error' : ''}}">
    <label for="condition_billing" class="control-label">{{ 'เงื่อนไขการวางบิล' }}</label>
    <input class="form-control form-control-sm" name="condition_billing" type="text" id="condition_billing" value="{{ isset($customerbilling->condition_billing) ? $customerbilling->condition_billing : $condition_billing}}" >
    {!! $errors->first('condition_billing', '<p class="help-block">:message</p>') !!}
</div>
<div>

</div>
<div class="form-group {{ $errors->has('condition_cheque') ? 'has-error' : ''}}">
    <label for="condition_cheque" class="control-label">{{ 'เงื่อนไขรับเช็ค' }}</label>
    <input class="form-control form-control-sm" name="condition_cheque" type="text" id="condition_cheque" value="{{ isset($customerbilling->condition_cheque) ? $customerbilling->condition_cheque : $condition_cheque}}" >
    {!! $errors->first('condition_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_billing') ? 'has-error' : ''}}">
    <label for="date_billing" class="control-label">{{ 'วันที่ไปวางบิล' }}</label>
    <input class="form-control form-control-sm" name="date_billing" type="date" id="date_billing" value="{{ isset($customerbilling->date_billing) ? $customerbilling->date_billing : ''}}" >
    {!! $errors->first('date_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_cheque') ? 'has-error' : ''}}">
    <label for="date_cheque" class="control-label">{{ 'วันนัดรับเช็ค' }}</label>
    <input class="form-control form-control-sm" name="date_cheque" type="date" id="date_cheque" value="{{ isset($customerbilling->date_cheque) ? $customerbilling->date_cheque : ''}}" >
    {!! $errors->first('date_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($customerbilling->remark) ? $customerbilling->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none  {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงาน' }}</label>
    <input class="form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($customerbilling->user_id) ? $customerbilling->user_id : Auth::id() }}"  readonly>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงาน' }}</label>
    <input class="form-control form-control-sm" value="{{ isset($customerbilling->user_id) ? $customerbilling->user_id : Auth::user()->name }}" disabled >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
