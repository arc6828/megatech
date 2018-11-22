@extends('monster-lite/layouts/theme')

@section('title','เพิ่มรายการธนาคาร')

@section('breadcrumb-menu')

@endsection


@section('content')
<form action="{{ url('/') }}/bank" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="card">
        <div class="card-block">
                <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสธนาคาร</label>
                        <div class="col-lg-3">
                            <input type="text" name="bank_code"  class="form-control form-control-line"  >
                        </div>
                </div>
                <div class="form-group form-inline">
                    <label class="col-lg-2">รายละเอียดธนาคาร</label>
                        <div class="col-lg-3">
                            <input type="text" name="bank_name"  class="form-control form-control-line"  >
                        </div>
                </div>
                <div class="form-group form-inline">
                    <label class="col-lg-2">สาขา</label>
                        <div class="col-lg-3">
                            <input type="text" name="bank_branch"  class="form-control form-control-line"  >
                        </div>
                </div>
                <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสผังบัญชี</label>
                        <div class="col-lg-3">
                            <input type="text" name="account_id" id="account_id"  class="form-control form-control-line"  >
                        </div>
                        
                        @include('customer/modal-account')
                </div>
                <div class="form-group form-inline">
                    <label class="col-lg-2">เลขที่บัญชีธนาคาร</label>
                        <div class="col-lg-3">
                            <input type="text" name="book_bank_serial"  class="form-control form-control-line"  >
                        </div>
                    <label class="col-lg-2">ยอดยกมา</label>
                        <div class="col-lg-3">
                            <input type="text" name="bring_forword" id="bring_forword"  class="form-control form-control-line" onchange="changeValue()" >
                        </div>
                </div>
           
              @include('bank_detail/index')
              <div class="form-group">
                    <div class="col-lg-12">
                      <div class="text-center">
                        <a class="btn btn-outline-primary" href="{{ url('/') }}/bank">back</a>
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