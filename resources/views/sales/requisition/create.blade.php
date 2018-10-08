@extends('monster-lite/layouts/theme')

@section('title','สร้างใบเสนอราคา')

@section('breadcrumb-menu')

@endsection

@section('content')

<form class="" action="{{ url('/') }}/sales/requisition" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="card">
        <div class="card-block">
          <div class="row">
            <div class="col-lg-9 align-self-center">
                <h4 class="card-title">Requisition code : ... </h4>
                <h6 class="card-subtitle">Fill infomation in the form</h6>
            </div>
            <div class="col-lg-3 align-self-center">

            </div>
          </div>

          <div>
            <div class="form-group form-inline">
                <label class="col-lg-2">รหัสลูกค้า</label>
                <div class="col-lg-3">
                    <select name="customer_id" class="form-control" required>
                        <option value="" >None</option>
                        @foreach($table_customer as $row_customer)
                        <option value="{{ $row_customer->customer_id }}" >
                            {{  $row_customer->customer_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">ระยะเวลาหนี้</label>
                <div class="col-lg-3">
                  <input type="number" name="debt_duration"  class="form-control form-control-line"  >
                </div>
                <label class="col-lg-2 offset-lg-1">กำหนดยื่นราคา</label>
                <div class="col-lg-3">
                  <input type="number" name="billing_duration"  class="form-control form-control-line"  >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">เงื่อนไขการชำระเงิน</label>
                <div class="col-lg-3">
                  <input name="payment_condition"  class="form-control form-control-line"  >
                </div>
                <label class="col-lg-2 offset-lg-1">ขนส่งโดย</label>
                <div class="col-lg-3">
                    <select name="delivery_type_id" class="form-control" required>
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
                    <select name="tax_type_id" class="form-control" required>
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
                <input type="number" name="delivery_time"  class="form-control form-control-line"  >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-lg-2">รหัสแผนก</label>
                <div class="col-lg-3">
                <input type="number" name="department_id"  class="form-control form-control-line"  readonly="">
                </div>
                <label class="col-lg-2 offset-lg-1">สถานะ</label>
                <div class="col-lg-3">
                    <select name="sales_status_id" class="form-control" required>
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
                    <select name="user_id" class="form-control" required>
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
                    <select name="zone_id" class="form-control" required>
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
                <input name="remark"  class="form-control form-control-line"  >
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-12">
                <div class="text-center">
                  <a class="btn btn-outline-primary" href="{{ url('/') }}/sales/requisition">back</a>
                  <button class="btn btn-success" type="submit" >Create</button>
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
