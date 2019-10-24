@extends('layouts/argon-dashboard/theme')
@section('title','หนี้ลูกค้า')
@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">CustomerDebt {{ $customerdebt->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/customer-debt') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customer-debt/' . $customerdebt->id . '/edit') }}" title="Edit CustomerDebt"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerdebt' . '/' . $customerdebt->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customerdebt->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $customerdebt->doc_no }} </td></tr><tr><th> Date </th><td> {{ $customerdebt->date }} </td></tr><tr><th> Customer Id </th><td> {{ $customerdebt->customer_id }} </td></tr><tr><th> Discount </th><td> {{ $customerdebt->discount }} </td></tr><tr><th> Amount </th><td> {{ $customerdebt->amount }} </td></tr><tr><th> Vat Percent </th><td> {{ $customerdebt->vat_percent }} </td></tr><tr><th> Vat </th><td> {{ $customerdebt->vat }} </td></tr><tr><th> Total Before Vat </th><td> {{ $customerdebt->total_before_vat }} </td></tr><tr><th> Total </th><td> {{ $customerdebt->total }} </td></tr><tr><th> Tax Type Id </th><td> {{ $customerdebt->tax_type_id }} </td></tr><tr><th> Completed At </th><td> {{ $customerdebt->completed_at }} </td></tr><tr><th> Tax Category </th><td> {{ $customerdebt->tax_category }} </td></tr><tr><th> Round </th><td> {{ $customerdebt->round }} </td></tr><tr><th> Type Debt </th><td> {{ $customerdebt->type_debt }} </td></tr><tr><th> Debt Duration </th><td> {{ $customerdebt->debt_duration }} </td></tr><tr><th> User Id </th><td> {{ $customerdebt->user_id }} </td></tr><tr><th> Role </th><td> {{ $customerdebt->role }} </td></tr><tr><th> Reference </th><td> {{ $customerdebt->reference }} </td></tr><tr><th> Zone Id </th><td> {{ $customerdebt->zone_id }} </td></tr><tr><th> Zone Id </th><td> {{ $customerdebt->zone_id }} </td></tr><tr><th> Cheque Id </th><td> {{ $customerdebt->cheque_id }} </td></tr><tr><th> Payment Method </th><td> {{ $customerdebt->payment_method }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
