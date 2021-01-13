@extends('layouts/argon-dashboard/theme')

@section('title','ReturnOrderDetail '.$returnorderdetail->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReturnOrderDetail {{ $returnorderdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/purchase/return-order-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/purchase/return-order-detail/' . $returnorderdetail->id . '/edit') }}" title="Edit ReturnOrderDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('purchase/returnorderdetail' . '/' . $returnorderdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnOrderDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $returnorderdetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $returnorderdetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $returnorderdetail->amount }} </td></tr><tr><th> Discount Price </th><td> {{ $returnorderdetail->discount_price }} </td></tr><tr><th> Total </th><td> {{ $returnorderdetail->total }} </td></tr><tr><th> Return Order Id </th><td> {{ $returnorderdetail->return_order_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
