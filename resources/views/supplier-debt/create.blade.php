@extends('layouts/argon-dashboard/theme')
@php
    $main = request('type_debt');
    switch($main){
        case "XP" : 
            $main = "ตั้งหนี้คงค้าง";
            break;              
        case "AP" : 
            $main = "ตั้งหนี้ลูกหนี้";
            break;              
        case "DP" : 
            $main = "ลดหนี้ลูกหนี้";
            break;         
    }
@endphp

@section('level-0-url', url('finance')."?tab=creditor-tab")
@section('level-0','การเงินเจ้าหนี้')

@section('level-1-url', url('finance/supplier-debt')."?type_debt=".request('type_debt'))
@section('level-1', $main)


@section('title', 'สร้าง' )
@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">          

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Create New SupplierDebt</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/supplier-debt') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/supplier-debt') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('supplier-debt.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
