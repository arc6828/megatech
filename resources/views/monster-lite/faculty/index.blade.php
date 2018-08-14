@extends('monster-lite/layouts/theme')

@section('title','Faculty')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/faculty/create" class="btn pull-right hidden-sm-down btn-success"> 
	<i class="fa fa-plus"></i> New Faculty
</a>
@endsection

@section('content') 

<div class="card">
    <div class="card-block">
    	<div class="row"> 
    		<div class="col-md-9 align-self-center">		    			
		        <h4 class="card-title">Activity Table</h4>
		        <h6 class="card-subtitle">Display all activities in the database</h6>
    		</div>
    		<div class="col-md-3 align-self-center">
				<form class="form-material" action="{{ url('/') }}/faculty" method="GET">
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
						<th>name</th>
						<th>action</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($table_faculty as $row)
					<tr>
						<td>{{ $row->id_faculty_auto }} </td>
						<td>{{ $row->name }} </td>		
						<td>					
							<a href="{{ url('/') }}/faculty/{{ $row->id_faculty_auto  }}/edit"> <i class="fa fa-edit"></i> Edit</a>
						</td>							
					</tr>
					@endforeach	
				</tbody>				
			</table>
		</div>
	</div>	
</div>
<div  class="hide" style="position : fixed; bottom:70px; right:30px;">
	<a href="{{ url('/') }}/faculty/create" class="btn btn-circle pull-right btn-success btn-lg"> 
		<i class="fa fa-plus"></i>
	</a>
</div>	
@endsection