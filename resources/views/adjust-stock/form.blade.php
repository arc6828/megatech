<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($adjuststock->code) ? $adjuststock->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="control-label">{{ 'Reference' }}</label>
    <input class="form-control" name="reference" type="text" id="reference" value="{{ isset($adjuststock->reference) ? $adjuststock->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('adjust_type') ? 'has-error' : ''}}">
    <label for="adjust_type" class="control-label">{{ 'Adjust Type' }}</label>
    <input class="form-control" name="adjust_type" type="number" id="adjust_type" value="{{ isset($adjuststock->adjust_type) ? $adjuststock->adjust_type : ''}}" >
    {!! $errors->first('adjust_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status Id' }}</label>
    <input class="form-control" name="status_id" type="number" id="status_id" value="{{ isset($adjuststock->status_id) ? $adjuststock->status_id : ''}}" >
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($adjuststock->user_id) ? $adjuststock->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('adjust_definition_id') ? 'has-error' : ''}}">
    <label for="adjust_definition_id" class="control-label">{{ 'Adjust Definition Id' }}</label>
    <input class="form-control" name="adjust_definition_id" type="number" id="adjust_definition_id" value="{{ isset($adjuststock->adjust_definition_id) ? $adjuststock->adjust_definition_id : ''}}" >
    {!! $errors->first('adjust_definition_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($adjuststock->remark) ? $adjuststock->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($adjuststock->total) ? $adjuststock->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('revision') ? 'has-error' : ''}}">
    <label for="revision" class="control-label">{{ 'Revision' }}</label>
    <input class="form-control" name="revision" type="number" id="revision" value="{{ isset($adjuststock->revision) ? $adjuststock->revision : ''}}" >
    {!! $errors->first('revision', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
