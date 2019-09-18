<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-lg-2">
        <label>รหัสลูกค้า</label>
        <input name="customer_code"  id="customer_code" class="form-control form-control-sm " value=""  readonly>
      </div>
      <div class="form-group col-lg-8">
        <label>ชื่อบริษัท</label>
        <input type="text" name="company_name"   id="company_name"   class="form-control form-control-sm  "  >
      </div>
      <div class="form-group col-lg-2">
        <label >ประเภทลูกค้า</label>
        <select name="customer_type" id="customer_type"  class="form-control form-control-sm  ">
          @foreach ($table_customer_type as $cus)
          <option value="{{ $cus->customer_type_id }}">{{ $cus->customer_type_name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<div class="card mt-4">
  <div class="card-body">
    <h2>รายละเอียดข้อมูลลูกค้า / บริษัท</h2>
    <div class="row">
      <div class="form-group col-lg-4">
        <label >รหัสผังบัญชี</label>
        <div class="input-group">
          <input name="account_id" id="account_id"  class="form-control form-control-sm  ">
          <div class="input-group-append">
            <button class="btn btn-outline-primary btn-sm" type="button"  data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> รหัสผังบัญชี
            </button>
          </div>
        </div>
        @include('customer/modal-account')
        <div>

        </div>
      </div>

      <div class="form-group col-lg-4">
        <label >ชื่อพนักงานที่ดูแล</label>
        <div class="input-group">
          <input name="short_name" id="name"  class="form-control form-control-sm  "  >
          <div class="input-group-append">
            <button class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#exampleModal2">
              <i class="fa fa-plus"></i> รหัสพนักงาน
            </button>
          </div>
        </div>
        <input type="hidden" name="user_id" id="user_id" >
        @include('customer/modal-user')
      </div>
    </div>

    <div class="row">
      <div class="form-group  col-lg-6">
          <label >รายชื่อผู้ติดต่อ</label>
          <input name="contact_name" id="contact_name" class="form-control form-control-sm "  >
      </div>
      <div class="form-group col-lg-3">
          <label >เบอร์โทรศัพท์</label>
          <input name="telephone" id="telephone" class="form-control form-control-sm "  >
      </div>
      <div class="form-group col-lg-3">
        <label >เบอร์ FAX</label>
        <input name="fax" id="fax"  class="form-control form-control-sm  "   >
      </div>
    </div>


    <div class="row">
      <div class="form-group col-lg-4">
        <label >ที่อยู่</label>
        <input type="text" name="address"  id="address" class="form-control form-control-sm"  >
      </div>
      <div class="form-group col-lg-2">
        <label >จังหวัด</label>
        <input name="province"  id="province" class="form-control form-control-sm" value="" onfocus="$('#type_address').val(true); $('#btn-district').click();" readonly>
      </div>
      <div class="form-group col-lg-2">
        <label >อำเภอ</label>
        <input name="district"  id="district" class="form-control form-control-sm  "  onfocus="$('#type_address').val(true); $('#btn-district').click();" readonly >
      </div>
      <div class="form-group col-lg-2">
        <label>ตำบล</label>
        <input name="sub_district"  id="sub_district" class="form-control form-control-sm  "  onfocus="$('#type_address').val(true); $('#btn-district').click();" readonly >
      </div>
      <div class="form-group col-lg-2">
        <label  >รหัสไปรษณีย์</label>
        <input name="zipcode"  id="zipcode"   class="form-control form-control-sm  "  onfocus="$('#type_address').val(true); $('#btn-district').click();" readonly>
      </div>
    </div>


    <div class="row">
      <div class="form-group col-lg-4">
        <label >สถานที่ส่งของ</label>
        <input type="text" name="delivery_address" id="delivery_address" class="form-control form-control-sm  " >
      </div>
      <div class="form-group col-lg-2">
        <label >จังหวัด</label>
        <input name="delivery_province" id="delivery_province"  class="form-control form-control-sm  "   onfocus="$('#type_address').val(false); $('#btn-district').click();" readonly>
      </div>
      <div class="form-group col-lg-2">
        <label >อำเภอ</label>
        <input name="delivery_district" id="delivery_district"  class="form-control form-control-sm  "  onfocus="$('#type_address').val(false); $('#btn-district').click();" readonly>
      </div>
      <div class="form-group col-lg-2">
        <label>ตำบล</label>
        <input name="delivery_sub_district" id="delivery_sub_district"  class="form-control form-control-sm  "  onfocus="$('#type_address').val(false); $('#btn-district').click();" readonly>
      </div>
      <div class="form-group col-lg-2">
        <label  >รหัสไปรษณีย์</label>
        <input name="delivery_zipcode" id="delivery_zipcode"  class="form-control form-control-sm  "  onfocus="$('#type_address').val(false); $('#btn-district').click();" readonly>
      </div>
    </div>
    @include('customer/district_modal')


    <div class="row">
      <div class="form-group col-lg-3">
        <label >เขตการขายของ</label>
        <select name="zone_id" id="zone_id" class="form-control form-control-sm  " >
          @foreach ($table_zone as $zone)
          <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >ขนส่งโดย</label>
        <select name="delivery_type_id" id="delivery_type_id" class="form-control form-control-sm  ">
          @foreach ($table_delivery_type as $d)
            <option value="{{ $d->delivery_type_id }}">{{ $d->delivery_type_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-lg-3">
        <label >วิธีการชำระเงิน</label>
        <select class="form-control form-control-sm"  name="payment_method"  id="payment_method" >
          <option value="credit">ซื้อเชื่อ</option>
          <option value="cash">ซื้อสด</option>
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label >วงเงินเคดิต</label>
        <input type="number" name="max_credit"  id="max_credit" class="form-control form-control-sm  "   >
      </div>
    </div>



    <div class="row">
      <div class="form-group col-lg-3">
        <label >ระยะเวลาหนี้</label>
          <input type="number" name="debt_duration"  id="debt_duration" class="form-control form-control-sm  "    >
      </div>


      <div class="form-group col-lg-3">
        <label >เงื่อนไขวางบิล </label>
        <input name="billing_duration" id="billing_duration" class="form-control form-control-sm  " >
      </div>
      <div class="form-group col-lg-3">
        <label  >เงื่อนไขรับเช็ค </label>
        <input name="cheqe_condition"  id="cheqe_condition"  class="form-control form-control-sm  "  >
      </div>
      <div class="form-group col-lg-3">
        <label >หมายเหตุ</label>
        <input name="remark" id="remark" class="form-control form-control-sm  "  >
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-3">
        <label >เลขภาษี </label>
        <input name="tax_number" id="tax_number"  class="form-control form-control-sm  tax-format"    >
      </div>
      <div class="form-group col-lg-3">
        <label >ชนิดสถานที่ประกอบการ </label>
        <select name="location_type_id" id="location_type_id" class="form-control form-control-sm  "  >
            @foreach ($table_location as $location)
            <option value="{{ $location->location_type_id }}">{{ $location->location_type_name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group col-lg-3">
        <label  >สำนักงาน/สาขา (แสดงในภาษี) </label>
        <input name="branch_id" id="branch_id"  class="form-control form-control-sm  "  value="{{ $row->branch_id }}" >
      </div>
    </div>
  </div>
</div>

<div class="card  mt-4">
  <div class="card-body">

    <h2>อัพโหลดเอกสาร</h2>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-center" id="table">
        <thead>
          <tr>
            <th class="text-center">Document</th>
            <th class="text-center">File name</th>
            <th class="text-center">Upload</th>
          </tr>
        </thead>
        <tbody>

          @foreach($table_upload as $row_upload)
          <tr>
            <td>
              {{ $row_upload->name }}
            </td>
            <td>
              <a href="#" id="file_name_{{ $row_upload->key }}" target="_blank">...</a>
            </td>
            <td>
              <div class="input-group  input-group-sm">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="upload_{{ $row_upload->key }}" id="upload_{{ $row_upload->key }}" onchange="var fileName = $(this)[0].files[0].name; $(this).next().text(fileName)">
                  <label class="custom-file-label" >Choose file</label>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    </div>
  </div>
</div>
<script>
function getUploadTemplate()
{
  return [
    {"key" : "map" , "name" : "แผนที่", "value":""},
    {"key" : "cc" , "name" : "ใบรับรองบริษัท", "value":""},
    {"key" : "cv_20" , "name" : "ใบภพ.20", "value":""},
    {"key" : "cheque" , "name" : "ระเบียบวางบิล-รับเช็ค", "value":"" },
  ];
}
</script>


<div>
  <div class="form-group col-lg-3 d-none">
    <label >ระดับของราคาสินค้า</label>
    <input type="number" name="degree_product"  class="form-control form-control-sm  "   value="{{ $row->degree_product }}" >
  </div>
  <div class="form-group col-lg-3 d-none">
    <label >ส่วนลด </label>
    <input type="number" name="loyalty_discount"  class="form-control form-control-sm  "value="{{ $row->loyalty_discount }}" >
  </div>
</div>
