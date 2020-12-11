@extends('layouts/argon-dashboard/theme')

@php
    $main = request('cheque_type_code');
    switch($main){
        case "cheque-in" : 
            $main = "ทะเบียนเช็ครับ";
            break;              
        case "cheque-out" : 
            $main = "ทะเบียนเช็คจ่าย";
            break;        
        case "" : 
            $main = "ทั้งหมด";
            break;        
    }
@endphp

@section('level-0-url', url('finance')."?tab=cheque-tab")
@section('level-0','การเงินเช็ค')

@section('level-1-url', url('finance/cheque')."?cheque_type_code=".request('cheque_type_code'))
@section('level-1', $main)


@section('title', 'สร้าง' )
@section('background-tag','bg-info ')


@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Cheque</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/cheque') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/cheque') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('cheque.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
