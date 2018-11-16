@extends('monster-lite/layouts/theme')

@section('title','เพิ่มสินค้า')

@section('breadcrumb-menu')

@endsection


@section('content')


<form class="" action="{{ url('/') }}/product" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}

<div class="card">

<div class="form-group form-inline">
<label class="col-lg-2">รหัสสินค้า</label>
        <div class="col-lg-3">
            <input type="text" name="product_code"  class="form-control form-control-line"  >
        </div>
</div>
<div class="form-group form-inline">
<label class="col-lg-2">รายละเอียดสินค้า</label>
        <div class="col-lg-3">
            <input type="text" name="product_name"  class="form-control form-control-line" style="width: 100%" >
        </div>
</div>
<div class="form-group form-inline">
<label class="col-lg-2">ยี่ห้อ</label>
        <div class="col-lg-3">
            <input type="text" name="product_brand"  class="form-control form-control-line"  >
        </div>
</div>


<div class="form-group form-inline">
<label class="col-lg-2">รายละเอียดเพิ่มเติม</label>
        <div class="col-lg-3">
           <textarea name="product_detail"cols="30" rows="5"  class="form-control form-control-line"></textarea>
        </div>
</div>

<div class="form-group form-inline">
<label class="col-lg-2">หน่วยนับ</label>
        <div class="col-lg-3">
            <input type="text" name="product_unit"  class="form-control form-control-line" value="ชิ้น" >
        </div>
</div>
<div class="form-group">
              <div class="col-lg-12">
                <div class="text-center">
                  <a class="btn btn-outline-primary" href="{{ url('/') }}/product">back</a>
                  <button class="btn btn-success" type="submit" >Create</button>
                </div>
              </div>
            </div>

</form>

@endsection


@section('plugins-js')

@endsection