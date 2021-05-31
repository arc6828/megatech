<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <input class="form-control" name="product_id" type="number" id="product_id" value="{{ isset($pickingdetail->product_id) ? $pickingdetail->product_id : ''}}" >
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($pickingdetail->amount) ? $pickingdetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('approved_amount') ? 'has-error' : ''}}">
    <label for="approved_amount" class="control-label">{{ 'Approved Amount' }}</label>
    <input class="form-control" name="approved_amount" type="number" id="approved_amount" value="{{ isset($pickingdetail->approved_amount) ? $pickingdetail->approved_amount : ''}}" >
    {!! $errors->first('approved_amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('iv_amount') ? 'has-error' : ''}}">
    <label for="iv_amount" class="control-label">{{ 'Iv Amount' }}</label>
    <input class="form-control" name="iv_amount" type="number" id="iv_amount" value="{{ isset($pickingdetail->iv_amount) ? $pickingdetail->iv_amount : ''}}" >
    {!! $errors->first('iv_amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('before_approved_amount') ? 'has-error' : ''}}">
    <label for="before_approved_amount" class="control-label">{{ 'Before Approved Amount' }}</label>
    <input class="form-control" name="before_approved_amount" type="number" id="before_approved_amount" value="{{ isset($pickingdetail->before_approved_amount) ? $pickingdetail->before_approved_amount : ''}}" >
    {!! $errors->first('before_approved_amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_price') ? 'has-error' : ''}}">
    <label for="discount_price" class="control-label">{{ 'Discount Price' }}</label>
    <input class="form-control" name="discount_price" type="number" id="discount_price" value="{{ isset($pickingdetail->discount_price) ? $pickingdetail->discount_price : ''}}" >
    {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    <label for="order_id" class="control-label">{{ 'Order Id' }}</label>
    <input class="form-control" name="order_id" type="number" id="order_id" value="{{ isset($pickingdetail->order_id) ? $pickingdetail->order_id : ''}}" >
    {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order_detail_status_id') ? 'has-error' : ''}}">
    <label for="order_detail_status_id" class="control-label">{{ 'Order Detail Status Id' }}</label>
    <input class="form-control" name="order_detail_status_id" type="number" id="order_detail_status_id" value="{{ isset($pickingdetail->order_detail_status_id) ? $pickingdetail->order_detail_status_id : ''}}" >
    {!! $errors->first('order_detail_status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('invoice_code') ? 'has-error' : ''}}">
    <label for="invoice_code" class="control-label">{{ 'Invoice Code' }}</label>
    <input class="form-control" name="invoice_code" type="text" id="invoice_code" value="{{ isset($pickingdetail->invoice_code) ? $pickingdetail->invoice_code : ''}}" >
    {!! $errors->first('invoice_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('danger_price') ? 'has-error' : ''}}">
    <label for="danger_price" class="control-label">{{ 'Danger Price' }}</label>
    <input class="form-control" name="danger_price" type="number" id="danger_price" value="{{ isset($pickingdetail->danger_price) ? $pickingdetail->danger_price : ''}}" >
    {!! $errors->first('danger_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('picking_code') ? 'has-error' : ''}}">
    <label for="picking_code" class="control-label">{{ 'Picking Code' }}</label>
    <input class="form-control" name="picking_code" type="text" id="picking_code" value="{{ isset($pickingdetail->picking_code) ? $pickingdetail->picking_code : ''}}" >
    {!! $errors->first('picking_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sale_status_id') ? 'has-error' : ''}}">
    <label for="sale_status_id" class="control-label">{{ 'Sale Status Id' }}</label>
    <input class="form-control" name="sale_status_id" type="number" id="sale_status_id" value="{{ isset($pickingdetail->sale_status_id) ? $pickingdetail->sale_status_id : ''}}" >
    {!! $errors->first('sale_status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quotation_code') ? 'has-error' : ''}}">
    <label for="quotation_code" class="control-label">{{ 'Quotation Code' }}</label>
    <input class="form-control" name="quotation_code" type="text" id="quotation_code" value="{{ isset($pickingdetail->quotation_code) ? $pickingdetail->quotation_code : ''}}" >
    {!! $errors->first('quotation_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('delivery_duration') ? 'has-error' : ''}}">
    <label for="delivery_duration" class="control-label">{{ 'Delivery Duration' }}</label>
    <input class="form-control" name="delivery_duration" type="text" id="delivery_duration" value="{{ isset($pickingdetail->delivery_duration) ? $pickingdetail->delivery_duration : ''}}" >
    {!! $errors->first('delivery_duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sales_picking_detail_id') ? 'has-error' : ''}}">
    <label for="sales_picking_detail_id" class="control-label">{{ 'Sales Picking Detail Id' }}</label>
    <input class="form-control" name="sales_picking_detail_id" type="number" id="sales_picking_detail_id" value="{{ isset($pickingdetail->sales_picking_detail_id) ? $pickingdetail->sales_picking_detail_id : ''}}" >
    {!! $errors->first('sales_picking_detail_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
