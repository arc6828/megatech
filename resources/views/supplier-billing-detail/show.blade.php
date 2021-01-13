@extends('layouts/argon-dashboard/theme')

@section('title',  request('debt_type')   )
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SupplierBillingDetail {{ $supplierbillingdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/supplier-billing-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/supplier-billing-detail/' . $supplierbillingdetail->id . '/edit') }}" title="Edit SupplierBillingDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('supplierbillingdetail' . '/' . $supplierbillingdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierBillingDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplierbillingdetail->id }}</td>
                                    </tr>
                                    <tr><th> Doc Id </th><td> {{ $supplierbillingdetail->doc_id }} </td></tr><tr><th> Supplier Billing Id </th><td> {{ $supplierbillingdetail->supplier_billing_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
