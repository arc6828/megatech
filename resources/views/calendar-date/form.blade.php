<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <select name="name" class="form-control" id="name" >
    @foreach (json_decode('{"billing":"billing","cheque":"cheque"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($calendardate->name) && $calendardate->name == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pin_date') ? 'has-error' : ''}}">
    <label for="pin_date" class="control-label">{{ 'Pin Date' }}</label>
    <input class="form-control" name="pin_date" type="date" id="pin_date" value="{{ isset($calendardate->pin_date) ? $calendardate->pin_date : ''}}" >
    {!! $errors->first('pin_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('calendar_id') ? 'has-error' : ''}}">
    <label for="calendar_id" class="control-label">{{ 'Calender Id' }}</label>
    <input class="form-control" name="calendar_id" type="number" id="calendar_id" value="{{ isset($calendardate->calendar_id) ? $calendardate->calendar_id : request('calendar_id') }}" readonly>
    {!! $errors->first('calendar_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
