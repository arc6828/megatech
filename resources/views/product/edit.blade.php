@extends('monster-lite/layouts/theme')

@section('title','แก้ไขสินค้า')

@section('breadcrumb-menu')

@endsection


@section('content')
@forelse($table_product as $row_product)
<form action="{{url('/')}}/product/{{$row_product->product_id}}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PUT') }}
    <div class="card">
        <div class="card-block">
           
                <div class="form-group form-inline">
                    <label class="col-lg-2">รหัสสินค้า</label>
                        <div class="col-lg-3">
                             <input type="text" name="product_code" class="form-control form-control-line" value="{{ $row_product->product_code }}" >
                        </div> 
                </div>  
                <div class="form-group form-inline">
                        <label class="col-lg-2">รายละเอียดสินค้า</label>
                            <div class="col-lg-3">
                                 <input type="text" name="product_name" class="form-control form-control-line" value="{{ $row_product->product_name }}" >
                            </div> 
                </div>  
                <div class="form-group form-inline">
                        <label class="col-lg-2">ยี่ห้อ</label>
                            <div class="col-lg-3">
                                 <input type="text" name="product_brand" class="form-control form-control-line" value="{{ $row_product->brand }}" >
                            </div> 
                </div> 
                <div class="form-group form-inline">
                        <label class="col-lg-2">รายละเอียดสินค้า</label>
                            <div class="col-lg-3">
                                 <textarea type="text" name="product_detail" class="form-control form-control-line" value="{{ $row_product->product_detail }}" ></textarea>
                            </div> 
                </div>   
                <div class="form-group form-inline">
                        <label class="col-lg-2">หน่วยนับหลัก</label>
                            <div class="col-lg-3">
                                 <input type="text" name="product_unit" class="form-control form-control-line" value="{{ $row_product->product_unit }}" >
                            </div> 
                </div> 
                <div class="form-group">
                        <div class="col-lg-12">
                          <div class="text-center">
                            <a class="btn btn-outline-primary" href="{{ url('/') }}/product">back</a>
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