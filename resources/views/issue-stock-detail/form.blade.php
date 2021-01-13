<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($issuestockdetail->product_id) ? $issuestockdetail->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($issuestockdetail->amount) ? $issuestockdetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_price') ? 'has-error' : ''}}">
    <label for="discount_price" class="control-label">{{ 'Discount Price' }}</label>
    <input class="form-control" name="discount_price" type="number" id="discount_price" value="{{ isset($issuestockdetail->discount_price) ? $issuestockdetail->discount_price : ''}}" >
    {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($issuestockdetail->total) ? $issuestockdetail->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('issue_stock_id') ? 'has-error' : ''}}">
    <label for="issue_stock_id" class="control-label">{{ 'Issue Stock Id' }}</label>
    <input class="form-control" name="issue_stock_id" type="number" id="issue_stock_id" value="{{ isset($issuestockdetail->issue_stock_id) ? $issuestockdetail->issue_stock_id : ''}}" >
    {!! $errors->first('issue_stock_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
