@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Customerpayment</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/customer-payment/create') }}" class="btn btn-success btn-sm" title="Add New CustomerPayment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/customer-payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Doc No</th><th>Customer Id</th><th>Role</th><th>Remark</th><th>Round</th><th>Customer Billing Id</th><th>Discount</th><th>Debt Total</th><th>Cash</th><th>Credit</th><th>Tax</th><th>Payment Total</th><th>User Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customerpayment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->doc_no }}</td><td>{{ $item->customer_id }}</td><td>{{ $item->role }}</td><td>{{ $item->remark }}</td><td>{{ $item->round }}</td><td>{{ $item->customer_billing_id }}</td><td>{{ $item->discount }}</td><td>{{ $item->debt_total }}</td><td>{{ $item->cash }}</td><td>{{ $item->credit }}</td><td>{{ $item->tax }}</td><td>{{ $item->payment_total }}</td><td>{{ $item->user_id }}</td>
                                        <td>
                                            <a href="{{ url('/finance/customer-payment/' . $item->id) }}" title="View CustomerPayment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/customer-payment/' . $item->id . '/edit') }}" title="Edit CustomerPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/customer-payment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $customerpayment->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
