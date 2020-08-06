@extends('layouts/argon-dashboard/theme')

@section('title','Brand '.$brand->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Brand {{ $brand->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/brand') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/brand/' . $brand->id . '/edit') }}" title="Edit Brand"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('brand' . '/' . $brand->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $brand->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $brand->title }} </td></tr><tr><th> Content </th><td> {{ $brand->content }} </td></tr><tr><th> Begin Date </th><td> {{ $brand->begin_date }} </td></tr><tr><th> Deadline </th><td> {{ $brand->deadline }} </td></tr><tr><th> Complete Date </th><td> {{ $brand->complete_date }} </td></tr><tr><th> Remark </th><td> {{ $brand->remark }} </td></tr><tr><th> Photo </th><td> {{ $brand->photo }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
