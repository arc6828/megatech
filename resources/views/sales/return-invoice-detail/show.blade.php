@extends('layouts/argon-dashboard/theme')

@section('title','ReturnInvoiceDetail '.$returninvoicedetail->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReturnInvoiceDetail {{ $returninvoicedetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sales/return-invoice-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sales/return-invoice-detail/' . $returninvoicedetail->id . '/edit') }}" title="Edit ReturnInvoiceDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sales/returninvoicedetail' . '/' . $returninvoicedetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnInvoiceDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $returninvoicedetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $returninvoicedetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $returninvoicedetail->amount }} </td></tr><tr><th> Discount Price </th><td> {{ $returninvoicedetail->discount_price }} </td></tr><tr><th> Total </th><td> {{ $returninvoicedetail->total }} </td></tr><tr><th> Return Invoice Id </th><td> {{ $returninvoicedetail->return_invoice_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
