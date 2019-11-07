@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">CustomerPayment {{ $customerpayment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/customer-payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/customer-payment/' . $customerpayment->id . '/edit') }}" title="Edit CustomerPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerpayment' . '/' . $customerpayment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customerpayment->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $customerpayment->doc_no }} </td></tr><tr><th> Customer Id </th><td> {{ $customerpayment->customer_id }} </td></tr><tr><th> Role </th><td> {{ $customerpayment->role }} </td></tr><tr><th> Remark </th><td> {{ $customerpayment->remark }} </td></tr><tr><th> Round </th><td> {{ $customerpayment->round }} </td></tr><tr><th> Customer Billing Id </th><td> {{ $customerpayment->customer_billing_id }} </td></tr><tr><th> Discount </th><td> {{ $customerpayment->discount }} </td></tr><tr><th> Debt Total </th><td> {{ $customerpayment->debt_total }} </td></tr><tr><th> Cash </th><td> {{ $customerpayment->cash }} </td></tr><tr><th> Credit </th><td> {{ $customerpayment->credit }} </td></tr><tr><th> Tax </th><td> {{ $customerpayment->tax }} </td></tr><tr><th> Payment Total </th><td> {{ $customerpayment->payment_total }} </td></tr><tr><th> User Id </th><td> {{ $customerpayment->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
