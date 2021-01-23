<div class="form-group {{ $errors->has('billing_invoice') ? 'has-error' : ''}}">
    <label for="billing_invoice" class="control-label">{{ 'Billing Invoice' }}</label>
    <input class="form-control form-control-sm" name="billing_invoice" type="text" id="billing_invoice" value="{{ isset($checklist->billing_invoice) ? $checklist->billing_invoice : ''}}" >
    {!! $errors->first('billing_invoice', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('billing_po') ? 'has-error' : ''}}">
    <label for="billing_po" class="control-label">{{ 'Billing Po' }}</label>
    <input class="form-control form-control-sm" name="billing_po" type="text" id="billing_po" value="{{ isset($checklist->billing_po) ? $checklist->billing_po : ''}}" >
    {!! $errors->first('billing_po', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('billing_receipt') ? 'has-error' : ''}}">
    <label for="billing_receipt" class="control-label">{{ 'Billing Receipt' }}</label>
    <input class="form-control form-control-sm" name="billing_receipt" type="text" id="billing_receipt" value="{{ isset($checklist->billing_receipt) ? $checklist->billing_receipt : ''}}" >
    {!! $errors->first('billing_receipt', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('billing_envelope') ? 'has-error' : ''}}">
    <label for="billing_envelope" class="control-label">{{ 'Billing Envelope' }}</label>
    <input class="form-control form-control-sm" name="billing_envelope" type="text" id="billing_envelope" value="{{ isset($checklist->billing_envelope) ? $checklist->billing_envelope : ''}}" >
    {!! $errors->first('billing_envelope', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('billing_delivery') ? 'has-error' : ''}}">
    <label for="billing_delivery" class="control-label">{{ 'Billing Delivery' }}</label>
    <input class="form-control form-control-sm" name="billing_delivery" type="text" id="billing_delivery" value="{{ isset($checklist->billing_delivery) ? $checklist->billing_delivery : ''}}" >
    {!! $errors->first('billing_delivery', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('billing_reference') ? 'has-error' : ''}}">
    <label for="billing_reference" class="control-label">{{ 'Billing Reference' }}</label>
    <input class="form-control form-control-sm" name="billing_reference" type="text" id="billing_reference" value="{{ isset($checklist->billing_reference) ? $checklist->billing_reference : ''}}" >
    {!! $errors->first('billing_reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_billing') ? 'has-error' : ''}}">
    <label for="cheque_billing" class="control-label">{{ 'Cheque Billing' }}</label>
    <input class="form-control form-control-sm" name="cheque_billing" type="text" id="cheque_billing" value="{{ isset($checklist->cheque_billing) ? $checklist->cheque_billing : ''}}" >
    {!! $errors->first('cheque_billing', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_receipt') ? 'has-error' : ''}}">
    <label for="cheque_receipt" class="control-label">{{ 'Cheque Receipt' }}</label>
    <input class="form-control form-control-sm" name="cheque_receipt" type="text" id="cheque_receipt" value="{{ isset($checklist->cheque_receipt) ? $checklist->cheque_receipt : ''}}" >
    {!! $errors->first('cheque_receipt', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_po') ? 'has-error' : ''}}">
    <label for="cheque_po" class="control-label">{{ 'Cheque Po' }}</label>
    <input class="form-control form-control-sm" name="cheque_po" type="text" id="cheque_po" value="{{ isset($checklist->cheque_po) ? $checklist->cheque_po : ''}}" >
    {!! $errors->first('cheque_po', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control form-control-sm" name="type" type="text" id="type" value="{{ isset($checklist->type) ? $checklist->type : ''}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control form-control-sm" name="customer_id" type="text" id="customer_id" value="{{ isset($checklist->customer_id) ? $checklist->customer_id : ''}}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control form-control-sm" name="supplier_id" type="text" id="supplier_id" value="{{ isset($checklist->supplier_id) ? $checklist->supplier_id : ''}}" >
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
