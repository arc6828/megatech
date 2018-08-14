@extends('monster-lite/layouts/theme')

@section('title','Create a new activity member')

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
		    	
    			<form class="form-material" action="{{ url('/') }}/activity-member" method="POST">
					{{ csrf_field() }}
					{{ method_field('POST') }}
					<div class="form-group">
	                    <label class="col-md-12">รหัส student</label>
	                    <div class="col-md-12">
							<input type="number" name="id_student" class="form-control form-control-line" placeholder="ใส่หัส student" >
	                    </div>
	                </div>
					<div class="form-group">
	                    <label class="col-md-12">รหัส activity</label>
	                    <div class="col-md-12">
							<input type="number" name="id_activity" placeholder="ใส่รหัส activity" class="form-control form-control-line">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">ชั่วโมงที่ทำกิจกรรม</label>
	                    <div class="col-md-12">
							<input type="number" name="hour" placeholder="ใส่ชั่วโมงที่ทำกิจกรรม" class="form-control form-control-line">							
	                    </div>
	                </div>	                
	                <div class="form-group">
                        <div class="col-sm-12">
                        	<div class="pull-right">
								<a class="btn btn-outline-primary" href="{{ url('/') }}/activity-member">back</a>
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

