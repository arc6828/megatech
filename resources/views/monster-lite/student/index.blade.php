@extends('monster-lite/layouts/theme')

@section('title','Student')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="btn pull-right hidden-sm-down btn-success"> 
	<i class="fa fa-plus"></i> New Student
</a>
@endsection

@section('content') 

<div class="card">
    <div class="card-block">
    	<div class="row"> 
    		<div class="col-md-9 align-self-center">		    			
		        <h4 class="card-title">Student Table</h4>
		        <h6 class="card-subtitle">Display all students in the database</h6>
    		</div>
    		<div class="col-md-3 align-self-center">
				<form class="form-material" action="{{ url('/') }}/activity" method="GET">
					<input class="form-control form-control-line" type="text" name="q" placeholder="Search ..." value="{{ $q }}">
					<button class="hide btn btn-success" type="submit">Search</button>
				</form>    						
    		</div>
    	</div>
        
		<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead class="thead-dark">
					<tr>
						<th>id</th>
						<th>id_student</th>
						<th>name</th>
						<th>lastname</th>
						<th>degree</th>
						<th>major</th>
						<th>action</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($table_student as $row)
					<tr>
						<td>{{ $row->id_student_auto }} </td>
						<td>{{ $row->id_student }} </td>
						<td>{{ $row->stu_name }}</td>
						<td>{{ $row->stu_lastname }}</td>
						<td>{{ $row->degree }}</td>
						<td>{{ $row->major }}</td>
						<td>
							<a href="{{ url('/') }}/student/{{ $row->id_student_auto }}/edit">
							<i class="fa fa-edit"></i> Edit
							</a>
						</td>
					</tr>
					@endforeach	
				</tbody>				
			</table>
		</div>
	</div>	
</div>
<div  class="hide" style="position : fixed; bottom:70px; right:30px;">
	<a href="{{ url('/') }}/student/create" class="btn btn-circle pull-right btn-success btn-lg"> 
		<i class="fa fa-plus"></i>
	</a>
</div>	
@endsection