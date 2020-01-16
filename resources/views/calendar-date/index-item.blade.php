<table class="table">
    <thead>
        <tr>
            <th>#</th><th>Name</th><th>Pin Date</th><th>Calender Id</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($calendardate as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td><td>{{ $item->pin_date }}</td><td>{{ $item->calendar_id }}</td>
            <td>
                <a href="{{ url('/calendar-date/' . $item->id) }}" title="View CalendarDate"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                <a href="{{ url('/calendar-date/' . $item->id . '/edit') }}" title="Edit CalendarDate"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                <form method="POST" action="{{ url('/calendar-date' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete CalendarDate" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>