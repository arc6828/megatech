@extends('layouts/argon-dashboard/theme')

@section('title','ReturnInvoice '.$returninvoice->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReturnInvoice {{ $returninvoice->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sales/return-invoice') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sales/return-invoice/' . $returninvoice->id . '/edit') }}" title="Edit ReturnInvoice"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sales/returninvoice' . '/' . $returninvoice->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnInvoice" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $returninvoice->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $returninvoice->code }} </td></tr><tr><th> Customer Id </th><td> {{ $returninvoice->customer_id }} </td></tr><tr><th> Invoice Code </th><td> {{ $returninvoice->invoice_code }} </td></tr><tr><th> Tax Type Id </th><td> {{ $returninvoice->tax_type_id }} </td></tr><tr><th> Sales Status Id </th><td> {{ $returninvoice->sales_status_id }} </td></tr><tr><th> User Id </th><td> {{ $returninvoice->user_id }} </td></tr><tr><th> Remark </th><td> {{ $returninvoice->remark }} </td></tr><tr><th> Total Before Vat </th><td> {{ $returninvoice->total_before_vat }} </td></tr><tr><th> Vat </th><td> {{ $returninvoice->vat }} </td></tr><tr><th> Vat Percent </th><td> {{ $returninvoice->vat_percent }} </td></tr><tr><th> Total After Vat </th><td> {{ $returninvoice->total_after_vat }} </td></tr><tr><th> Revision </th><td> {{ $returninvoice->revision }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
