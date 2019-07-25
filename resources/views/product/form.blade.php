<div class="form-group {{ $errors->has('product_code') ? 'has-error' : ''}}">
    <label for="product_code" class="control-label">{{ 'รหัส MegaCode' }}</label>
    <input class="form-control form-control-sm" name="product_code" type="text" id="product_code" value="{{ isset($table_product[0]->product_code) ? $table_product[0]->product_code : ''}}" >
    {!! $errors->first('product_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="control-label">{{ 'Description' }}</label>
    <input class="form-control form-control-sm" name="product_name" type="text" id="product_name" value="{{ isset($table_product[0]->product_name) ? $table_product[0]->product_name : ''}}" >
    {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('product_detail') ? 'has-error' : ''}}">
    <label for="product_detail" class="control-label">{{ 'Product Detail' }}</label>
    <input class="form-control form-control-sm" name="product_detail" type="text" id="product_detail" value="{{ isset($table_product[0]->product_detail) ? $table_product[0]->product_detail : ''}}" >
    {!! $errors->first('product_detail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
    <label for="brand" class="control-label">{{ 'Brand' }}</label>
    <input class="form-control form-control-sm" name="brand" type="text" id="brand" value="{{ isset($table_product[0]->brand) ? $table_product[0]->brand : ''}}" >
    {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('grade') ? 'has-error' : ''}}">
    <label for="grade" class="control-label">{{ 'Grade' }}</label>
    <input class="form-control form-control-sm" name="grade" type="text" id="grade" value="{{ isset($table_product[0]->grade) ? $table_product[0]->grade : ''}}" >
    {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none  {{ $errors->has('promotion_price') ? 'has-error' : ''}}">
    <label for="promotion_price" class="control-label">{{ 'Promotion Price' }}</label>
    <input class="form-control form-control-sm" name="promotion_price" type="number" id="promotion_price" value="{{ isset($table_product[0]->promotion_price) ? $table_product[0]->promotion_price : ''}}" >
    {!! $errors->first('promotion_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('floor_price') ? 'has-error' : ''}}">
    <label for="floor_price" class="control-label">{{ 'Floor Price' }}</label>
    <input class="form-control form-control-sm" name="floor_price" type="number" id="floor_price" value="{{ isset($table_product[0]->floor_price) ? $table_product[0]->floor_price : ''}}" >
    {!! $errors->first('floor_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('max_discount_percent') ? 'has-error' : ''}}">
    <label for="max_discount_percent" class="control-label">{{ 'ส่วนลดไม่เกิน  (%)' }}</label>
    <input class="form-control form-control-sm" name="max_discount_percent" type="number" id="max_discount_percent" value="{{ isset($table_product[0]->max_discount_percent) ? $table_product[0]->max_discount_percent : ''}}" >
    {!! $errors->first('max_discount_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount_in_stock') ? 'has-error' : ''}}">
    <label for="amount_in_stock" class="control-label">{{ 'จำนวนสินค้าในคลัง' }}</label>
    <input class="form-control form-control-sm" name="amount_in_stock" type="number" id="amount_in_stock" value="{{ isset($table_product[0]->amount_in_stock) ? $table_product[0]->amount_in_stock : ''}}" >
    {!! $errors->first('amount_in_stock', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_unit') ? 'has-error' : ''}}">
    <label for="product_unit" class="control-label">{{ 'หน่วยของสินค้า' }}</label>
    <input class="form-control form-control-sm" name="product_unit" type="text" id="product_unit" value="{{ isset($table_product[0]->product_unit) ? $table_product[0]->product_unit : ''}}" >
    {!! $errors->first('product_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pending_in') ? 'has-error' : ''}}">
    <label for="pending_in" class="control-label">{{ 'Pending In' }}</label>
    <input class="form-control form-control-sm" name="pending_in" type="number" id="pending_in" value="{{ isset($table_product[0]->pending_in) ? $table_product[0]->pending_in : ''}}" >
    {!! $errors->first('pending_in', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pending_out') ? 'has-error' : ''}}">
    <label for="pending_out" class="control-label">{{ 'Pending Out' }}</label>
    <input class="form-control form-control-sm" name="pending_out" type="number" id="pending_out" value="{{ isset($table_product[0]->pending_out) ? $table_product[0]->pending_out : ''}}" >
    {!! $errors->first('pending_out', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('normal_price') ? 'has-error' : ''}}">
    <label for="normal_price" class="control-label">{{ 'ราคาขาย' }}</label>
    <input class="form-control form-control-sm" name="normal_price" type="number" id="normal_price" value="{{ isset($table_product[0]->normal_price) ? $table_product[0]->normal_price : ''}}" >
    {!! $errors->first('normal_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('BARCODE') ? 'has-error' : ''}}">
    <label for="BARCODE" class="control-label">{{ 'Barcode' }}</label>
    <input class="form-control form-control-sm" name="BARCODE" type="text" id="BARCODE" value="{{ isset($table_product[0]->BARCODE) ? $table_product[0]->BARCODE : ''}}" >
    {!! $errors->first('BARCODE', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('item_code') ? 'has-error' : ''}}">
    <label for="item_code" class="control-label">{{ 'Item Code' }}</label>
    <input class="form-control form-control-sm" name="item_code" type="text" id="item_code" value="{{ isset($table_product[0]->item_code) ? $table_product[0]->item_code : ''}}" >
    {!! $errors->first('item_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('purchase_price') ? 'has-error' : ''}}">
    <label for="purchase_price" class="control-label">{{ 'Purchase Price' }}</label>
    <input class="form-control form-control-sm" name="purchase_price" type="number" id="purchase_price" value="{{ isset($table_product[0]->purchase_price) ? $table_product[0]->purchase_price : ''}}" >
    {!! $errors->first('purchase_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('purchase_ref') ? 'has-error' : ''}}">
    <label for="purchase_ref" class="control-label">{{ 'Purchase Ref' }}</label>
    <input class="form-control form-control-sm" name="purchase_ref" type="text" id="purchase_ref" value="{{ isset($table_product[0]->purchase_ref) ? $table_product[0]->purchase_ref : ''}}" >
    {!! $errors->first('purchase_ref', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('ISBN') ? 'has-error' : ''}}">
    <label for="ISBN" class="control-label">{{ 'Isbn' }}</label>
    <input class="form-control form-control-sm" name="ISBN" type="text" id="ISBN" value="{{ isset($table_product[0]->ISBN) ? $table_product[0]->ISBN : ''}}" >
    {!! $errors->first('ISBN', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="control-label">{{ 'จำนวนต่อแพ็คเกจ' }}</label>
    <input class="form-control form-control-sm" name="quantity" type="number" id="quantity" value="{{ isset($table_product[0]->quantity) ? $table_product[0]->quantity : ''}}" >
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
