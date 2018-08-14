@extends('monster-lite/layouts/theme')

@section('title','Create a new student')

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
		    	
    			<form class="form-material" action="{{ url('/') }}/student" method="POST">
					{{ csrf_field() }}
					{{ method_field('POST') }}
					<div class="form-group">
	                    <label class="col-md-12">id_student</label>
	                    <div class="col-md-12">
							<input type="number" name="id_student" placeholder="id here..." class="form-control form-control-line">

	                    </div>
	                </div>		
	                <div class="form-group">
	                    <label class="col-md-12">stu_name</label>
	                    <div class="col-md-12">
							<input type="text" name="stu_name" placeholder="name here..." class="form-control form-control-line">

	                    </div>
	                </div>	
	                <div class="form-group">
	                    <label class="col-md-12">stu_lastname</label>
	                    <div class="col-md-12">
							<input type="text" name="stu_lastname" placeholder="lastname here..." class="form-control form-control-line">

	                    </div>
	                </div>	
	                <div class="form-group">
	                    <label class="col-md-12">degree</label>
	                    <div class="col-md-12">
							<input type="text" name="degree" placeholder="degree here..." class="form-control form-control-line">

	                </div>	
	                <div class="form-group">
	                    <label class="col-md-12">major</label>
	                    <div class="col-md-12">
							<input type="number" name="major" placeholder="major here..." class="form-control form-control-line">
	                    </div>
	                </div>				       
	                <div class="form-group">
                        <div class="col-sm-12">
                        	<div class="pull-right">
								<a class="btn btn-outline-primary" href="{{ url('/') }}/student">back</a>
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




