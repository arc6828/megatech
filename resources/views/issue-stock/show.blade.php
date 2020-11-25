@extends('layouts/argon-dashboard/theme')

@section('title','IssueStock '.$issuestock->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">IssueStock {{ $issuestock->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/issue-stock') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/issue-stock/' . $issuestock->id . '/edit') }}" title="Edit IssueStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('issuestock' . '/' . $issuestock->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete IssueStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $issuestock->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $issuestock->code }} </td></tr><tr><th> Product Id </th><td> {{ $issuestock->product_id }} </td></tr><tr><th> Amount </th><td> {{ $issuestock->amount }} </td></tr><tr><th> Status Id </th><td> {{ $issuestock->status_id }} </td></tr><tr><th> User Id </th><td> {{ $issuestock->user_id }} </td></tr><tr><th> Remark </th><td> {{ $issuestock->remark }} </td></tr><tr><th> Total </th><td> {{ $issuestock->total }} </td></tr><tr><th> Revision </th><td> {{ $issuestock->revision }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
