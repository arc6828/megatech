@extends('layouts/argon-dashboard/theme')

@section('title','Checklist')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Checklist</div>
                    <div class="card-body">
                        <a href="{{ url('/checklist/create') }}" class="btn btn-success btn-sm" title="Add New Checklist">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/checklist') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Billing Invoice</th><th>Billing Po</th><th>Billing Receipt</th><th>Billing Envelope</th><th>Billing Delivery</th><th>Billing Reference</th><th>Cheque Billing</th><th>Cheque Receipt</th><th>Cheque Po</th><th>Type</th><th>Customer Id</th><th>Supplier Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($checklist as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->billing_invoice }}</td><td>{{ $item->billing_po }}</td><td>{{ $item->billing_receipt }}</td><td>{{ $item->billing_envelope }}</td><td>{{ $item->billing_delivery }}</td><td>{{ $item->billing_reference }}</td><td>{{ $item->cheque_billing }}</td><td>{{ $item->cheque_receipt }}</td><td>{{ $item->cheque_po }}</td><td>{{ $item->type }}</td><td>{{ $item->customer_id }}</td><td>{{ $item->supplier_id }}</td>
                                        <td>
                                            <a href="{{ url('/checklist/' . $item->id) }}" title="View Checklist"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/checklist/' . $item->id . '/edit') }}" title="Edit Checklist"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/checklist' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Checklist" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $checklist->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
