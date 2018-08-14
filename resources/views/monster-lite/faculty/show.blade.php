@extends('layout/template-pricing') 
<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">

@section('content') 
@forelse($table_faculty as $row)
	<h1>faculty : {{ $row->id_faculty_auto }} </h1>
	<div class="line">
		<strong>name : </strong>
		<span>{{ $row->name }} </span>
	</div>
@empty
	<div>This faculty id does not exist</div>
@endforelse
<div class="line">
	<button><a href="{{ url('/') }}/faculty">back</a></button>
	<button><a href="{{ url('/') }}/faculty/{{ $row->id_faculty_auto }}/edit">edit</a></button>
	<form class="inline" action="{{ url('/') }}/faculty/{{ $row->id_faculty_auto }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
</div>
 @endsection 