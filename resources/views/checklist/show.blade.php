@extends('layouts/argon-dashboard/theme')

@section('title','Checklist '.$checklist->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Checklist {{ $checklist->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/checklist') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/checklist/' . $checklist->id . '/edit') }}" title="Edit Checklist"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('checklist' . '/' . $checklist->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Checklist" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $checklist->id }}</td>
                                    </tr>
                                    <tr><th> Billing Invoice </th><td> {{ $checklist->billing_invoice }} </td></tr><tr><th> Billing Po </th><td> {{ $checklist->billing_po }} </td></tr><tr><th> Billing Receipt </th><td> {{ $checklist->billing_receipt }} </td></tr><tr><th> Billing Envelope </th><td> {{ $checklist->billing_envelope }} </td></tr><tr><th> Billing Delivery </th><td> {{ $checklist->billing_delivery }} </td></tr><tr><th> Billing Reference </th><td> {{ $checklist->billing_reference }} </td></tr><tr><th> Cheque Billing </th><td> {{ $checklist->cheque_billing }} </td></tr><tr><th> Cheque Receipt </th><td> {{ $checklist->cheque_receipt }} </td></tr><tr><th> Cheque Po </th><td> {{ $checklist->cheque_po }} </td></tr><tr><th> Type </th><td> {{ $checklist->type }} </td></tr><tr><th> Customer Id </th><td> {{ $checklist->customer_id }} </td></tr><tr><th> Supplier Id </th><td> {{ $checklist->supplier_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
