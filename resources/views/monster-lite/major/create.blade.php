@extends('monster-lite/layouts/theme')

@section('title','Create a new major')

@section('breadcrumb-menu')

@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
		    <div class="card-block">
		    	<div class="row"> 
		    		<div class="col-md-9 align-self-center">		    			
				        <h4 class="card-title">A new item</h4>
				        <h6 class="card-subtitle">Fill a new item in the form and then create</h6>
		    		</div>
		    		<div class="col-md-3 align-self-center">
						  						
		    		</div>
		    	</div>
		    	
    			<form class="form-material" action="{{ url('/') }}/major" method="POST">
					{{ csrf_field() }}
					{{ method_field('POST') }}
					<div class="form-group">
	                    <label class="col-md-12">id_major_auto</label>
	                    <div class="col-md-12">
							<input type="number" name="id_major_auto" placeholder="Id majorname here..." class="form-control form-control-line" >
								
	                    </div>
	                </div>		
	                <div class="form-group">
	                    <label class="col-md-12">major_name</label>
	                    <div class="col-md-12">
							<input type="text" name="major_name" placeholder="majorname here..." class="form-control form-control-line" >
								
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">id_faculty</label>
	                    <div class="col-md-12">
							<input type="number" step="any" name="id_faculty" placeholder="Idfaculty here..." class="form-control form-control-line" >							
	                    </div>
	                </div>			       
	                <div class="form-group">
                        <div class="col-sm-12">
                        	<div class="pull-right">
								<a class="btn btn-outline-primary" href="{{ url('/') }}/major">back</a>
								<button class="btn btn-success" type="submit" >Create</button>                    		
                        	</div>
                        </div>
                    </div>					
				</form>		    
			</div>	
		</div>	
	</div>	
</div>

@endsection 
