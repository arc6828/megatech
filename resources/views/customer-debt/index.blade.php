@extends('layouts/argon-dashboard/theme')
@section('title','หนี้ลูกค้า')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Customerdebt</div>
                    <div class="card-body">
                        <a href="{{ url('/customer-debt/create') }}" class="btn btn-success btn-sm" title="Add New CustomerDebt">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/customer-debt') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Doc No</th><th>Date</th><th>Customer Id</th><th>Discount</th><th>Amount</th><th>Vat Percent</th><th>Vat</th><th>Total Before Vat</th><th>Total</th><th>Tax Type Id</th><th>Completed At</th><th>Tax Category</th><th>Round</th><th>Type Debt</th><th>Debt Duration</th><th>User Id</th><th>Role</th><th>Reference</th><th>Zone Id</th><th>Zone Id</th><th>Cheque Id</th><th>Payment Method</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customerdebt as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->doc_no }}</td><td>{{ $item->date }}</td><td>{{ $item->customer_id }}</td><td>{{ $item->discount }}</td><td>{{ $item->amount }}</td><td>{{ $item->vat_percent }}</td><td>{{ $item->vat }}</td><td>{{ $item->total_before_vat }}</td><td>{{ $item->total }}</td><td>{{ $item->tax_type_id }}</td><td>{{ $item->completed_at }}</td><td>{{ $item->tax_category }}</td><td>{{ $item->round }}</td><td>{{ $item->type_debt }}</td><td>{{ $item->debt_duration }}</td><td>{{ $item->user_id }}</td><td>{{ $item->role }}</td><td>{{ $item->reference }}</td><td>{{ $item->zone_id }}</td><td>{{ $item->zone_id }}</td><td>{{ $item->cheque_id }}</td><td>{{ $item->payment_method }}</td>
                                        <td>
                                            <a href="{{ url('/customer-debt/' . $item->id) }}" title="View CustomerDebt"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/customer-debt/' . $item->id . '/edit') }}" title="Edit CustomerDebt"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/customer-debt' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $customerdebt->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
