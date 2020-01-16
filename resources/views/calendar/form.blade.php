<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($calendar->title) ? $calendar->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('first_billing_date') ? 'has-error' : ''}}">
    <label for="first_billing_date" class="control-label">{{ 'First Billing Date' }}</label>
    <input class="form-control" name="first_billing_date" type="date" id="first_billing_date" value="{{ isset($calendar->first_billing_date) ? $calendar->first_billing_date : ''}}" >
    {!! $errors->first('first_billing_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ isset($calendar->customer_id) ? $calendar->customer_id : ''}}" >
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control" name="supplier_id" type="number" id="supplier_id" value="{{ isset($calendar->supplier_id) ? $calendar->supplier_id : ''}}" >
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
