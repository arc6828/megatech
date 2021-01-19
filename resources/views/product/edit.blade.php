@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('level-1-url', url('product'))
@section('level-1','แฟ้มหลักสินค้า')


@if( $mode == "edit" ) 
    @section('level-2-url', url('product/'.$product->product_id ))
    @section('level-2', $product->product_code) 
    
    @section('title', 'แก้ไข')
@endif

@if( $mode == "show" )  
    @section('title', 'รายละเอียด')
@endif


@section('content')
<form method="POST" action="{{ url('/product/' . $table_product->product_id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-none">Edit Product</div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <!-- <a href="{{ url('/product') }}" title="Back" class="btn btn-warning btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back 
                            </a>                         -->
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4 text-right">
                        
                            <a class="btn btn-info btn-sm"  href="{{ url('/') }}/gaurd-stock?product_id={{ $product->product_id }}" >
                                <i class="fa fa-home" aria-hidden="true"></i> Gaurd Stock 
                            </a>
                            @if($mode == "show" )
                            <a class="btn btn-warning btn-sm" href="{{ url('/product/'.$product->product_id.'/edit') }}" title="Edit">
                                <i class="fa fa-edit" aria-hidden="true"></i> แก้ไข
                            </a>       
                            @endif
                        </div>
                    </div>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    

                    @include ('product.form', ['formMode' => 'edit'])


                </div>
            </div>

            <hr>
            @php
                $productdetail = $product->details()->get();
            @endphp

            <div class="card mt-4">
                <div class="card-body">
                    <h4>รายละเอียดสินค้า</h4>
                    @include('product/detail')
                    <div class="text-center pt-4">
                    @include('product/create_detail_modal')
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
