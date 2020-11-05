@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบรับคืน')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-none">Create New ReturnInvoice</div>
                    <div class="card-body">
                        

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="GET" action="{{ url('/sales/return-invoice/create') }}" accept-charset="UTF-8" class="" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <form method="POST" action="{{ url('/sales/return-invoice') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include ('sales.return-invoice.form', ['formMode' => 'create'])

                </form>

            </div>
        </div>
    </div>
@endsection
