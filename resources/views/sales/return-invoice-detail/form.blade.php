<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($returninvoicedetail->product_id) ? $returninvoicedetail->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($returninvoicedetail->amount) ? $returninvoicedetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_price') ? 'has-error' : ''}}">
    <label for="discount_price" class="control-label">{{ 'Discount Price' }}</label>
    <input class="form-control" name="discount_price" type="number" id="discount_price" value="{{ isset($returninvoicedetail->discount_price) ? $returninvoicedetail->discount_price : ''}}" >
    {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($returninvoicedetail->total) ? $returninvoicedetail->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('return_invoice_id') ? 'has-error' : ''}}">
    <label for="return_invoice_id" class="control-label">{{ 'Return Invoice Id' }}</label>
    <input class="form-control" name="return_invoice_id" type="number" id="return_invoice_id" value="{{ isset($returninvoicedetail->return_invoice_id) ? $returninvoicedetail->return_invoice_id : ''}}" >
    {!! $errors->first('return_invoice_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
