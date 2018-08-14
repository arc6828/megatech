<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">
@forelse($table_student as $row)
<h1>Student : {{ $row->id }} </h1>
<div class="line">
<strong>ID Student : </strong>
<span>{{ $row->id_student }} </span>
</div>
<div class="line">
<strong>Name : </strong>
<span>{{ $row->stu_name }} </span>
</div>
<div class="line">
<strong>Lastname : </strong>
<span>{{ $row->stu_lastname }}</span>
</div>
<div class="line">
<strong>Degree : </strong>
<span>{{ $row->degree }}</span>
</div>
<div class="line">
<strong>Major : </strong>
<span>{{ $row->major }}</span>
</div>
<div class="line">
<a href="{{ url('/') }}/student">back</a>
<a href="{{ url('/') }}/student/{{ $row->id }}/edit">edit</a>
<form class="inline" action="{{ url('/') }}/student/{{ $row->id }}" method="POST">
{{ csrf_field() }}
{{ method_field('DELETE') }}
<button type="submit">Delete</button>
</form>
</div>

@empty
<div>This Student id does not exist</div>
@endforelse
