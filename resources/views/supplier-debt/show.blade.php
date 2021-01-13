@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">SupplierDebt {{ $supplierdebt->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/supplier-debt') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/supplier-debt/' . $supplierdebt->id . '/edit') }}" title="Edit SupplierDebt"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('supplierdebt' . '/' . $supplierdebt->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplierdebt->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $supplierdebt->doc_no }} </td></tr><tr><th> Date </th><td> {{ $supplierdebt->date }} </td></tr><tr><th> Supplier Id </th><td> {{ $supplierdebt->supplier_id }} </td></tr><tr><th> Discount </th><td> {{ $supplierdebt->discount }} </td></tr><tr><th> Amount </th><td> {{ $supplierdebt->amount }} </td></tr><tr><th> Vat Percent </th><td> {{ $supplierdebt->vat_percent }} </td></tr><tr><th> Vat </th><td> {{ $supplierdebt->vat }} </td></tr><tr><th> Total Before Vat </th><td> {{ $supplierdebt->total_before_vat }} </td></tr><tr><th> Total </th><td> {{ $supplierdebt->total }} </td></tr><tr><th> Tax Type Id </th><td> {{ $supplierdebt->tax_type_id }} </td></tr><tr><th> Completed At </th><td> {{ $supplierdebt->completed_at }} </td></tr><tr><th> Tax Category </th><td> {{ $supplierdebt->tax_category }} </td></tr><tr><th> Round </th><td> {{ $supplierdebt->round }} </td></tr><tr><th> Type Debt </th><td> {{ $supplierdebt->type_debt }} </td></tr><tr><th> Debt Duration </th><td> {{ $supplierdebt->debt_duration }} </td></tr><tr><th> User Id </th><td> {{ $supplierdebt->user_id }} </td></tr><tr><th> Role </th><td> {{ $supplierdebt->role }} </td></tr><tr><th> Reference </th><td> {{ $supplierdebt->reference }} </td></tr><tr><th> Zone Id </th><td> {{ $supplierdebt->zone_id }} </td></tr><tr><th> Zone Id </th><td> {{ $supplierdebt->zone_id }} </td></tr><tr><th> Cheque Id </th><td> {{ $supplierdebt->cheque_id }} </td></tr><tr><th> Payment Method </th><td> {{ $supplierdebt->payment_method }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
