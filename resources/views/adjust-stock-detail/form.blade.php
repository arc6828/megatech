<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($adjuststockdetail->product_id) ? $adjuststockdetail->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($adjuststockdetail->amount) ? $adjuststockdetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_price') ? 'has-error' : ''}}">
    <label for="discount_price" class="control-label">{{ 'Discount Price' }}</label>
    <input class="form-control" name="discount_price" type="number" id="discount_price" value="{{ isset($adjuststockdetail->discount_price) ? $adjuststockdetail->discount_price : ''}}" >
    {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($adjuststockdetail->total) ? $adjuststockdetail->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('adjust_id') ? 'has-error' : ''}}">
    <label for="adjust_id" class="control-label">{{ 'Adjust Id' }}</label>
    <input class="form-control" name="adjust_id" type="number" id="adjust_id" value="{{ isset($adjuststockdetail->adjust_id) ? $adjuststockdetail->adjust_id : ''}}" >
    {!! $errors->first('adjust_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
