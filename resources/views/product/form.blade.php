@if(isset($table_product))
<div class="form-group text-right">
  <a href="{{ url('/') }}/gaurd-stock?product_id={{ $table_product->product_id }}" target="_blank">ดู Gaurd Stock ของสินค้า</a>
</div>
@endif
<div class="form-group ">
  <div class="form-row ">
      
      <div class="col-lg-4 {{ $errors->has('item_code') ? 'has-error' : ''}}">
        <label for="item_code" class="control-label">{{ 'รหัสสินค้า' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="product_code" type="text" id="product_code" value="{{ isset($table_product->product_code) ? $table_product->product_code : ''}}" required>
        {!! $errors->first('product_code', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="col-lg-8 {{ $errors->has('product_name') ? 'has-error' : ''}}">
        <label for="product_name" class="control-label">{{ 'รายละเอียดสินค้า' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="product_name" type="text" id="product_name" value="{{ isset($table_product->product_name) ? $table_product->product_name : ''}}" required>
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="col-lg-6 d-none {{ $errors->has('BARCODE') ? 'has-error' : ''}}">
        <label for="BARCODE" class="control-label">{{ 'Barcode' }}</label>
        <input class="form-control form-control-sm" name="BARCODE" type="text" id="BARCODE" value="{{ isset($table_product->BARCODE) ? $table_product->BARCODE : ''}}" >
        {!! $errors->first('BARCODE', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="col-lg-2 {{ $errors->has('brand') ? 'has-error' : ''}} d-none">
        <label for="brand" class="control-label">{{ 'Brand' }}</label>
        <select class="form-control form-control-sm"  id="brand" name="brand"  value="{{ isset($table_product->brand) ? $table_product->brand : ''}}" >
          
          <option value="">ไม่ระบุ</option>
          @foreach($brands as $item)
            <option value="{{$item->title}}">{{$item->title}}</option>
          @endforeach
        </select>
        <script>
           
          document.querySelector("#brand").value = "{{ isset($table_product->brand) ? $table_product->brand : '' }}";
          
        </script>
        {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
      </div>
  </div>
</div>
<div class="form-group d-none ">
  <div class="form-row">
    
    <div class="col-lg-6 {{ $errors->has('grade') ? 'has-error' : ''}}">
        <label for="grade" class="control-label">{{ 'Grade' }}</label>
        <input class="form-control form-control-sm" name="grade" type="text" id="grade" value="{{ isset($table_product->grade) ? $table_product->grade : ''}}" >
        {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>


<div class="form-group d-none  {{ $errors->has('promotion_price') ? 'has-error' : ''}}">
    <label for="promotion_price" class="control-label">{{ 'Promotion Price' }}</label>
    <input class="form-control form-control-sm" name="promotion_price" type="number" id="promotion_price" value="{{ isset($table_product->promotion_price) ? $table_product->promotion_price : ''}}" >
    {!! $errors->first('promotion_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('floor_price') ? 'has-error' : ''}}">
    <label for="floor_price" class="control-label">{{ 'Floor Price' }}</label>
    <input class="form-control form-control-sm" name="floor_price" type="number" id="floor_price" value="{{ isset($table_product->floor_price) ? $table_product->floor_price : ''}}" >
    {!! $errors->first('floor_price', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group ">
  <div class="form-row ">
    <div class="col-lg-4 {{ $errors->has('normal_price') ? 'has-error' : ''}}">
        <label for="normal_price" class="control-label">{{ 'ราคาขาย' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="normal_price" type="number" id="normal_price" value="{{ isset($table_product->normal_price) ? $table_product->normal_price : ''}}" required>
        {!! $errors->first('normal_price', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-lg-4 {{ $errors->has('max_discount_percent') ? 'has-error' : ''}}">
        <label for="max_discount_percent" class="control-label">{{ 'ส่วนลดไม่เกิน  (%)' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="max_discount_percent" type="number" id="max_discount_percent" value="{{ isset($table_product->max_discount_percent) ? $table_product->max_discount_percent : '40'}}"  required>
        {!! $errors->first('max_discount_percent', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-lg-2 {{ $errors->has('product_unit') ? 'has-error' : ''}}">
        <label for="product_unit" class="control-label">{{ 'หน่วยของสินค้า' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="product_unit" type="text" id="product_unit" value="{{ isset($table_product->product_unit) ? $table_product->product_unit : 'pcs'}}"  required>
        {!! $errors->first('product_unit', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-lg-2 {{ $errors->has('quantity') ? 'has-error' : ''}}">
        <label for="quantity" class="control-label">{{ 'จำนวนต่อแพ็คเกจ' }} <span class="text-danger" >*</span></label>
        <input class="form-control form-control-sm" name="quantity" type="number" id="quantity" value="{{ isset($table_product->quantity) ? $table_product->quantity : '1'}}"  required>
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>

<div class="form-group ">
  <div class="form-row ">
    
    <div class="col-lg-4 {{ $errors->has('pending_in') ? 'has-error' : ''}}">
        <label for="pending_in" class="control-label">{{ 'จำนวนค้างรับ' }}</label>
        <input class="form-control form-control-sm" name="pending_in" type="number" id="pending_in" value="{{ isset($table_product->pending_in) ? $table_product->pending_in : '0'}}" readonly>
        {!! $errors->first('pending_in', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-lg-4 {{ $errors->has('pending_out') ? 'has-error' : ''}}">
        <label for="pending_out" class="control-label">{{ 'จำนวนค้างส่ง' }}</label>
        <input class="form-control form-control-sm" name="pending_out" type="number" id="pending_out" value="{{ isset($table_product->pending_out) ? $table_product->pending_out : '0'}}"  readonly>
        {!! $errors->first('pending_out', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-lg-4 {{ $errors->has('amount_in_stock') ? 'has-error' : ''}}">
        <label for="amount_in_stock" class="control-label">{{ 'จำนวนสินค้าในคลัง' }}</label>
        <input class="form-control form-control-sm" name="amount_in_stock" type="number" id="amount_in_stock" value="{{ isset($table_product->amount_in_stock) ? $table_product->amount_in_stock : '0'}}" readonly>
        {!! $errors->first('amount_in_stock', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
</div>
<div class="form-group {{ $errors->has('product_detail') ? 'has-error' : ''}}">
    <label for="product_detail" class="control-label">{{ 'หมายเหตุ' }}</label>
    <input class="form-control form-control-sm" name="product_detail" type="text" id="product_detail" value="{{ isset($table_product->product_detail) ? $table_product->product_detail : ''}}" >
    {!! $errors->first('product_detail', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group d-none {{ $errors->has('purchase_price') ? 'has-error' : ''}}">
    <label for="purchase_price" class="control-label">{{ 'Purchase Price' }}</label>
    <input class="form-control form-control-sm" name="purchase_price" type="number" id="purchase_price" value="{{ isset($table_product->purchase_price) ? $table_product->purchase_price : ''}}" >
    {!! $errors->first('purchase_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('purchase_ref') ? 'has-error' : ''}}">
    <label for="purchase_ref" class="control-label">{{ 'Purchase Ref' }}</label>
    <input class="form-control form-control-sm" name="purchase_ref" type="text" id="purchase_ref" value="{{ isset($table_product->purchase_ref) ? $table_product->purchase_ref : ''}}" >
    {!! $errors->first('purchase_ref', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('ISBN') ? 'has-error' : ''}}">
    <label for="ISBN" class="control-label">{{ 'Isbn' }}</label>
    <input class="form-control form-control-sm" name="ISBN" type="text" id="ISBN" value="{{ isset($table_product->ISBN) ? $table_product->ISBN : ''}}" >
    {!! $errors->first('ISBN', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
