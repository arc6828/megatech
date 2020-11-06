@extends('layouts/argon-dashboard/theme')

@section('title','Create New ReturnOrder')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- <div class="card-header">Create New ReturnOrder</div> -->
                    <div class="card-body">
                        <form method="GET" action="{{ url('/purchase/return-order/create') }}" accept-charset="UTF-8" class="" role="search">
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

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ url('/purchase/return-order') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include ('purchase.return-order.form', ['formMode' => 'create'])

                </form>
            </div>
        </div>
    </div>
@endsection
