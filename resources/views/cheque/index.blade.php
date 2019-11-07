@extends('layouts/argon-dashboard/theme')

@section('title','ทะเบียนเช็ค : '.request('cheque_type_code'))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        <a href="{{ url('/finance') }}?tab=cheque-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>                        
                        <a href="{{ url('/finance/cheque/create') }}?cheque_type_code={{request('cheque_type_code')}}" class="btn btn-success btn-sm" title="Add New Cheque">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/cheque') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group input-group-sm">
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
                                        <th class="d-none">Cheque Type</th>
                                        <th>Cheque No</th>
                                        <th>Total</th>
                                        
                                        <th>Bank Account Id</th>
                                        <th>Status</th>
                                        <th class="d-none">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cheque as $item)
                                    <tr>
                                        <td>{{ $item->cheque_date }}</td>
                                        <td class="d-none">{{ $item->cheque_type_code }}</td>
                                        <td><a href="{{ url('/finance/cheque') }}/{{ $item->id }}">{{ $item->cheque_no }}</a></td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->bank_account->code }} {{ $item->bank_account->name }}</td>

                                        
                                        <td>
                                            @if($item->status =="pending")
                                            <button class="btn btn-warning btn-sm">ตรวจสอบเช็ค</button>
                                            @else                                            
                                            {{ $item->status }}
                                            @endif
                                        </td>
                                        
                                        <td class="d-none">
                                            <a href="{{ url('/finance/cheque/' . $item->id) }}" title="View Cheque"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/cheque/' . $item->id . '/edit') }}" title="Edit Cheque"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/cheque' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Cheque" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $cheque->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection