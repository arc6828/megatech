@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขสินค้า')


@section('content')
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-none">Edit Product</div>
                    <div class="card-body">
                        <a href="{{ url('/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/product/' . $table_product[0]->product_id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('product.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
