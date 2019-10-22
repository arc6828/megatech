@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">BankAccount {{ $bankaccount->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/bank-account') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/bank-account/' . $bankaccount->id . '/edit') }}" title="Edit BankAccount"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('bankaccount' . '/' . $bankaccount->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete BankAccount" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $bankaccount->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $bankaccount->code }} </td></tr><tr><th> Name </th><td> {{ $bankaccount->name }} </td></tr><tr><th> Branch </th><td> {{ $bankaccount->branch }} </td></tr><tr><th> Category Id </th><td> {{ $bankaccount->category_id }} </td></tr><tr><th> Account No </th><td> {{ $bankaccount->account_no }} </td></tr><tr><th> Balance Bring Forword </th><td> {{ $bankaccount->balance_bring_forword }} </td></tr><tr><th> Balance </th><td> {{ $bankaccount->balance }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
