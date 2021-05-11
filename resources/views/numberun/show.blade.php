@extends('layouts/argon-dashboard/theme')

@section('title','Numberun '.$numberun->id)

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Numberun {{ $numberun->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/numberun') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/numberun/' . $numberun->id . '/edit') }}" title="Edit Numberun"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('numberun' . '/' . $numberun->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Numberun" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $numberun->id }}</td>
                                    </tr>
                                    <tr><th> Name Doc </th><td> {{ $numberun->name_doc }} </td></tr><tr><th> Datetime Doc </th><td> {{ $numberun->datetime_doc }} </td></tr><tr><th> Number Doc </th><td> {{ $numberun->number_doc }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
