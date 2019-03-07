<div class="card">
  <div class="card-block">
    <div class="row">
      <div class="form-group col-lg-2">
        <label>รหัสลูกค้า</label>
        <input name="customer_code"  class="form-control" value="{{ $row->customer_code }}"  readonly>
      </div>
      <div class="form-group col-lg-8">
        <label>ชื่อบริษัท</label>
        <input type="text" name="company_name"  class="form-control " style="width:100%" value="{{ $row->company_name }}"  >
      </div>
      <div class="form-group col-lg-2">
        <label >ประเภทลูกค้า</label>
        <select name="customer_type" class="form-control ">
            @foreach ($table_customer_type as $cus)
            <option value="{{ $cus->customer_type_id }}">{{ $cus->customer_type_name }}</option>
            @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <div class="form-group  col-lg-6">
          <label >รายชื่อผู้ติดต่อ</label>
          <input name="contact_name"  class="form-control" value="{{ $row->contact_name }}" >
      </div>
      <div class="form-group col-lg-6">
        <label >รหัสผังบัญชี</label>
        <div>
          <input name="account_id" id="account_id"  class="form-control " value="{{ $row->account_id }}"  style="width:50%">
          @include('customer/modal-account')
        </div>
      </div>
    </div>

    <div class="form-group ">
      <label >ที่อยู่ปัจจุบัน</label>
      <input type="text" name="address"  class="form-control " value="{{ $row->address }}" >
    </div>
    <div class="row">
      <div class="form-group col-lg-3">
        <label >จังหวัด</label>
        <input name="province"  class="form-control " value="{{ $row->province }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >อำเภอ</label>
        <input name="district"  class="form-control " value="{{ $row->district }}" >
      </div>
      <div class="form-group col-lg-3">
        <label class="col-lg-2">ตำบล</label>
        <input name="sub_district"  class="form-control " value="{{ $row->sub_district }}" >
      </div>
      <div class="form-group col-lg-3">
        <label  >รหัสไปรษณีย์</label>
        <input name="zipcode"  class="form-control " value="{{ $row->zipcode }}" >
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-3">
          <label >เบอร์โทรศัพท์</label>
          <input name="telephone"  class="form-control" value="{{ $row->telephone }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >เบอร์ FAX</label>
        <input name="fax"  class="form-control "  value="{{ $row->fax }}" >
      </div>
      <div class="form-group col-lg-6">
        <label >รหัสพนักงาน</label>
        <div>
          <input name="user_id" id="user_id"  class="form-control " style="width: 50%" value="{{ $row->user_id }}" >
          @include('customer/modal-user')
        </div>
      </div>
    </div>

  </div>
</div>

<div class="card">
  <div class="card-block">
    <h3></h3>
    <div class="row">
      <div class="form-group col-lg-3">
        <label >เขตการขายของ</label>
        <select name="zone_id" id="zone_id" class="form-control " >
          @foreach ($table_zone as $zone)
          <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >ขนส่งโดย</label>
        <select name="transpotation_id" class="form-control ">
          @foreach ($table_delivery_type as $d)
            <option value="{{ $d->delivery_type_id }}">{{ $d->delivery_type_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >หมายเหตุ</label>
        <input name="remark" class="form-control " value="{{ $row->remark }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >วงเงินเคดิต</label>
        <input type="number" name="max_credit"  class="form-control "  value="{{ $row->max_credit }}" >
      </div>
    </div>


    <div class="row">
      <div class="form-group col-lg-3">
        <label >ระยะเวลาหนี้</label>
          <input type="number" name="debt_duration"  class="form-control "   value="{{ $row->debt_duration }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >ระดับของราคาสินค้า</label>
        <input type="number" name="degree_product"  class="form-control "   value="{{ $row->degree_product }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >ส่วนลด </label>
        <input type="number" name="loyalty_discount"  class="form-control "value="{{ $row->loyalty_discount }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >เลขภาษี </label>
        <input name="tax_number"  class="form-control "  value="{{ $row->tax_number }}" >
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-3">
        <label >เงื่อนไขวางบิล </label>
        <input name="billing_condition"  class="form-control " value="{{ $row->billing_condition }}" >
      </div>
      <div class="form-group col-lg-3">
        <label  >เงื่อนไขรับเช็ค </label>
        <input name="cheqe_condition"  class="form-control "  value="{{ $row->cheqe_condition }}" >
      </div>
      <div class="form-group col-lg-3">
        <label >ชนิดสถานที่ประกอบการ </label>
        <select name="location_type_id" class="form-control "  >
            @foreach ($table_location as $location)
            <option value="{{ $location->location_type_id }}">{{ $location->location_type_name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label  >สำนักงาน/สาขา (แสดงในภาษี) </label>
        <input name="branch_id"  class="form-control "  value="{{ $row->branch_id }}" >
      </div>
    </div>
  </div>
</div>
