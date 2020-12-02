@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('title','ปรับปรุงเพิ่ม-ลดสินค้า')
@section('background-tag','bg-yellow ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Adjuststock</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/adjust-stock/create') }}" class="btn btn-success btn-sm" title="Add New AdjustStock">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <!-- <form method="GET" action="{{ url('/adjust-stock') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>อ้างอิง</th>
                                        <th>พนักงานผู้บันทึก</th>                                        
                                        <th>รหัสการปรับปรุง</th>
                                        <th>หมายเหตุ</th>
                                        <th>ชนิด</th>
                                        <th>สถานะ</th>
                                        <!-- <th>Total</th>
                                        <th>Revision</th>
                                        <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($adjuststock as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>
                                            <a href="{{ url('/adjust-stock/' . $item->id) }}" title="View AdjustStock">
                                                {{ $item->code }}
                                            </a>
                                        </td>
                                        <td>{{ $item->reference }}</td>
                                        
                                        <td>{{ $item->user->short_name }}</td>
                                        
                                        <td>{{ $item->adjust_definition_id }}</td>
                                        <td>{{ $item->remark }}</td>
                                        <td>
                                            @switch($item->adjust_type)
                                                @case("-1")
                                                    <span class="badge badge-pill badge-warning">ปรับลด</span>
                                                    @break
                                                @case("1")
                                                    <span class="badge badge-pill badge-primary">ปรับเพิ่ม</span>
                                            @endswitch    
                                        </td>
                                        <td>
                                            @switch($item->status_id)
                                                @case("-1")
                                                    <span class="badge badge-pill badge-secondary">Void</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-pill badge-success">Normal</span>
                                            @endswitch
                                        </td>
                                        <!-- <td>{{ $item->total }}</td>
                                        <td>{{ $item->revision }}</td> -->
                                        <!-- <td>
                                            <a href="{{ url('/adjust-stock/' . $item->id) }}" title="View AdjustStock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/adjust-stock/' . $item->id . '/edit') }}" title="Edit AdjustStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/adjust-stock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete AdjustStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $adjuststock->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('/adjust-stock/create') }}" class="btn btn-success" title="Add New AdjustStock">
                                <i class="fa fa-plus" aria-hidden="true"></i> ปรับปรุงเพิ่ม-ลด
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
