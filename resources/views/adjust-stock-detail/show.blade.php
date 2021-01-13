@extends('layouts/argon-dashboard/theme')

@section('title','AdjustStockDetail '.$adjuststockdetail->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">AdjustStockDetail {{ $adjuststockdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/adjust-stock-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/adjust-stock-detail/' . $adjuststockdetail->id . '/edit') }}" title="Edit AdjustStockDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('adjuststockdetail' . '/' . $adjuststockdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete AdjustStockDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $adjuststockdetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $adjuststockdetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $adjuststockdetail->amount }} </td></tr><tr><th> Discount Price </th><td> {{ $adjuststockdetail->discount_price }} </td></tr><tr><th> Total </th><td> {{ $adjuststockdetail->total }} </td></tr><tr><th> Adjust Id </th><td> {{ $adjuststockdetail->adjust_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
