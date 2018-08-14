@extends('monster-lite/layouts/theme')

@section('title','Edit activity')

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="card">
		    <div class="card-block">
			    @forelse($table_activity as $row)
		    	<div class="row"> 
		    		<div class="col-md-9 align-self-center">		    			
				        <h4 class="card-title">Item : {{ $row->id_activity }}</h4>
				        <h6 class="card-subtitle">Update new infomation in the form</h6>
		    		</div>
		    		<div class="col-md-3 align-self-center">							
						<div class="dropdown pull-right">
							<button type="button" class="btn btn-secondary btn-circle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="border: none;"><i class="fa fa-ellipsis-v"></i> </button>							
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<form id="form-delete" style="display: none;" action="{{ url('/') }}/activity/{{ $row->id_activity }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button class="btn btn-danger" type="submit">
										<i class="fa fa-trash-o"></i> Remove
									</button>
								</form>
								<a class="dropdown-item" href="javascript:document.getElementById('form-delete').submit();">
									<i class="fa fa-trash-o"></i> Remove
								</a>
							</div>
						</div>			
		    		</div>
		    	</div>
		    	
    			<form class="form-material" action="{{ url('/') }}/activity/{{ $row->id_activity }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
	                    <label class="col-md-12">ActivityName</label>
	                    <div class="col-md-12">
							<input type="text" name="activity_name" class="form-control form-control-line" value="{{ $row->activity_name }}" readonly>
	                    </div>
	                </div>
					<div class="form-group">
	                    <label class="col-md-12">Date Start</label>
	                    <div class="col-md-12">
							<input type="date" name="date_start" class="form-control form-control-line"  value="{{ $row->date_start }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">Place</label>
	                    <div class="col-md-12">
							<input type="text" name="place" class="form-control form-control-line"  value="{{ $row->place }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">Max hour</label>
	                    <div class="col-md-12">
							<input type="number" name="max_hour"  class="form-control form-control-line"  value="{{ $row->max_hour }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">ID semester</label>
	                    <div class="col-md-12">
							<input type="number" name="id_semester"  class="form-control form-control-line" value="{{ $row->id_semester }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">Id activity type</label>
	                    <div class="col-md-12">
							<input type="number" name="id_activity_type"  class="form-control form-control-line" value="{{ $row->id_activity_type }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">Id major</label>
	                    <div class="col-md-12">
							<input type="number" name="id_major"  class="form-control form-control-line" value="{{ $row->id_major }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group">
                        <div class="col-sm-12">
                        	<div class="pull-right">
								<a class="btn btn-outline-primary" href="{{ url('/') }}/activity">back</a>
								<button class="btn btn-success" type="submit" >Update</button>                        		
                        	</div>
                        </div>
                    </div>					
				</form>		

				@empty
				<div class="text-center">
					This activity id ({{ $row->id_activity }}) does not exist
				</div>
				@endforelse    
			</div>	
		</div>	
	</div>	
</div>
@endsection 