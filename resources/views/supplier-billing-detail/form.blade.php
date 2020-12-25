<div class="form-group {{ $errors->has('doc_id') ? 'has-error' : ''}}">
    <label for="doc_id" class="control-label">{{ 'Doc Id' }}</label>
    <input class="form-control" name="doc_id" type="text" id="doc_id" value="{{ isset($supplierbillingdetail->doc_id) ? $supplierbillingdetail->doc_id : ''}}" >
    {!! $errors->first('doc_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_billing_id') ? 'has-error' : ''}}">
    <label for="supplier_billing_id" class="control-label">{{ 'Supplier Billing Id' }}</label>
    <input class="form-control" name="supplier_billing_id" type="number" id="supplier_billing_id" value="{{ isset($supplierbillingdetail->supplier_billing_id) ? $supplierbillingdetail->supplier_billing_id : ''}}" >
    {!! $errors->first('supplier_billing_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
