@extends('layouts/argon-dashboard/theme')

@section('title','IssueStockDetail '.$issuestockdetail->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">IssueStockDetail {{ $issuestockdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/issue-stock-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/issue-stock-detail/' . $issuestockdetail->id . '/edit') }}" title="Edit IssueStockDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('issuestockdetail' . '/' . $issuestockdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete IssueStockDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $issuestockdetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $issuestockdetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $issuestockdetail->amount }} </td></tr><tr><th> Discount Price </th><td> {{ $issuestockdetail->discount_price }} </td></tr><tr><th> Total </th><td> {{ $issuestockdetail->total }} </td></tr><tr><th> Issue Stock Id </th><td> {{ $issuestockdetail->issue_stock_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
