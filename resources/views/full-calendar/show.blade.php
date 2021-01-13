@extends('layouts/argon-dashboard/theme')

@section('title','FullCalendar '.$fullcalendar->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">FullCalendar {{ $fullcalendar->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/full-calendar') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/full-calendar/' . $fullcalendar->id . '/edit') }}" title="Edit FullCalendar"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('fullcalendar' . '/' . $fullcalendar->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete FullCalendar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $fullcalendar->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $fullcalendar->title }} </td></tr><tr><th> Start </th><td> {{ $fullcalendar->start }} </td></tr><tr><th> End </th><td> {{ $fullcalendar->end }} </td></tr><tr><th> Name </th><td> {{ $fullcalendar->name }} </td></tr><tr><th> Customer Id </th><td> {{ $fullcalendar->customer_id }} </td></tr><tr><th> Supplier Id </th><td> {{ $fullcalendar->supplier_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
