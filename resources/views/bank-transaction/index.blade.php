@extends('layouts/argon-dashboard/theme')

@section('title','ธุรกรรมธนาคาร')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ธุรกรรมธนาคาร ({{ request('transaction_code') }})</div>
                    <div class="card-body">
                        <a href="{{ url('/finance') }}?tab=bank-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/bank-transaction/create') }}?transaction_code={{ request('transaction_code') }}" class="btn btn-success btn-sm" title="Add New BankTransaction">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/bank-transaction') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>Bank Code</th>
                                        <th>Type</th>
                                        <th>Amount</th><th>Balance</th><th>User Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banktransaction as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->bank_code }}</td>
                                        <td>{{ $item->transaction_code }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->balance }}</td>
                                        <td>{{ $item->user->short_name }}</td>
                                        <td>
                                            <a href="{{ url('/finance/bank-transaction/' . $item->id) }}" title="View BankTransaction"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/bank-transaction/' . $item->id . '/edit') }}" title="Edit BankTransaction"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/bank-transaction' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete BankTransaction" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $banktransaction->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
