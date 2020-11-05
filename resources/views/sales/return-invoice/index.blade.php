@extends('layouts/argon-dashboard/theme')

@section('title','Returninvoice')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Returninvoice</div>
                    <div class="card-body">
                        <a href="{{ url('/sales/return-invoice/create') }}" class="btn btn-success btn-sm" title="Add New ReturnInvoice">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/sales/return-invoice') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Code</th><th>Customer Id</th><th>Invoice Code</th><th>Tax Type Id</th><th>Sales Status Id</th><th>User Id</th><th>Remark</th><th>Total Before Vat</th><th>Vat</th><th>Vat Percent</th><th>Total After Vat</th><th>Revision</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($returninvoice as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code }}</td><td>{{ $item->customer_id }}</td><td>{{ $item->invoice_code }}</td><td>{{ $item->tax_type_id }}</td><td>{{ $item->sales_status_id }}</td><td>{{ $item->user_id }}</td><td>{{ $item->remark }}</td><td>{{ $item->total_before_vat }}</td><td>{{ $item->vat }}</td><td>{{ $item->vat_percent }}</td><td>{{ $item->total_after_vat }}</td><td>{{ $item->revision }}</td>
                                        <td>
                                            <a href="{{ url('/sales/return-invoice/' . $item->id) }}" title="View ReturnInvoice"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/sales/return-invoice/' . $item->id . '/edit') }}" title="Edit ReturnInvoice"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/sales/return-invoice' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnInvoice" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $returninvoice->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
