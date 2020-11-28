@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('title','เบิกของไปผลิต')
@section('background-tag','bg-yellow ')


@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Issuestock</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/issue-stock/create') }}" class="btn btn-success btn-sm" title="Add New IssueStock">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <!-- <form method="GET" action="{{ url('/issue-stock') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>รหัสสินค้าสำเร็จรูป</th>
                                        <th>สินค้าสำเร็จรูป</th>
                                        <th>จำนวน</th>
                                        <th>พนักงานผู้บันทึก</th>
                                        <th>รหัสรับสินค้า</th>
                                        <th>สถานะ</th>
                                        <!-- <th>Remark</th><th>Total</th><th>Revision</th> -->
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($issuestock as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>
                                            <a href="{{ url('/issue-stock/' . $item->id) }}" title="รายละเอียดเบิกของไปผลิต">
                                                {{ $item->code }}
                                            </a>
                                        </td>
                                        <td>{{ $item->product->product_code }}</td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->user->short_name }}</td>
                                        <td>
                                             @switch($item->status_id)                                                                                          
                                                @case("2")
                                                    {{ $item->receive_final->code }}							
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($item->status_id)
                                                @case("-1")
                                                    <span class="badge badge-pill badge-secondary">Void</span>
                                                    @break
                                                @case("1")
                                                    <span class="badge badge-pill badge-warning">เบิกไปผลิต</span>								
                                                    @break                                                
                                                @case("2")
                                                    <span class="badge badge-pill badge-success">รันสินค้าสำเร็จรูปแล้ว</span>								
                                                    @break
                                            @endswitch
                                        </td>
                                        <!-- <td>{{ $item->remark }}</td><td>{{ $item->total }}</td><td>{{ $item->revision }}</td> -->
                                        <!-- <td>
                                            <a href="{{ url('/issue-stock/' . $item->id) }}" title="View IssueStock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/issue-stock/' . $item->id . '/edit') }}" title="Edit IssueStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/issue-stock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete IssueStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('/issue-stock/create') }}" class="btn btn-success" title="Add New IssueStock">
                                <i class="fa fa-plus" aria-hidden="true"></i> เบิกของไปผลิต
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
