@extends('layouts/argon-dashboard/theme')

@section('title','ReceiveFinalDetail '.$receivefinaldetail->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReceiveFinalDetail {{ $receivefinaldetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/receive-final-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/receive-final-detail/' . $receivefinaldetail->id . '/edit') }}" title="Edit ReceiveFinalDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('receivefinaldetail' . '/' . $receivefinaldetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReceiveFinalDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $receivefinaldetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $receivefinaldetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $receivefinaldetail->amount }} </td></tr><tr><th> Discount Price </th><td> {{ $receivefinaldetail->discount_price }} </td></tr><tr><th> Total </th><td> {{ $receivefinaldetail->total }} </td></tr><tr><th> Receive Final Id </th><td> {{ $receivefinaldetail->receive_final_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
