@extends('layouts/argon-dashboard/theme')

@section('title','Edit FullCalendar #'.$fullcalendar->id)

@section('content')
    @php
        $mode = ""; 
        if(! empty( request('customer_id') ) ){ //CUSTOMER
            $mode = "customer";
        }else if(! empty( request('supplier_id') ) ){ //SUPPLIER
            $mode = "supplier";
        }else{

        }
    @endphp
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit FullCalendar #{{ $fullcalendar->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/full-calendar') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/full-calendar/' . $fullcalendar->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('full-calendar.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
