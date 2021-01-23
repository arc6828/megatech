@extends('layouts/argon-dashboard/theme')

@section('title','Comment '.$comment->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Comment {{ $comment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/comment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/comment/' . $comment->id . '/edit') }}" title="Edit Comment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('comment' . '/' . $comment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Comment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $comment->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $comment->user_id }} </td></tr><tr><th> Comment </th><td> {{ $comment->comment }} </td></tr><tr><th> Key </th><td> {{ $comment->key }} </td></tr><tr><th> Value </th><td> {{ $comment->value }} </td></tr><tr><th> Remark </th><td> {{ $comment->remark }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
