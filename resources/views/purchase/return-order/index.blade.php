@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','ส่งคืนสินค้า')

@section('title','Returnorder')

@section('background-tag','bg-success')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Returnorder</div>
                    <div class="card-body">
                        <a href="{{ url('/purchase/return-order/create') }}" class="btn btn-success btn-sm" title="Add New ReturnOrder">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/purchase/return-order') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Code</th><th>Supplier Id</th><th>Purchase Receive Code</th><th>Tax Type Id</th><th>Purchase Status Id</th><th>User Id</th><th>Remark</th><th>Total Before Vat</th><th>Vat</th><th>Vat Percent</th><th>Total After Vat</th><th>Revision</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($returnorder as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code }}</td><td>{{ $item->supplier_id }}</td><td>{{ $item->purchase_receive_code }}</td><td>{{ $item->tax_type_id }}</td><td>{{ $item->purchase_status_id }}</td><td>{{ $item->user_id }}</td><td>{{ $item->remark }}</td><td>{{ $item->total_before_vat }}</td><td>{{ $item->vat }}</td><td>{{ $item->vat_percent }}</td><td>{{ $item->total_after_vat }}</td><td>{{ $item->revision }}</td>
                                        <td>
                                            <a href="{{ url('/purchase/return-order/' . $item->id) }}" title="View ReturnOrder"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/purchase/return-order/' . $item->id . '/edit') }}" title="Edit ReturnOrder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/purchase/return-order' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnOrder" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $returnorder->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
