<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($contact->name) ? $contact->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('department') ? 'has-error' : ''}}">
    <label for="department" class="control-label">{{ 'Department' }}</label>
    <input class="form-control" name="department" type="text" id="department" value="{{ isset($contact->department) ? $contact->department : ''}}" >
    {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($contact->email) ? $contact->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($contact->phone) ? $contact->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contact_type') ? 'has-error' : ''}}">
    <label for="contact_type" class="control-label">{{ 'Contact Type' }}</label>
    <select name="contact_type" class="form-control" id="contact_type" >
    @foreach (json_decode('{"customer":"Customer","supplier":"Supplier"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($contact->contact_type) && $contact->contact_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('contact_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control" name="customer_id" type="text" id="customer_id" value="{{ isset($contact->customer_id) ? $contact->customer_id : request('customer_id') }}"  readonly>
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control" name="supplier_id" type="text" id="supplier_id" value="{{ isset($contact->supplier_id) ? $contact->supplier_id : ''}}" readonly>
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
