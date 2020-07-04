@extends('layouts/argon-dashboard/theme')

@section('title','Backuplog '.$backuplog->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Backuplog {{ $backuplog->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/backuplog') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/backuplog/' . $backuplog->id . '/edit') }}" title="Edit Backuplog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('backuplog' . '/' . $backuplog->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Backuplog" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $backuplog->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $backuplog->title }} </td></tr><tr><th> Content </th><td> {{ $backuplog->content }} </td></tr><tr><th> Filename </th><td> {{ $backuplog->filename }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
