<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($supplierbilling->doc_no) ? $supplierbilling->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    @php
        $total = count($table_receive) > 0 ? $table_receive->sum('total_debt') : 0;
    @endphp
    <label for="total" class="control-label">{{ 'ยอดเงินรวม' }}</label>
    <input class="form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($supplierbilling->total) ? $supplierbilling->total : $total }}" readonly >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
@php
    $supplier_id = $supplier ? $supplier->supplier_id : '';
    $supplier_name = $supplier ? $supplier->supplier_code." ".$supplier->company_name : '';
    $condition_billing = $supplier ? $supplier->billing_duration : '';
    $condition_cheque = $supplier ? $supplier->cheque_condition : '';
    $date_billing = $supplier ? $supplier->date_billing : '';
    $date_cheque = $supplier ? $supplier->date_cheque : '';
@endphp
<div class="form-group d-none {{ $errors->has('supplier_id') ? 'has-error' : ''}}">  
    <label for="supplier_id" class="control-label">{{ 'รหัสเจ้าหนี้' }}</label> 
    <input class="form-control form-control-sm" name="supplier_id" type="number" id="supplier_id" value="{{ isset($supplierbilling->supplier_id) ? $supplierbilling->supplier_id : $supplier_id }}" >
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">    
    <label for="supplier_id" class="control-label">{{ 'รหัสเจ้าหนี้' }}</label> <a href="{{ url('/supplier') }}" class="btn btn-sm btn-light">เลือกเจ้าหนี้</a>
    <input class="form-control form-control-sm"  value="{{ isset($supplierbilling->supplier_id) ? $supplierbilling->supplier_id : $supplier_name  }}" disabled>
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition_billing') ? 'has-error' : ''}}">
    <label for="condition_billing" class="control-label">{{ 'เงื่อนไขการวางบิล' }}</label>
    <input class="form-control form-control-sm" name="condition_billing" type="text" id="condition_billing" value="{{ isset($supplierbilling->condition_billing) ? $supplierbilling->condition_billing : $condition_billing}}" >
    {!! $errors->first('condition_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition_cheque') ? 'has-error' : ''}}">
    <label for="condition_cheque" class="control-label">{{ 'เงื่อนไขรับเช็ค' }}</label>
    <input class="form-control form-control-sm" name="condition_cheque" type="text" id="condition_cheque" value="{{ isset($supplierbilling->condition_cheque) ? $supplierbilling->condition_cheque : $condition_cheque}}" >
    {!! $errors->first('condition_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_billing') ? 'has-error' : ''}}">
    <label for="date_billing" class="control-label">{{ 'วันที่ไปวางบิล' }}</label>
    <input class="form-control form-control-sm" name="date_billing" type="date" id="date_billing" value="{{ isset($supplierbilling->date_billing) ? $supplierbilling->date_billing : ''}}" >
    {!! $errors->first('date_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_cheque') ? 'has-error' : ''}}">
    <label for="date_cheque" class="control-label">{{ 'วันนัดรับเช็ค' }}</label>
    <input class="form-control form-control-sm" name="date_cheque" type="date" id="date_cheque" value="{{ isset($supplierbilling->date_cheque) ? $supplierbilling->date_cheque : ''}}" >
    {!! $errors->first('date_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($supplierbilling->remark) ? $supplierbilling->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none  {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงาน' }}</label>
    <input class="form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($supplierbilling->user_id) ? $supplierbilling->user_id : Auth::id() }}"  readonly>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'รหัสพนักงาน' }}</label>
    <input class="form-control form-control-sm" value="{{ isset($supplierbilling->user_id) ? $supplierbilling->user_id : Auth::user()->name }}" disabled >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
