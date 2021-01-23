@extends('layouts/argon-dashboard/theme')

@section('title','AdjustStock '.$adjuststock->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">AdjustStock {{ $adjuststock->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/adjust-stock') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/adjust-stock/' . $adjuststock->id . '/edit') }}" title="Edit AdjustStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('adjuststock' . '/' . $adjuststock->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete AdjustStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $adjuststock->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $adjuststock->code }} </td></tr><tr><th> Reference </th><td> {{ $adjuststock->reference }} </td></tr><tr><th> Adjust Type </th><td> {{ $adjuststock->adjust_type }} </td></tr><tr><th> Status Id </th><td> {{ $adjuststock->status_id }} </td></tr><tr><th> User Id </th><td> {{ $adjuststock->user_id }} </td></tr><tr><th> Adjust Definition Id </th><td> {{ $adjuststock->adjust_definition_id }} </td></tr><tr><th> Remark </th><td> {{ $adjuststock->remark }} </td></tr><tr><th> Total </th><td> {{ $adjuststock->total }} </td></tr><tr><th> Revision </th><td> {{ $adjuststock->revision }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
