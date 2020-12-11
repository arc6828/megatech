@extends('layouts/argon-dashboard/theme')


@include('bank-transaction/lib')

@php
$main = getTransactionCode(request('transaction_code'));   
@endphp

@section('level-0-url', url('finance')."?tab=bank-tab")
@section('level-0','การเงินธนาคาร')

@section('level-1-url', url('finance/bank-transaction')."?transaction_code=".request('transaction_code'))
@section('level-1', $main)

@section('title','สร้าง')

@section('background-tag','bg-info ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">สร้าง transaction : {{request('transaction_code')}}</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance/bank-transaction') }}?transaction_code={{request('transaction_code')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/bank-transaction') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('bank-transaction.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
