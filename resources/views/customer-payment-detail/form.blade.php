<div class="form-group {{ $errors->has('doc_id') ? 'has-error' : ''}}">
    <label for="doc_id" class="control-label">{{ 'Doc Id' }}</label>
    <input class="form-control" name="doc_id" type="text" id="doc_id" value="{{ isset($customerpaymentdetail->doc_id) ? $customerpaymentdetail->doc_id : ''}}" >
    {!! $errors->first('doc_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_billing_id') ? 'has-error' : ''}}">
    <label for="customer_billing_id" class="control-label">{{ 'Customer Billing Id' }}</label>
    <input class="form-control" name="customer_billing_id" type="number" id="customer_billing_id" value="{{ isset($customerpaymentdetail->customer_billing_id) ? $customerpaymentdetail->customer_billing_id : ''}}" >
    {!! $errors->first('customer_billing_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
