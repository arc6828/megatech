@extends('layouts/argon-dashboard/theme')

@section('title',  request('debt_type')   )

@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">CustomerBilling {{ $customerbilling->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/customer-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/customer-billing/' . $customerbilling->id . '/edit') }}" title="Edit CustomerBilling"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerbilling' . '/' . $customerbilling->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerBilling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customerbilling->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $customerbilling->doc_no }} </td></tr><tr><th> Total </th><td> {{ $customerbilling->total }} </td></tr><tr><th> Customer Id </th><td> {{ $customerbilling->customer_id }} </td></tr><tr><th> Condition Billing </th><td> {{ $customerbilling->condition_billing }} </td></tr><tr><th> Condition Cheque </th><td> {{ $customerbilling->condition_cheque }} </td></tr><tr><th> Date Billing </th><td> {{ $customerbilling->date_billing }} </td></tr><tr><th> Date Cheque </th><td> {{ $customerbilling->date_cheque }} </td></tr><tr><th> Remark </th><td> {{ $customerbilling->remark }} </td></tr><tr><th> User Id </th><td> {{ $customerbilling->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
