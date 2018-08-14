@extends('layout/template-pricing') 
@section('content')
<link href="{{ url('/') }}/css/style.css" rel="stylesheet" type="text/css">
@forelse($table_activity_member as $row)
	<h1>ข้อมูลนักศึกษา: {{ $row->id_act_mem_auto}} </h1>
	<div class="line">
		<strong>รหัส student : </strong>
		<span>{{ $row->id_student }} </span>
	</div>
	<div class="line">
		<strong>รหัส activity : </strong>
		<span>{{ $row->id_activity }}</span>
	</div>
	<div class="line">
		<strong>ชั่วโมงที่ทำกิจกรรม : </strong>		
		<span>{{ $row->hour }}</span>
	</div>
<br>
	
@empty
	<div>This .... id does not exist</div>
@endforelse
<div class="line">
	<button><a href="{{ url('/') }}/activity_member">back</a></button>
	<button><a href="{{ url('/') }}/activity_member/{{ $row->id_act_mem_auto }}/edit">edit</a></button>
	<form class="inline" action="{{ url('/') }}/activity_member/{{ $row->id_act_mem_auto }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
</div>
@endsection