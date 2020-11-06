<a href="{{ url('/purchase/return-order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($returnorder->code) ? $returnorder->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control" name="supplier_id" type="number" id="supplier_id" value="{{ isset($returnorder->supplier_id) ? $returnorder->supplier_id : ''}}" >
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('purchase_receive_code') ? 'has-error' : ''}}">
    <label for="purchase_receive_code" class="control-label">{{ 'Purchase Receive Code' }}</label>
    <input class="form-control" name="purchase_receive_code" type="text" id="purchase_receive_code" value="{{ isset($returnorder->purchase_receive_code) ? $returnorder->purchase_receive_code : ''}}" >
    {!! $errors->first('purchase_receive_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tax_type_id') ? 'has-error' : ''}}">
    <label for="tax_type_id" class="control-label">{{ 'Tax Type Id' }}</label>
    <input class="form-control" name="tax_type_id" type="number" id="tax_type_id" value="{{ isset($returnorder->tax_type_id) ? $returnorder->tax_type_id : ''}}" >
    {!! $errors->first('tax_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('purchase_status_id') ? 'has-error' : ''}}">
    <label for="purchase_status_id" class="control-label">{{ 'Purchase Status Id' }}</label>
    <input class="form-control" name="purchase_status_id" type="number" id="purchase_status_id" value="{{ isset($returnorder->purchase_status_id) ? $returnorder->purchase_status_id : ''}}" >
    {!! $errors->first('purchase_status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($returnorder->user_id) ? $returnorder->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($returnorder->remark) ? $returnorder->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : ''}}">
    <label for="total_before_vat" class="control-label">{{ 'Total Before Vat' }}</label>
    <input class="form-control" name="total_before_vat" type="number" id="total_before_vat" value="{{ isset($returnorder->total_before_vat) ? $returnorder->total_before_vat : ''}}" >
    {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat') ? 'has-error' : ''}}">
    <label for="vat" class="control-label">{{ 'Vat' }}</label>
    <input class="form-control" name="vat" type="number" id="vat" value="{{ isset($returnorder->vat) ? $returnorder->vat : ''}}" >
    {!! $errors->first('vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vat_percent') ? 'has-error' : ''}}">
    <label for="vat_percent" class="control-label">{{ 'Vat Percent' }}</label>
    <input class="form-control" name="vat_percent" type="number" id="vat_percent" value="{{ isset($returnorder->vat_percent) ? $returnorder->vat_percent : ''}}" >
    {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total_after_vat') ? 'has-error' : ''}}">
    <label for="total_after_vat" class="control-label">{{ 'Total After Vat' }}</label>
    <input class="form-control" name="total_after_vat" type="number" id="total_after_vat" value="{{ isset($returnorder->total_after_vat) ? $returnorder->total_after_vat : ''}}" >
    {!! $errors->first('total_after_vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('revision') ? 'has-error' : ''}}">
    <label for="revision" class="control-label">{{ 'Revision' }}</label>
    <input class="form-control" name="revision" type="number" id="revision" value="{{ isset($returnorder->revision) ? $returnorder->revision : ''}}" >
    {!! $errors->first('revision', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
