@extends('layouts/argon-dashboard/theme')

@section('title','แสดงทะเบียนเช็ค')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@yield('title') {{ $cheque->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/cheque') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/cheque/' . $cheque->id . '/edit') }}" title="Edit Cheque"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('cheque' . '/' . $cheque->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Cheque" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $cheque->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $cheque->doc_no }} </td></tr><tr><th> Cheque Date </th><td> {{ $cheque->cheque_date }} </td></tr><tr><th> Cheque Type </th><td> {{ $cheque->cheque_type }} </td></tr><tr><th> Cheque No </th><td> {{ $cheque->cheque_no }} </td></tr><tr><th> Total </th><td> {{ $cheque->total }} </td></tr><tr><th> Bank Fee </th><td> {{ $cheque->bank_fee }} </td></tr><tr><th> Bank Account Id </th><td> {{ $cheque->bank_account_id }} </td></tr><tr><th> Passed Cheque Date </th><td> {{ $cheque->passed_cheque_date }} </td></tr><tr><th> Reference </th><td> {{ $cheque->reference }} </td></tr><tr><th> Status </th><td> {{ $cheque->status }} </td></tr><tr><th> User Id </th><td> {{ $cheque->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
