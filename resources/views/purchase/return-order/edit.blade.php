@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('level-1-url', url('purchase/return-order'))
@section('level-1','ใบส่งคืนสินค้า')


@section('title', $mode == "edit" ? 'แก้ไข' : 'รายละเอียด')

@section('background-tag','bg-success')

@section('title','Edit ReturnOrder #'.$returnorder->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="">
                    <!-- <div class="card-header">Edit ReturnOrder #{{ $returnorder->id }}</div> -->
                    <div class="">
                        <!-- <a href="{{ url('/purchase/return-order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/purchase/return-order/' . $returnorder->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('purchase.return-order.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
