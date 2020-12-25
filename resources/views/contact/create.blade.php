@extends('layouts/argon-dashboard/theme')

@section('title','สร้างผู้ติดต่อ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Contact</div>
                    <div class="card-body">
                        @php
                        $contact_type = request('customer_id')?'customer':'supplier';
                        switch($contact_type){
                            case("customer"):
                                $id = request('customer_id');
                                break;
                            case("supplier"):
                                $id = request('supplier_id');
                                break;
                        }
                        @endphp
                        <a href="{{ url('/') }}/{{$contact_type}}/{{$id}}/edit" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/contact') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('contact.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
