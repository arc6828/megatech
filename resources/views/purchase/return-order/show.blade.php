@extends('layouts/argon-dashboard/theme')

@section('title','ReturnOrder '.$returnorder->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ReturnOrder {{ $returnorder->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/purchase/return-order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/purchase/return-order/' . $returnorder->id . '/edit') }}" title="Edit ReturnOrder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('purchase/returnorder' . '/' . $returnorder->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnOrder" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $returnorder->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $returnorder->code }} </td></tr><tr><th> Supplier Id </th><td> {{ $returnorder->supplier_id }} </td></tr><tr><th> Purchase Receive Code </th><td> {{ $returnorder->purchase_receive_code }} </td></tr><tr><th> Tax Type Id </th><td> {{ $returnorder->tax_type_id }} </td></tr><tr><th> Purchase Status Id </th><td> {{ $returnorder->purchase_status_id }} </td></tr><tr><th> User Id </th><td> {{ $returnorder->user_id }} </td></tr><tr><th> Remark </th><td> {{ $returnorder->remark }} </td></tr><tr><th> Total Before Vat </th><td> {{ $returnorder->total_before_vat }} </td></tr><tr><th> Vat </th><td> {{ $returnorder->vat }} </td></tr><tr><th> Vat Percent </th><td> {{ $returnorder->vat_percent }} </td></tr><tr><th> Total After Vat </th><td> {{ $returnorder->total_after_vat }} </td></tr><tr><th> Revision </th><td> {{ $returnorder->revision }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
