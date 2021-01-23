@extends('layouts/argon-dashboard/theme')

@section('title','Fullcalendar')

@section('content')
    @php
        $mode = ""; 
        if(! empty( request('customer_id') ) ){ //CUSTOMER
            $mode = "customer";
        }else if(! empty( request('supplier_id') ) ){ //SUPPLIER
            $mode = "supplier";
        }else{

        }
    @endphp
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/'.$mode) }}/{{ request($mode.'_id') }}/edit" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <div class="row">
                            <div class="col-md-5">
                                <div class="calendar" ></div>
                            </div>
                            
                            <div class="col-md-7">
                                <div class="card-body">
                                    <a href="{{ url('/full-calendar/create') }}?{{ $mode.'_id' }}={{ request($mode.'_id') }}" class="btn btn-success btn-sm" title="Add New FullCalendar">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>

                                    <form method="GET" action="{{ url('/full-calendar') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right d-none" role="search">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>

                                    <br/>
                                    <br/>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Title</th><th>Start-End</th><th>Name</th><th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($fullcalendar as $item)
                                                <tr>
                                                    <td><a href="{{ url('/full-calendar/' . $item->id) }}/edit?{{ $mode.'_id' }}={{ request($mode.'_id') }}" title="Edit Calendar">{{ $item->title }}</a></td>
                                                    <td>{{ $item->start }} <i class="fa fa-arrow-right text-warning" aria-hidden="true"></i> {{ $item->end }}</td>
                                                    <td>
                                                        @switch($item->name)
                                                            @case("billing")
                                                                <span class="badge badge-warning">วางบิล</span>
                                                                @break 
                                                            @case("cheque")
                                                                <span class="badge badge-success">รับเช็ค</span>
                                                                @break 
                                                        @endswitch
                                                    </td>
                                                    <td class="d-none">{{ $item->customer_id }}</td>
                                                    <td class="d-none">{{ $item->supplier_id }}</td>
                                                    <td>
                                                        <a class="d-none" href="{{ url('/full-calendar/' . $item->id) }}" title="View FullCalendar"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                        <a class="d-none" href="{{ url('/full-calendar/' . $item->id . '/edit') }}" title="Edit FullCalendar"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>

                                                        <form method="POST" action="{{ url('/full-calendar' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete FullCalendar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination-wrapper"> {!! $fullcalendar->appends(['search' => Request::get('search')])->render() !!} </div>
                                    </div>

                                </div>
                            </div>
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
<style>
    .fc-button {
        font-size: 0.8em;
    }
    .fc-day-number{
        font-size: 0.8em;
    }
</style>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEls = document.getElementsByClassName('calendar');

    for(calendarEl of calendarEls){
        var colors = {
            "billing" : "#ff3709",
            "cheque" : "#1aae6f"
        };
        var names = {
            "billing" : "วางบิล",
            "cheque" : "รับเช็ค"
        };
        var calendar = new FullCalendar.Calendar(calendarEl, {
            width: 100,
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            eventTextColor : 'white',
            defaultView: 'dayGridMonth',
            defaultDate: '{{ date("Y-m-d") }}',
            contentHeight:"auto",
            header: {
                /*left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'*/
                right: 'prev today next',
                //center: 'title',
                left: 'title'
            },
            events: [
                @foreach($fullcalendar as $item)
                {
                    title: names['{{ $item->name }}']+" {{ $item->title }}",
                    start: "{{ $item->start }}",
                    end: "{{ $item->end }}",
                    color: colors['{{ $item->name }}']
                },
                @endforeach
                /*{
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
                }*/
            ]
        });

        calendar.render();

    }

    
  });

</script>
@endsection
