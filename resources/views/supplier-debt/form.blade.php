<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'Doc No' }}</label>
    <input class="form-control" name="doc_no" type="text" id="doc_no" value="{{ isset($supplierdebt->doc_no) ? $supplierdebt->doc_no : ''}}" >
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($supplierdebt->date) ? $supplierdebt->date : ''}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control" name="supplier_id" type="number" id="supplier_id" value="{{ isset($supplierdebt->supplier_id) ? $supplierdebt->supplier_id : ''}}" >
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'Discount' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" value="{{ isset($supplierdebt->discount) ? $supplierdebt->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($supplierdebt->amount) ? $supplierdebt->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat_percent') ? 'has-error' : ''}}">
    <label for="vat_percent" class="control-label">{{ 'Vat Percent' }}</label>
    <input class="form-control" name="vat_percent" type="number" id="vat_percent" value="{{ isset($supplierdebt->vat_percent) ? $supplierdebt->vat_percent : ''}}" >
    {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat') ? 'has-error' : ''}}">
    <label for="vat" class="control-label">{{ 'Vat' }}</label>
    <input class="form-control" name="vat" type="number" id="vat" value="{{ isset($supplierdebt->vat) ? $supplierdebt->vat : ''}}" >
    {!! $errors->first('vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : ''}}">
    <label for="total_before_vat" class="control-label">{{ 'Total Before Vat' }}</label>
    <input class="form-control" name="total_before_vat" type="number" id="total_before_vat" value="{{ isset($supplierdebt->total_before_vat) ? $supplierdebt->total_before_vat : ''}}" >
    {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($supplierdebt->total) ? $supplierdebt->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax_type_id') ? 'has-error' : ''}}">
    <label for="tax_type_id" class="control-label">{{ 'Tax Type Id' }}</label>
    <input class="form-control" name="tax_type_id" type="number" id="tax_type_id" value="{{ isset($supplierdebt->tax_type_id) ? $supplierdebt->tax_type_id : ''}}" >
    {!! $errors->first('tax_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('completed_at') ? 'has-error' : ''}}">
    <label for="completed_at" class="control-label">{{ 'Completed At' }}</label>
    <input class="form-control" name="completed_at" type="date" id="completed_at" value="{{ isset($supplierdebt->completed_at) ? $supplierdebt->completed_at : ''}}" >
    {!! $errors->first('completed_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax_category') ? 'has-error' : ''}}">
    <label for="tax_category" class="control-label">{{ 'Tax Category' }}</label>
    <input class="form-control" name="tax_category" type="text" id="tax_category" value="{{ isset($supplierdebt->tax_category) ? $supplierdebt->tax_category : ''}}" >
    {!! $errors->first('tax_category', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('round') ? 'has-error' : ''}}">
    <label for="round" class="control-label">{{ 'Round' }}</label>
    <input class="form-control" name="round" type="text" id="round" value="{{ isset($supplierdebt->round) ? $supplierdebt->round : ''}}" >
    {!! $errors->first('round', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_debt') ? 'has-error' : ''}}">
    <label for="type_debt" class="control-label">{{ 'Type Debt' }}</label>
    <input class="form-control" name="type_debt" type="text" id="type_debt" value="{{ isset($supplierdebt->type_debt) ? $supplierdebt->type_debt : ''}}" >
    {!! $errors->first('type_debt', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('debt_duration') ? 'has-error' : ''}}">
    <label for="debt_duration" class="control-label">{{ 'Debt Duration' }}</label>
    <input class="form-control" name="debt_duration" type="text" id="debt_duration" value="{{ isset($supplierdebt->debt_duration) ? $supplierdebt->debt_duration : ''}}" >
    {!! $errors->first('debt_duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($supplierdebt->user_id) ? $supplierdebt->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
    <input class="form-control" name="role" type="text" id="role" value="{{ isset($supplierdebt->role) ? $supplierdebt->role : ''}}" >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="control-label">{{ 'Reference' }}</label>
    <input class="form-control" name="reference" type="text" id="reference" value="{{ isset($supplierdebt->reference) ? $supplierdebt->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zone_id') ? 'has-error' : ''}}">
    <label for="zone_id" class="control-label">{{ 'Zone Id' }}</label>
    <input class="form-control" name="zone_id" type="number" id="zone_id" value="{{ isset($supplierdebt->zone_id) ? $supplierdebt->zone_id : ''}}" >
    {!! $errors->first('zone_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_id') ? 'has-error' : ''}}">
    <label for="cheque_id" class="control-label">{{ 'Cheque Id' }}</label>
    <input class="form-control" name="cheque_id" type="number" id="cheque_id" value="{{ isset($supplierdebt->cheque_id) ? $supplierdebt->cheque_id : ''}}" >
    {!! $errors->first('cheque_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
    <label for="payment_method" class="control-label">{{ 'Payment Method' }}</label>
    <input class="form-control" name="payment_method" type="number" id="payment_method" value="{{ isset($supplierdebt->payment_method) ? $supplierdebt->payment_method : ''}}" >
    {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
