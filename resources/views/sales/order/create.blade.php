@extends('monster-lite/layouts/theme')

@section('title','สร้างใบจอง')

@section('navbar-menu')
<div style="margin: 21px;">
  <a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/order">back</a>
  <button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
</div>

@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<form class="" action="{{ url('/') }}/sales/order" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="card">
        <div class="card-block">
          <div>
            <div class="form-group form-inline">
              <label class="col-lg-2">รหัสลูกหนี้</label>
              <div class="col-lg-3">
                <input type="hidden" name="customer_id" id="customer_id" class="form-control form-control-sm " value=""  required>
                <input type="text" name="contact_name" id="contact_name" class="form-control form-control-sm" value=""	readonly style="max-width:100px;">

                @include('customer/index_modal')
              </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-lg-2">เลขที่ใบสั่งซื้อลูกหนี้</label>
                <div class="col-lg-3">
                  <input name="external_reference_doc"  class="form-control form-control-sm "  required>
                </div>
                <label class="col-lg-2 offset-lg-1">เลขที่ใบเสนอราคา</label>
                <div class="col-lg-3">
                  <input name="internal_reference_doc"  class="form-control form-control-sm " required>
                </div>

            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">ระยะเวลาหนี้</label>
                <div class="col-lg-3">
                  <input type="number" name="debt_duration"  class="form-control form-control-sm "  >
                </div>
                <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
                <div class="col-lg-3">
                  <input type="number" name="billing_duration"  class="form-control form-control-sm "  >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
                <div class="col-lg-3">
                  <input name="payment_condition"  class="form-control form-control-sm "  >
                </div>
                <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
                <div class="col-lg-3">
                    <select name="delivery_type_id" class="form-control form-control-sm" required>
                        <option value="" >None</option>
                        @foreach($table_delivery_type as $row_delivery_type)
                        <option value="{{ $row_delivery_type->delivery_type_id }}" >
                            {{  $row_delivery_type->delivery_type_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">ชนิดภาษี</label>
                <div class="col-lg-3">
                    <select name="tax_type_id" class="form-control form-control-sm" required>
                        <option value="" >None</option>
                        @foreach($table_tax_type as $row_tax_type)
                        <option value="{{ $row_tax_type->tax_type_id }}" >
                            {{  $row_tax_type->tax_type_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <label class="col-lg-2 offset-lg-1">ระยะเวลาในการส่งของ (วัน)</label>
                <div class="col-lg-3">
                <input type="number" name="delivery_time"  class="form-control form-control-sm "  >
                </div>
            </div>

            <div class="form-group form-inline">
              <label class="col-lg-2">รหัสแผนก</label>
              <div class="col-lg-3">
                <select name="department_id" class="form-control form-control-sm" required>
                  <option value="" >None</option>
                  @foreach($table_department as $row_department)
                  <option value="{{ $row_department->department_id }}" >
                    {{	$row_department->department_name }}
                  </option>
                  @endforeach
                </select>
              </div>
                <label class="col-lg-2 offset-lg-1">สถานะ</label>
                <div class="col-lg-3">
                    <select name="sales_status_id" class="form-control form-control-sm" required>
                        <option value="" >None</option>
                        @foreach($table_sales_status as $row_sales_status)
                        <option value="{{ $row_sales_status->sales_status_id }}" >
                            {{  $row_sales_status->sales_status_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group form-inline">
              <label class="col-lg-2">รหัสพนักงานขาย</label>
              <div class="col-lg-3">
                    <select name="user_id" class="form-control form-control-sm" required>
                        <option value="" >None</option>
                        @foreach($table_sales_user as $row_sales_user)
                        <option value="{{ $row_sales_user->id }}" >
                            {{  $row_sales_user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
              <label class="col-lg-2 offset-lg-1">เขตการขาย</label>
                <div class="col-lg-3">
                    <select name="zone_id" class="form-control form-control-sm" required>
                        <option value="" >None</option>
                        @foreach($table_zone as $row_zone)
                        <option value="{{ $row_zone->zone_id }}" >
                            {{  $row_zone->zone_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group form-inline">
              <label class="col-lg-2">หมายเหตุ</label>
              <div class="col-lg-3">
                <input name="remark"  class="form-control form-control-sm "  >
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-12">
                <div class="text-center">
                  <button class="btn btn-success d-none" id="form-submit" type="submit" >Create</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</form>


@endsection

@section('plugins-js')

@endsection
