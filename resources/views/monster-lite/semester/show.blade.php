@extends('template-pricing.blade.php')
<link href="{{ url('/') }}/style.css" rel="stylesheet" type="text/css">
@section('content')

@forelse($table_semester as $row)
	<h1>semester : {{ $row->id_semester }} </h1>
	<div class="line">
		<strong>semester sem_Name : </strong>
		<span>{{ $row->sem_name }} </span>
	</div>
	<br>
	
@empty
	<div>This semester id does not exist</div>
@endforelse
<form class="inline" action="{{ url('/') }}/semester/{{ $row->id_semester }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
		<button class="button-2"> Update Task </button>
</form>
</div>
@endsection
 