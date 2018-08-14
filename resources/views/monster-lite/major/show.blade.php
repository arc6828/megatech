@extends('layout/template-pricing')
@section('content')
<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">
@forelse($table_major as $row)
	<h1>major : {{ $row->id_major_auto }} </h1>
	<div class="line">
	<th>
		<th><strong>MajorName : </strong></th>
		<th><span>{{ $row->major_name }} </span></th>
		</th>
	</div>
	<div class="line">
		<td><strong>Idfaculty : </strong></td>
		<td><span>{{ $row->id_faculty }}</span></td>
	</div>
	<div class="line">
		<a href="{{ url('/') }}/major">back</a>
		<a href="{{ url('/') }}/major/{{ $row->id_major_auto }}/edit">edit</a>
		<form class="inline" action="{{ url('/') }}/major/{{ $row->id_major_auto }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
	</div>
@empty
	<div>This major id_major_auto does not exist</div>
@endforelse
@endsection