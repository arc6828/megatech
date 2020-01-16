@extends('layouts/argon-dashboard/theme')

@section('title','Calendar '.$calendar->id)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">Calendar</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="calendar" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Calendar {{ $calendar->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/calendar') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/calendar/' . $calendar->id . '/edit') }}" title="Edit Calendar"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('calendar' . '/' . $calendar->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Calendar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $calendar->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $calendar->title }} </td></tr><tr><th> First Billing Date </th><td> {{ $calendar->first_billing_date }} </td></tr><tr><th> Customer Id </th><td> {{ $calendar->customer_id }} </td></tr><tr><th> Supplier Id </th><td> {{ $calendar->supplier_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @php
                    $calendardate = $calendar->calendar_dates;
                    
                @endphp                
                <div class="card">
                    <div class="card-header">Calendardate</div>
                    <div class="card-body">
                        <a href="{{ url('/calendar-date/create') }}?calendar_id={{ $calendar->id }}" class="btn btn-success btn-sm" title="Add New CalendarDate">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>                       

                        <br/>
                        <br/>
                        <div class="table-responsive">  
                            @include('calendar-date/index-item')
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')

<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css' rel='stylesheet' />
<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEls = document.getElementsByClassName('calendar');

    for(calendarEl of calendarEls){
        var calendar = new FullCalendar.Calendar(calendarEl, {
            width: 100,
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            defaultView: 'dayGridMonth',
            defaultDate: '2019-11-07',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                {
                    title: 'All Day Event',
                    start: '2019-11-01'
                },
                {
                title: 'Long Event',
                start: '2019-11-07',
                end: '2019-11-10'
                },
                {
                groupId: '999',
                title: 'Repeating Event',
                start: '2019-11-09T16:00:00'
                },
                {
                groupId: '999',
                title: 'Repeating Event',
                start: '2019-11-16T16:00:00'
                },
                {
                title: 'Conference',
                start: '2019-11-11',
                end: '2019-11-13'
                },
                {
                title: 'Meeting',
                start: '2019-11-12T10:30:00',
                end: '2019-11-12T12:30:00'
                },
                {
                title: 'Lunch',
                start: '2019-11-12T12:00:00'
                },
                {
                title: 'Meeting',
                start: '2019-11-12T14:30:00'
                },
                {
                title: 'Birthday Party',
                start: '2019-11-13T07:00:00'
                },
                {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2019-11-28'
                }
            ]
        });

        calendar.render();

    }

    
  });

</script>
@endsection
