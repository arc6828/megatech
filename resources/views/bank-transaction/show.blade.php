@extends('layouts/argon-dashboard/theme')

@section('title','transaction')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">BankTransaction {{ $banktransaction->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/bank-transaction') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/bank-transaction/' . $banktransaction->id . '/edit') }}" title="Edit BankTransaction"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('banktransaction' . '/' . $banktransaction->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete BankTransaction" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $banktransaction->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $banktransaction->code }} </td></tr><tr><th> Amount </th><td> {{ $banktransaction->amount }} </td></tr><tr><th> Balance </th><td> {{ $banktransaction->balance }} </td></tr><tr><th> Remark </th><td> {{ $banktransaction->remark }} </td></tr><tr><th> User Id </th><td> {{ $banktransaction->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
