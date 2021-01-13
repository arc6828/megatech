@extends('layouts/argon-dashboard/theme')

@section('title',  request('debt_type')   )
@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New SupplierBillingDetail</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/supplier-billing-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/supplier-billing-detail') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('supplier-billing-detail.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
