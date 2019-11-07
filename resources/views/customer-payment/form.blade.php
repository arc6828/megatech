<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'Doc No' }}</label>
    <input class="form-control" name="doc_no" type="text" id="doc_no" value="{{ isset($customerpayment->doc_no) ? $customerpayment->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ isset($customerpayment->customer_id) ? $customerpayment->customer_id : ''}}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
    <input class="form-control" name="role" type="text" id="role" value="{{ isset($customerpayment->role) ? $customerpayment->role : ''}}" >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($customerpayment->remark) ? $customerpayment->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('round') ? 'has-error' : ''}}">
    <label for="round" class="control-label">{{ 'Round' }}</label>
    <input class="form-control" name="round" type="text" id="round" value="{{ isset($customerpayment->round) ? $customerpayment->round : ''}}" >
    {!! $errors->first('round', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_billing_id') ? 'has-error' : ''}}">
    <label for="customer_billing_id" class="control-label">{{ 'Customer Billing Id' }}</label>
    <input class="form-control" name="customer_billing_id" type="number" id="customer_billing_id" value="{{ isset($customerpayment->customer_billing_id) ? $customerpayment->customer_billing_id : ''}}" >
    {!! $errors->first('customer_billing_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'Discount' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" value="{{ isset($customerpayment->discount) ? $customerpayment->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('debt_total') ? 'has-error' : ''}}">
    <label for="debt_total" class="control-label">{{ 'Debt Total' }}</label>
    <input class="form-control" name="debt_total" type="number" id="debt_total" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : ''}}" >
    {!! $errors->first('debt_total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cash') ? 'has-error' : ''}}">
    <label for="cash" class="control-label">{{ 'Cash' }}</label>
    <input class="form-control" name="cash" type="number" id="cash" value="{{ isset($customerpayment->cash) ? $customerpayment->cash : ''}}" >
    {!! $errors->first('cash', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('credit') ? 'has-error' : ''}}">
    <label for="credit" class="control-label">{{ 'Credit' }}</label>
    <input class="form-control" name="credit" type="number" id="credit" value="{{ isset($customerpayment->credit) ? $customerpayment->credit : ''}}" >
    {!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    <label for="tax" class="control-label">{{ 'Tax' }}</label>
    <input class="form-control" name="tax" type="number" id="tax" value="{{ isset($customerpayment->tax) ? $customerpayment->tax : ''}}" >
    {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_total') ? 'has-error' : ''}}">
    <label for="payment_total" class="control-label">{{ 'Payment Total' }}</label>
    <input class="form-control" name="payment_total" type="number" id="payment_total" value="{{ isset($customerpayment->payment_total) ? $customerpayment->payment_total : ''}}" >
    {!! $errors->first('payment_total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($customerpayment->user_id) ? $customerpayment->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
