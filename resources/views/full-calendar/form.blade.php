<div class="row"> 
    <div class="col form-group {{ $errors->has('title') ? 'has-error' : ''}}">
        <label for="title" class="control-label">{{ 'Title' }}</label>
        <input class="form-control form-control-sm" name="title" type="text" id="title" value="{{ isset($fullcalendar->title) ? $fullcalendar->title : ''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name' }}</label>
        <select name="name" class="form-control form-control-sm" id="name" >
        @foreach (json_decode('{"billing":"billing","cheque":"cheque"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($fullcalendar->name) && $fullcalendar->name == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
        </select>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    
</div>
<div class="row"> 
    <div class="col form-group {{ $errors->has('start') ? 'has-error' : ''}}">
        <label for="start" class="control-label">{{ 'Start' }}</label>
        <input class="form-control form-control-sm" name="start" type="date" id="start" value="{{ isset($fullcalendar->start) ? $fullcalendar->start : ''}}" >
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col form-group {{ $errors->has('end') ? 'has-error' : ''}}">
        <label for="end" class="control-label">{{ 'End' }}</label>
        <input class="form-control form-control-sm" name="end" type="date" id="end" value="{{ isset($fullcalendar->end) ? $fullcalendar->end : ''}}" >
        {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row d-none"> 

    <div class="col form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
        <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
        <input class="form-control form-control-sm" name="customer_id" type="number" id="customer_id" value="{{ isset($fullcalendar->customer_id) ? $fullcalendar->customer_id : request('customer_id') }}" >
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
        <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
        <input class="form-control form-control-sm" name="supplier_id" type="number" id="supplier_id" value="{{ isset($fullcalendar->supplier_id) ? $fullcalendar->supplier_id : request('supplier_id')}}" >
        {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
