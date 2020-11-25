<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($receivefinal->code) ? $receivefinal->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_code') ? 'has-error' : ''}}">
    <label for="is_code" class="control-label">{{ 'Is Code' }}</label>
    <input class="form-control" name="is_code" type="text" id="is_code" value="{{ isset($receivefinal->is_code) ? $receivefinal->is_code : ''}}" >
    {!! $errors->first('is_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status Id' }}</label>
    <input class="form-control" name="status_id" type="number" id="status_id" value="{{ isset($receivefinal->status_id) ? $receivefinal->status_id : ''}}" >
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($receivefinal->user_id) ? $receivefinal->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($receivefinal->remark) ? $receivefinal->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($receivefinal->total) ? $receivefinal->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('revision') ? 'has-error' : ''}}">
    <label for="revision" class="control-label">{{ 'Revision' }}</label>
    <input class="form-control" name="revision" type="number" id="revision" value="{{ isset($receivefinal->revision) ? $receivefinal->revision : ''}}" >
    {!! $errors->first('revision', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
