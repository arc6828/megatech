<div class="form-group {{ $errors->has('final_product_id') ? 'has-error' : ''}}">
    <label for="final_product_id" class="control-label">{{ 'Final Product Id' }}</label>
    <input class="form-control" name="final_product_id" type="number" id="final_product_id" value="{{ isset($productdetail->final_product_id) ? $productdetail->final_product_id : }}" >
    {!! $errors->first('final_product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('detail_product_id') ? 'has-error' : ''}}">
    <label for="detail_product_id" class="control-label">{{ 'Detail Product Id' }}</label>
    <input class="form-control" name="detail_product_id" type="number" id="detail_product_id" value="{{ isset($productdetail->detail_product_id) ? $productdetail->detail_product_id : ''}}" >
    {!! $errors->first('detail_product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($productdetail->amount) ? $productdetail->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($productdetail->remark) ? $productdetail->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
