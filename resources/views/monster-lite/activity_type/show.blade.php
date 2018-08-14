<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">
<!doctype html>
@forelse($table_activity_type as $row)
<h1>activity_type : {{ $row->id }} </h1>
<div class="line">
<strong>name : </strong>
<span>{{ $row->name }} </span>
</div>
<div class="line">
<strong>latitude : </strong>
<span>{{ $row->age }}</span>
</div>
<div class="line">
<strong>longitude : </strong>
<span>{{ $row->address }}</span>
</div>
<div class="line">
<strong>salary : </strong>
<span>{{ $row->salary }}</span>
<<div class="line">
<a href="{{ url('/') }}/activity_type">back</a>
<a href="{{ url('/') }}/activity_type/{{ $row->id }}/edit">edit</a>
<form class="inline" action="{{ url('/') }}/activity_type/{{ $row->id }}" method="POST">
{{ csrf_field() }}
{{ method_field('DELETE') }}
<button type="submit">Delete</button>
</form>
</div>
@empty
<div>This activity_type id does not exist</div>
@endforelse