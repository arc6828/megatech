@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">GaurdStock {{ $gaurdstock->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/gaurd-stock') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/gaurd-stock/' . $gaurdstock->id . '/edit') }}" title="Edit GaurdStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('gaurdstock' . '/' . $gaurdstock->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete GaurdStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $gaurdstock->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $gaurdstock->code }} </td></tr><tr><th> Type </th><td> {{ $gaurdstock->type }} </td></tr><tr><th> Amount </th><td> {{ $gaurdstock->amount }} </td></tr><tr><th> Amount In Stock </th><td> {{ $gaurdstock->amount_in_stock }} </td></tr><tr><th> Pending In </th><td> {{ $gaurdstock->pending_in }} </td></tr><tr><th> Pending Out </th><td> {{ $gaurdstock->pending_out }} </td></tr><tr><th> Product Id </th><td> {{ $gaurdstock->product_id }} </td></tr><tr><th> Remark </th><td> {{ $gaurdstock->remark }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
