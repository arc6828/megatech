<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($receivefinaldetail->product_id) ? $receivefinaldetail->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($receivefinaldetail->amount) ? $receivefinaldetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_price') ? 'has-error' : ''}}">
    <label for="discount_price" class="control-label">{{ 'Discount Price' }}</label>
    <input class="form-control" name="discount_price" type="number" id="discount_price" value="{{ isset($receivefinaldetail->discount_price) ? $receivefinaldetail->discount_price : ''}}" >
    {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($receivefinaldetail->total) ? $receivefinaldetail->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('receive_final_id') ? 'has-error' : ''}}">
    <label for="receive_final_id" class="control-label">{{ 'Receive Final Id' }}</label>
    <input class="form-control" name="receive_final_id" type="number" id="receive_final_id" value="{{ isset($receivefinaldetail->receive_final_id) ? $receivefinaldetail->receive_final_id : ''}}" >
    {!! $errors->first('receive_final_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
