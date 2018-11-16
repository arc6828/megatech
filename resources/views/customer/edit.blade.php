@extends('monster-lite/layouts/theme')

@section('title','แก้ไขข้อมูลลูกค้า')

@section('breadcrumb-menu')

@endsection


@section('content')
@forelse ($table_customer as $row)
<form action="{{url('/')}}/customer/{{$row->customer_id}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group form-inline">
                            <label class="col-lg-2">รหัสลูกค้า</label>
                                    <div class="col-lg-3">
                                    <input type="text" name="customer_code"  class="form-control form-control-line" value="{{ $row->customer_code }}"  >
                                    </div>
                                </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group form-inline">
                        <label class="col-lg-2">รหัสลูกค้า</label>
                            <div class="col-lg-3">
                                    <select name="customer_type" class="form-control form-control-line">
                                        @foreach ($table_customer_type as $cus)
                                        <option value="{{ $cus->customer_type_id }}">{{ $cus->customer_type_name }}</option>
                                        @endforeach
                                      
                                       
                                    </select>
                            </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-lg-1">ชื่อบริษัท</label>
                    <div class="col-lg-11">
                        <input type="text" name="company_name"  class="form-control form-control-line" style="width:100%" value="{{ $row->company_name }}"  >
                    </div>
            </div>
    
            <h3>รายละเอียด</h3>
            
            <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสผังบัญชี</label>
                            <div class="col-lg-3">
                                <input type="text" name="account_id" id="account_id"  class="form-control form-control-line" value="{{ $row->account_id }}"  >
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> รหัสผังบัญชี
                             </button>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">รายชื่อผู้ติดต่อ</label>
                            <div class="col-lg-3">
                                <input type="text" name="contact_name"  class="form-control form-control-line" style="width: 100%" value="{{ $row->contact_name }}" >
                            </div>
             </div>
             <div class="form-group form-inline">
                    <label class="col-lg-2">ที่อยู่</label>
                            <div class="col-lg-3">
                                <input type="text" name="address"  class="form-control form-control-line" style="width: 100%" value="{{ $row->address }}" ><br>
                            </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ตำบล</label>
                            <div class="col-lg-3">
                                <input type="text" name="sub_district"  class="form-control form-control-line" style="width: 100%" value="{{ $row->sub_district }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">อำเภอ</label>
                            <div class="col-lg-3">
                                <input type="text" name="district"  class="form-control form-control-line" style="width: 100%" value="{{ $row->district }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">จังหวัด</label>
                            <div class="col-lg-3">
                                <input type="text" name="province"  class="form-control form-control-line" style="width: 100%" value="{{ $row->province }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสไปรษณีย์</label>
                            <div class="col-lg-3">
                                <input type="text" name="zipcode"  class="form-control form-control-line" style="width: 100%" value="{{ $row->zipcode }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">สถานที่ส่งของ</label>
                            <div class="col-lg-3">
                                <input type="text" name="delivery_address"  class="form-control form-control-line" style="width: 100%" value="{{ $row->delivery_address }}" ><br>
                            </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ตำบลที่ส่งของ</label>
                            <div class="col-lg-3">
                                <input type="text" name="delivery_sub_district"  class="form-control form-control-line" style="width: 100%" value="{{ $row->delivery_sub_district }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">อำเภอที่ส่งของ</label>
                            <div class="col-lg-3">
                                <input type="text" name="delivery_district"  class="form-control form-control-line" style="width: 100%" value="{{ $row->delivery_district }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">จังหวัดที่ส่งของ</label>
                            <div class="col-lg-3">
                                <input type="text" name="delivery_province"  class="form-control form-control-line" style="width: 100%" value="{{ $row->delivery_province }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสไปรษณีย์ที่ส่งของ</label>
                            <div class="col-lg-3">
                                <input type="text" name="delivery_zipcode"  class="form-control form-control-line" style="width: 100%" value="{{ $row->delivery_zipcode }}" ><br>
                    </div>
            </div>
            
           
            <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสพนักงาน</label>
                            <div class="col-lg-3">
                                <input type="text" name="user_id" id="user_id"  class="form-control form-control-line" style="width: 100%" value="{{ $row->user_id }}" ><br>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                            <i class="fa fa-plus"></i> รหัสพนักงาน
                     </button>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เบอร์โทรศัพท์</label>
                            <div class="col-lg-3">
                                <input type="text" name="telephone"  class="form-control form-control-line" style="width: 100%" value="{{ $row->telephone }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เบอร์ FAX</label>
                            <div class="col-lg-3">
                                <input type="text" name="fax"  class="form-control form-control-line" style="width: 100%" value="{{ $row->fax }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เขตการขายของ</label>
                            <div class="col-lg-3">
                               
                            <select name="zone_id" id="zone_id" class="form-control form-control-line" >
                                        @foreach ($table_zone as $zone)
                                        <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
                                        @endforeach
                                    </select>
                                
                            
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ขนส่งโดย</label>
                            <div class="col-lg-3">
                            <select name="transpotation_id" class="form-control form-control-line">
                                @foreach ($table_delivery_type as $d)
                                
                                <option value="{{ $d->delivery_type_id }}">{{ $d->delivery_type_name }}</option>
                                @endforeach
                                
    
                            </select>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">หมายเหตุ</label>
                            <div class="col-lg-3">
                                <input type="text" name="remark"  class="form-control form-control-line" style="width: 100%" value="{{ $row->remark }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">วงเงินเคดิต</label>
                            <div class="col-lg-3">
                                <input type="number" name="max_credit"  class="form-control form-control-line" style="width: 100%" value="{{ $row->max_credit }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ระยะเวลาหนี้</label>
                            <div class="col-lg-3">
                                <input type="number" name="debt_duration"  class="form-control form-control-line" style="width: 100%" value="{{ $row->debt_duration }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ระดับของราคาสินค้า</label>
                            <div class="col-lg-3">
                                <input type="number" name="degree_product"  class="form-control form-control-line" style="width: 100%" value="{{ $row->degree_product }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ส่วนลด </label>
                            <div class="col-lg-3">
                                <input type="number" name="loyalty_discount"  class="form-control form-control-line" style="width: 100%" value="{{ $row->loyalty_discount }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เลขภาษี </label>
                            <div class="col-lg-3">
                                <input type="text" name="tax_number"  class="form-control form-control-line" style="width: 100%" value="{{ $row->tax_number }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เงื่อนไขวางบิล </label>
                            <div class="col-lg-3">
                                <input type="text" name="billing_condition"  class="form-control form-control-line" style="width: 100%" value="{{ $row->billing_condition }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">เงื่อนไขรับเช็ค </label>
                            <div class="col-lg-3">
                                <input type="text" name="cheqe_condition"  class="form-control form-control-line" style="width: 100%" value="{{ $row->cheqe_condition }}" ><br>
                    </div>
            </div>
            <div class="form-group form-inline">
                    <label class="col-lg-2">ชนิดสถานที่ประกอบการ </label>
                            <div class="col-lg-3">
                                <select name="location_type_id" class="form-control form-control-line"  >
                                    @foreach ($table_location as $location)
                                <option value="{{ $location->location_type_id }}">{{ $location->location_type_name }}</option>
                                    
                                    @endforeach
                                    
                                </select>
                        </div>
                    </div>
        
        <div class="form-group form-inline">
                <label class="col-lg-2">สำนักงาน/สาขา (แสดงในภาษี) </label>
                        <div class="col-lg-3">
                            <input type="text" name="branch_id"  class="form-control form-control-line" style="width: 100%" value="{{ $row->branch_id }}" ><br>
                </div>
        </div>
        <div class="form-group">
                <div class="col-lg-12">
                  <div class="text-center">
                    <a class="btn btn-outline-primary" href="{{ url('/') }}/customer">back</a>
                    <button class="btn btn-success" type="submit" >Update</button>
                  </div>
                </div>
              </div>
            </div>
    </div>
</form>
@empty
    
@endforelse

@endsection

@section('plugins-js')

@endsection