@extends('layouts/argon-dashboard/theme')

@section('title','เพิ่มสินค้า')


@section('content')
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-none">เพิ่มสินค้า</div>
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

                        <form method="POST" action="{{ url('/product') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            @include ('product.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection

