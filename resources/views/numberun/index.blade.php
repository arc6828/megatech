@extends('layouts/argon-dashboard/theme')

@section('title', 'ตั้งค่าการรันเลขเอกสาร')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">เลขรันเอกสาร</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </button>

                        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">สร้างเลขเริ่มต้นเอกสาร</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                            <ul class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <form method="POST" action="{{ url('/numberun') }}" accept-charset="UTF-8"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            @include ('numberun.form', ['formMode' => 'create'])

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อใบ</th>
                                        <th>ตัวย่อ</th>
                                        <th>ปี / เดือน</th>
                                        <th>เลขรัน</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($numberun as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_doc }}</td>
                                            <td>{{ $item->number_en }}</td>
                                            <td>{{ date('Y-m', strtotime($item->datetime_doc)) }}</td>
                                            <td>{{ $item->number_doc }}</td>
                                            <td>
                                                {{-- <a href="{{ url('/numberun/' . $item->id) }}"
                                                    title="View Numberun"><button class="btn btn-info btn-sm"><i
                                                            class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                                <a href="{{ url('/numberun/' . $item->id . '/edit') }}"
                                                    title="Edit Numberun"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                {{-- <form method="POST" action="{{ url('/numberun' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Numberun"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- {{-- <div id="example"></div>
    <script src="{{ asset('js/app.js') }}"></script> --}}
