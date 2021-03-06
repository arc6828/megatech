@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">SupplierPaymentDetail {{ $supplierpaymentdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/supplier-payment-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/supplier-payment-detail/' . $supplierpaymentdetail->id . '/edit') }}" title="Edit SupplierPaymentDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('supplierpaymentdetail' . '/' . $supplierpaymentdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierPaymentDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplierpaymentdetail->id }}</td>
                                    </tr>
                                    <tr><th> Doc Id </th><td> {{ $supplierpaymentdetail->doc_id }} </td></tr><tr><th> Supplier Billing Id </th><td> {{ $supplierpaymentdetail->supplier_billing_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
