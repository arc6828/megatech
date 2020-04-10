@extends('layouts/argon-dashboard/theme')

@section('title',  'ใบรับวางบิล'   )

@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                    
                        <a href="{{ url('/finance') }}?tab=debtor-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <a href="{{ url('/finance/supplier-billing/create') }}" class="btn btn-success btn-sm" title="Add New SupplierBilling">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/supplier-billing') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append ">
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
                                        <th>ยอดเงินรวม</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>ลูกค้า</th>
                                        <th>เลขที่รับชำระ</th>
                                        <th class="d-none">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($supplierbilling as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/finance/supplier-billing/' . $item->id) }}" title="View SupplierBilling">
                                                {{ $item->doc_no }}
                                            </a>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="text-right">{{number_format( $item->total , 2 )}}</td>
                                        <td>{{ $item->supplier->supplier_code }}</td>                                        
                                        
                                        <td>{{ $item->supplier->company_name }}</td>                                        
                                        <td>
                                            @if($item->supplier_payment)                                                
                                                <a href2="{{ url('/finance/supplier-payment/' . $item->supplier_payment->id) }}">{{ $item->supplier_payment->doc_no }}</a>
                                            @else
                                                <a class="d-none" href2="{{ url('/finance/supplier-payment/create?supplier_id=' . $item->supplier_id) }}&filter=billing-only" title="Payment"><button class="btn btn-warning btn-sm"><i class="fa fa-credit-card" aria-hidden="true"></i> รอการชำระ</button></a>                                            
                                                
                                                @switch($item->status)
                                                    @case("ready") 
                                                        <span class="badge badge-pill badge-warning">รอวางบิล</span>
                                                        @break
                                                    @case("wait-for-cheque") 
                                                        <span class="badge badge-pill badge-success">รอรับเช็ค-โอน</span>
                                                        @break
                                                    @case("delay") 
                                                        <span class="badge badge-pill badge-danger">เลื่อน</span>
                                                        @break
                                                @endswitch
                                            @endif
                                        
                                        </td>
                                        <td>
                                            <a href="{{ url('/finance/supplier-billing/' . $item->id) }}/pdf" title="View SupplierBilling"><button class="btn btn-success btn-sm d-none"><i class="fa fa-file-pdf" aria-hidden="true"></i> PDF</button></a>
                                            
                                            <a class="d-none"  href="{{ url('/finance/supplier-billing/' . $item->id) }}" title="View SupplierBilling"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a class="d-none" href="{{ url('/finance/supplier-billing/' . $item->id . '/edit') }}" title="Edit SupplierBilling"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form class="d-none" method="POST" action="{{ url('/finance/supplier-billing' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierBilling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $supplierbilling->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
