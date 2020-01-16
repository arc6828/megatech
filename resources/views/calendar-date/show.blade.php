@extends('layouts/argon-dashboard/theme')

@section('title','CalendarDate '.$calendardate->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">CalendarDate {{ $calendardate->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/calendar-date') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/calendar-date/' . $calendardate->id . '/edit') }}" title="Edit CalendarDate"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('calendardate' . '/' . $calendardate->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CalendarDate" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $calendardate->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $calendardate->name }} </td></tr><tr><th> Pin Date </th><td> {{ $calendardate->pin_date }} </td></tr><tr><th> Calender Id </th><td> {{ $calendardate->calendar_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
