@extends('layouts/argon-dashboard/theme')

@section('title','Adjuststock')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Adjuststock</div>
                    <div class="card-body">
                        <a href="{{ url('/adjust-stock/create') }}" class="btn btn-success btn-sm" title="Add New AdjustStock">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/adjust-stock') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Code</th><th>Reference</th><th>Adjust Type</th><th>Status Id</th><th>User Id</th><th>Adjust Definition Id</th><th>Remark</th><th>Total</th><th>Revision</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($adjuststock as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code }}</td><td>{{ $item->reference }}</td><td>{{ $item->adjust_type }}</td><td>{{ $item->status_id }}</td><td>{{ $item->user_id }}</td><td>{{ $item->adjust_definition_id }}</td><td>{{ $item->remark }}</td><td>{{ $item->total }}</td><td>{{ $item->revision }}</td>
                                        <td>
                                            <a href="{{ url('/adjust-stock/' . $item->id) }}" title="View AdjustStock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/adjust-stock/' . $item->id . '/edit') }}" title="Edit AdjustStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/adjust-stock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete AdjustStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $adjuststock->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
