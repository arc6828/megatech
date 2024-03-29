@extends('layouts/argon-dashboard/theme')
@php
    $main = request('type_debt');
    switch($main){
        case "XR" : 
            $main = "ตั้งหนี้คงค้าง";
            break;              
        case "AR" : 
            $main = "ตั้งหนี้";
            break;              
        case "DR" : 
            $main = "ลดหนี้";
            break;         
    }
@endphp

@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงินลูกหนี้')

@section('level-1-url', url('finance/customer-debt')."?type_debt=".request('type_debt'))
@section('level-1', $main)


@section('title', 'สร้าง' )
@section('background-tag','bg-info ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">สร้าง {{ request('type_debt') }} </div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance/customer-debt') }}?type_debt={{request('type_debt')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/customer-debt') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @switch(request('type_debt'))
                                @case ("XP")   
                                    @include ('customer-debt.form-1', ['formMode' => 'create', 'type_debt'=> request('type_debt') ])
                                    @break
                                @case ("AP") 
                                    @include ('customer-debt.form-2', ['formMode' => 'create', 'type_debt'=> request('type_debt') ])
                                    @break
                                @case ("DP")  
                                    @include ('customer-debt.form-3', ['formMode' => 'create', 'type_debt'=> request('type_debt') ])
                                    @break
                                @default  
                                    @include ('customer-debt.form', ['formMode' => 'create', 'type_debt'=>'ตั้งหนี้คงค้าง'])
                                    @break
                            @endswitch


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
