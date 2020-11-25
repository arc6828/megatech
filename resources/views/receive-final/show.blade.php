@extends('layouts/argon-dashboard/theme')

@section('title','ReceiveFinal '.$receivefinal->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReceiveFinal {{ $receivefinal->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/receive-final') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/receive-final/' . $receivefinal->id . '/edit') }}" title="Edit ReceiveFinal"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('receivefinal' . '/' . $receivefinal->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReceiveFinal" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $receivefinal->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $receivefinal->code }} </td></tr><tr><th> Is Code </th><td> {{ $receivefinal->is_code }} </td></tr><tr><th> Status Id </th><td> {{ $receivefinal->status_id }} </td></tr><tr><th> User Id </th><td> {{ $receivefinal->user_id }} </td></tr><tr><th> Remark </th><td> {{ $receivefinal->remark }} </td></tr><tr><th> Total </th><td> {{ $receivefinal->total }} </td></tr><tr><th> Revision </th><td> {{ $receivefinal->revision }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
