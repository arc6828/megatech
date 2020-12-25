@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('title','รับสินค้าสำเร็จรูป')
@section('background-tag','bg-yellow ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Receivefinal</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/receive-final/create') }}" class="btn btn-success btn-sm" title="Add New ReceiveFinal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <!-- <form method="GET" action="{{ url('/receive-final') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                        <br/> -->
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>รหัสเอกสาร</th> 
                                        <th>วันที่</th> 
                                        <th>รหัสใบเบิก</th>
                                        <th>รหัสสินค้าสำเร็จรูป</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>พนักงานผู้บันทึก</th>
                                        <th>สถานะ</th>
                                        <!-- <th>Remark</th><th>Total</th><th>Revision</th> -->
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($receivefinal as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>
                                            <a href="{{ url('/receive-final/' . $item->id) }}" title="รายละเอียดรับสินค้าสำเร็จรูป">
                                                {{ $item->code }}
                                            </a>
                                        </td>
                                        <td>{{ date_format( date_create( explode(" ", $item->created_at)[0]) ,"d-m-Y") }}</td>
                                        
                                        <td>{{ $item->issue_stock->code }}</td>
                                        <td>{{ $item->issue_stock->product->product_code }}</td>
                                        <td>{{ $item->issue_stock->product->product_name }}</td>
                                        <td>{{ $item->issue_stock->amount }}</td>
                                        <td>{{ $item->user->short_name }}</td>
                                        <td>
                                            @switch($item->status_id)
                                                @case("-1")
                                                    <span class="badge badge-pill badge-secondary">Void</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-pill badge-success">รับสินค้าสำเร็จรูป</span>								
                                                    @break
                                            @endswitch
                                        </td>
                                        <!-- <td>{{ $item->remark }}</td><td>{{ $item->total }}</td><td>{{ $item->revision }}</td> -->
                                        <!-- <td>
                                            <a href="{{ url('/receive-final/' . $item->id) }}" title="View ReceiveFinal"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/receive-final/' . $item->id . '/edit') }}" title="Edit ReceiveFinal"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/receive-final' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ReceiveFinal" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('/receive-final/create') }}" class="btn btn-success" title="Add New ReceiveFinal">
                                <i class="fa fa-plus" aria-hidden="true"></i> รับสินค้าสำเร็จรูป
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var table = $('#table').DataTable({          
            ordering: false,                  
            paging: false,
            info: false,          
            // searching: false,                
        }); //END DataTable
    });
    </script>

@endsection
