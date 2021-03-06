@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขผู้ติดต่อ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Contact #{{ $contact->id }}</div>
                    <div class="card-body">
                        @php
                            switch($contact->contact_type){
                                case("customer"):
                                    $id = $contact->customer_id;
                                    break;
                                case("supplier"):
                                    $id = $contact->supplier_id;
                                    break;
                            }
                        @endphp
                        <a href="{{ url('/') }}/{{$contact->contact_type}}/{{$id}}/edit" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a><br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/contact/' . $contact->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('contact.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
