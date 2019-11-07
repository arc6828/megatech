<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'Doc No' }}</label>
    <input class="form-control" name="doc_no" type="text" id="doc_no" value="{{ isset($customerbilling->doc_no) ? $customerbilling->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($customerbilling->total) ? $customerbilling->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ isset($customerbilling->customer_id) ? $customerbilling->customer_id : ''}}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition_billing') ? 'has-error' : ''}}">
    <label for="condition_billing" class="control-label">{{ 'Condition Billing' }}</label>
    <input class="form-control" name="condition_billing" type="text" id="condition_billing" value="{{ isset($customerbilling->condition_billing) ? $customerbilling->condition_billing : ''}}" >
    {!! $errors->first('condition_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition_cheque') ? 'has-error' : ''}}">
    <label for="condition_cheque" class="control-label">{{ 'Condition Cheque' }}</label>
    <input class="form-control" name="condition_cheque" type="text" id="condition_cheque" value="{{ isset($customerbilling->condition_cheque) ? $customerbilling->condition_cheque : ''}}" >
    {!! $errors->first('condition_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_billing') ? 'has-error' : ''}}">
    <label for="date_billing" class="control-label">{{ 'Date Billing' }}</label>
    <input class="form-control" name="date_billing" type="date" id="date_billing" value="{{ isset($customerbilling->date_billing) ? $customerbilling->date_billing : ''}}" >
    {!! $errors->first('date_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_cheque') ? 'has-error' : ''}}">
    <label for="date_cheque" class="control-label">{{ 'Date Cheque' }}</label>
    <input class="form-control" name="date_cheque" type="date" id="date_cheque" value="{{ isset($customerbilling->date_cheque) ? $customerbilling->date_cheque : ''}}" >
    {!! $errors->first('date_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($customerbilling->remark) ? $customerbilling->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($customerbilling->user_id) ? $customerbilling->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
