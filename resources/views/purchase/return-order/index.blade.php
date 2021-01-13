@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('title','ใบส่งคืนสินค้า')

@section('background-tag','bg-success')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Returnorder</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/purchase/return-order/create') }}" class="btn btn-success btn-sm" title="Add New ReturnOrder">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <form method="GET" action="{{ url('/purchase/return-order') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <!-- <th>#</th> -->
                                        <th>รหัสส่งคืนสินค้า</th>
                                        <th>วันที่</th>
                                        <th>รหัสเจ้าหนี้</th>
                                        <th>ชื่อบริษัท</th>
                                        <th>ยอดรวม</th>
                                        <!-- <th>Tax Type Id</th> -->
                                        <th>สถานะ</th>
                                        <!-- <th>พนักงาน</th> -->
                                        <!-- <th>Remark</th> -->
                                        <!-- <th>Total Before Vat</th>
                                        <th>Vat</th>
                                        <th>Vat Percent</th> -->
                                        <th>รหัสใบรับสินค้า</th>
                                        <!-- <th>Revision</th>
                                        <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($returnorder as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>
                                            <a href="{{ url('/purchase/return-order/' . $item->id).'' }}" class="">                                            
                                                {{ $item->code }}
                                            </a>
                                            
                                        </td>
                                        <td>{{ date_format(date_create(explode(" ",$item->created_at)[0] ), "d-m-Y") }}</td>
                                        
                                        <td>{{ $item->supplier->supplier_code }}</td>
                                        <td>{{ $item->supplier->company_name }}</td>
                                        
                                        <td>{{ number_format($item->total_after_vat,2) }}</td>
                                        <!-- <td>{{ $item->tax_type_id }}</td> -->                                        
                                        <td>
                                            @switch($item->purchase_status_id)
                                                @case("-1")
                                                    <span class="badge badge-pill badge-secondary">Void</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-pill badge-success">Normal</span>								
                                                    @break
                                            @endswitch
                                        </td>
                                        <!-- <td>{{ $item->user->short_name }}</td> -->
                                        
                                        <td>{{ $item->purchase_receive_code }}</td>
                                        <!-- <td>{{ $item->remark }}</td>
                                        <td>{{ $item->total_before_vat }}</td>
                                        <td>{{ $item->vat }}</td>
                                        <td>{{ $item->vat_percent }}</td> -->
                                        <!-- <td>{{ $item->revision }}</td> -->
                                        <!-- <td>
                                            <a href="{{ url('/purchase/return-order/' . $item->id) }}" title="View ReturnOrder"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/purchase/return-order/' . $item->id . '/edit') }}" title="Edit ReturnOrder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/purchase/return-order' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnOrder" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('purchase') }}" class="btn btn-outline-success " title="Add New ReturnOrder">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> back
                            </a>
                            <a href="{{ url('/purchase/return-order/create') }}" class="btn btn-success " title="Add New ReturnOrder">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
