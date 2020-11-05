@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขใบรับคืน #'.$returninvoice->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="">
                    <!-- <div class="card-header d-none">Edit ReturnInvoice #{{ $returninvoice->id }}</div> -->
                    <div class="">
                        <!-- <a href="{{ url('/sales/return-invoice') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/sales/return-invoice/' . $returninvoice->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('sales.return-invoice.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
