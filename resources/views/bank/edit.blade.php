@extends('monster-lite/layouts/theme')

@section('title','แก้ไขแฟ้มธนาคาร')

@section('breadcrumb-menu')

@endsection


@section('content')

@forelse ($table_bank as $row)
<form action="{{ url('/') }}/bank/{{ $row->bank_id }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card">
        <div class="card-block">
                <div class="form-group form-inline">
                        <label class="col-lg-2">รหัสธนาคาร</label>
                            <div class="col-lg-3">
                                <input type="text" name="bank_code"  class="form-control form-control-line" value="{{ $row->bank_code }}"  >
                            </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-lg-2">รายละเอียดธนาคาร</label>
                            <div class="col-lg-3">
                                <input type="text" name="bank_name"  class="form-control form-control-line" value="{{ $row->bank_name }}"  >
                            </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-lg-2">สาขา</label>
                            <div class="col-lg-3">
                                <input type="text" name="bank_branch"  class="form-control form-control-line" value="{{ $row->bank_branch }}" >
                            </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-lg-2">รหัสผังบัญชี</label>
                            <div class="col-lg-3">
                                <input type="text" name="account_id" id="account_id"  class="form-control form-control-line" value="{{ $row->account_id }}" >
                            </div>
                            
                            @include('customer/modal-account')
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-lg-2">เลขที่บัญชีธนาคาร</label>
                            <div class="col-lg-3">
                                <input type="text" name="book_bank_serial"  class="form-control form-control-line" value="{{ $row->book_bank_serial }}" >
                            </div>
                        <label class="col-lg-2">ยอดยกมา</label>
                            <div class="col-lg-3">
                                <input type="text" name="bring_forword" id="bring_forword"  class="form-control form-control-line" onchange="changeValue()" value="{{ $row->bring_forward }}" >
                            </div>
                    </div>
                    @include('bank_detail/index')
                    <div class="form-group">
                            <div class="col-lg-12">
                              <div class="text-center">
                                <a class="btn btn-outline-primary" href="{{ url('/') }}/bank">back</a>
                                <button class="btn btn-success" type="submit" >Update</button>
                              </div>
                            </div>
                          </div>
        </div>
    </div>    
</form>


@empty
<div>
    No data Error
</div>    
@endforelse

@endsection
@section('plugins-js')

@endsection