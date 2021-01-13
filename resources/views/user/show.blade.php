@extends('layouts/argon-dashboard/theme')

@section('title',  'รายละเอียดผู้ใช้'  )
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title') {{ $user->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if( Auth::user()->role == "admin" )
                        <a href="{{ url('/user/' . $user->id . '/edit') }}" title="Edit SupplierPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('user' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $user->name }} </td></tr>
                                    <tr><th> Short Name </th><td> {{ $user->short_name }} </td></tr>
                                    <tr><th> Role </th><td> {{ $user->role }} </td></tr>
                                    <tr><th> Email </th><td> {{ $user->email }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

               
            </div>
        </div>
    </div>
@endsection
