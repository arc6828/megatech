<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($gaurdstock->code) ? $gaurdstock->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{ isset($gaurdstock->type) ? $gaurdstock->type : ''}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($gaurdstock->amount) ? $gaurdstock->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount_in_stock') ? 'has-error' : ''}}">
    <label for="amount_in_stock" class="control-label">{{ 'Amount In Stock' }}</label>
    <input class="form-control" name="amount_in_stock" type="number" id="amount_in_stock" value="{{ isset($gaurdstock->amount_in_stock) ? $gaurdstock->amount_in_stock : ''}}" >
    {!! $errors->first('amount_in_stock', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pending_in') ? 'has-error' : ''}}">
    <label for="pending_in" class="control-label">{{ 'Pending In' }}</label>
    <input class="form-control" name="pending_in" type="number" id="pending_in" value="{{ isset($gaurdstock->pending_in) ? $gaurdstock->pending_in : ''}}" >
    {!! $errors->first('pending_in', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pending_out') ? 'has-error' : ''}}">
    <label for="pending_out" class="control-label">{{ 'Pending Out' }}</label>
    <input class="form-control" name="pending_out" type="number" id="pending_out" value="{{ isset($gaurdstock->pending_out) ? $gaurdstock->pending_out : ''}}" >
    {!! $errors->first('pending_out', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($gaurdstock->product_id) ? $gaurdstock->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($gaurdstock->remark) ? $gaurdstock->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
