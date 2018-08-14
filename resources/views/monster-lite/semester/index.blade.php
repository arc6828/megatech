@extends('monster-lite/layouts/theme')

@section('title','Semester')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/semester/create" class="btn pull-right hidden-sm-down btn-success"> 
	<i class="fa fa-plus"></i> New Semester
</a>
@endsection

@section('content') 

<div class="card">
    <div class="card-block">
    	<div class="row"> 
    		<div class="col-md-9 align-self-center">		    			
		        <h4 class="card-title">semester Table</h4>
		        <h6 class="card-subtitle">Display all semesters in the database</h6>
    		</div>
    		<div class="col-md-3 align-self-center">
				<form class="form-material" action="{{ url('/') }}/semester" method="GET">
					<input class="form-control form-control-line" type="text" name="q" placeholder="Search ..." value="{{ $q }}">
					<button class="hide btn btn-success" type="submit">Search</button>
				</form>    						
    		</div>
    	</div>
        
		<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead class="thead-dark">
					<tr>
						<th>id_semester</th>
						<th>sem_Name</th>
						<th>action</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($table_semester as $row)
					<tr>
						<td>{{ $row->id_semester }} </td>
						<td>{{ $row->sem_name }} </td>
						<td>
							<a href="{{ url('/') }}/semester/{{ $row->id_semester }}/edit"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
					@endforeach	
				</tbody>				
			</table>
		</div>
	</div>	
</div>
<div  class="hide" style="position : fixed; bottom:70px; right:30px;">
	<a href="{{ url('/') }}/semester/create" class="btn btn-circle pull-right btn-success btn-lg"> 
		<i class="fa fa-plus"></i>
	</a>
</div>	
@endsection


@section('content')

<h1>semester</h1>
<div class="line">
	<a href="{{ url('/') }}/semester/create">
New semester

</a>
</div>
<div class="line">
	<form class="inline" action="{{ url('/') }}/semester" method="GET">
		<input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}">
		<button type="submit">Search</button>
	</form>
</div>

<table class="table">
<tr>
		<th>id_semester</th>
		<th>sem_Name</th>
	</tr>
	@foreach($table_semester as $row)
	<tr>
		<td>{{ $row->id_semester }} </td>
		<td>{{ $row->sem_name }} </td>
		<td>
			<a href="{{ url('/') }}/semester/{{ $row->id_semester }}">View</a>
			<a href="{{ url('/') }}/semester/{{ $row->id_semester }}/edit">Edit</a>
		</td>
	</tr>
	@endforeach
</table>

</body>
</html>
@endsection
