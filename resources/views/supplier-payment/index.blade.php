@extends('layouts/argon-dashboard/theme')

@section('title',  'การรับชำระเงิน'  )
@section('content')
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        <a href="{{ url('/finance') }}?tab=debtor-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <a href="{{ url('/finance/supplier-payment/create') }}" class="btn btn-success btn-sm" title="Add New SupplierPayment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/supplier-payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>เลขที่เอกสาร</th>
                                        <th>วันที่</th>                                        
                                        <th>ยอดรวมรับชำระหนี้</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($supplierpayment as $item)
                                    <tr>
                                        <td>{{ $item->doc_no }}</td>
                                        <td>{{ $item->created_at }}</td>                                       
                                        <td>{{ number_format($item->payment_total,2) }}</td>                                    
                                        <td>{{ $item->supplier->supplier_code }} {{ $item->supplier->company_name }}</td>
                                        
                                        <td>
                                            <a href="{{ url('/finance/supplier-payment/' . $item->id) }}" title="View SupplierPayment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/supplier-payment/' . $item->id . '/edit') }}" title="Edit SupplierPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/supplier-payment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $supplierpayment->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
