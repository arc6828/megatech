@extends('layouts/argon-dashboard/theme')

@section('title','ตั้งหนี้ / ลดหนี้ ลูกค้า')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New CustomerDebt</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/customer-debt') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/customer-debt') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @switch(request('debt_type'))
                                @case ("ตั้งหนี้คงค้าง")                                 
                                    @include ('customer-debt.form-1', ['formMode' => 'create', 'debt_type'=>'ตั้งหนี้คงค้าง'])
                                    @break
                                @case ("ตั้งหนี้ลูกหนี้") 
                                    @include ('customer-debt.form-2', ['formMode' => 'create', 'debt_type'=>'ตั้งหนี้ลูกหนี้'])
                                    @break
                                @case ("ลดหนี้ลูกหนี้")  
                                    @include ('customer-debt.form-3', ['formMode' => 'create', 'debt_type'=>'ลดหนี้ลูกหนี้'])
                                    @break
                                @default  
                                    @include ('customer-debt.form', ['formMode' => 'create', 'debt_type'=>'ตั้งหนี้คงค้าง'])
                                    @break
                            @endswitch


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
