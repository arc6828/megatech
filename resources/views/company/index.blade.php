@extends('layouts/argon-dashboard/theme')

@section('title', 'Company')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Company</div>
                    <div class="card-body">
                        <a href="{{ url('/company/create') }}" class="btn btn-success btn-sm" title="Add New Company">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/company') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อไทยบริษัท</th>
                                        <th>ชื่ออังกฤษบริษัท</th>
                                        <th>ที่อยู่</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>เบอร์แฟกซ์</th>
                                        <th>เลขประจำตัวผู้เสียภาษี </th>
                                        <th>โลโก้</th>
                                        <th>อีเมล</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->thname_company }}</td>
                                            <td>{{ $item->enname_company }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->tal }}</td>
                                            <td>{{ $item->fax }}</td>
                                            <td>{{ $item->number_tex }}</td>
                                            <td>
                                                <img style="width: 100px" src="{{ asset("/storage/{$item->image}") }}">
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <a href="{{ url('/company/' . $item->id) }}" title="View Company"><button
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/company/' . $item->id . '/edit') }}"
                                                    title="Edit Company"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form method="POST" action="{{ url('/company' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Company"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $company->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- <div id="example"></div>
        <script src="{{ asset('js/app.js') }}"></script> --}}
    </div>
@endsection
