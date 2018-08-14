@extends('monster-lite/layouts/theme')

@section('title','Edit activity member')

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="card">
		    <div class="card-block">
			    @forelse($table_activity_member as $row)
		    	<div class="row"> 
		    		<div class="col-md-9 align-self-center">		    			
				        <h4 class="card-title">Item : {{ $row->id_act_mem_auto }}</h4>
				        <h6 class="card-subtitle">Update new infomation in the form</h6>
		    		</div>
		    		<div class="col-md-3 align-self-center">							
						<div class="dropdown pull-right">
							<button type="button" class="btn btn-secondary btn-circle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="border: none;"><i class="fa fa-ellipsis-v"></i> </button>							
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<form id="form-delete" style="display: none;" action="{{ url('/') }}/activity-member/{{ $row->id_act_mem_auto }}" method="POST">
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
		    	
    			<form class="form-material" action="{{ url('/') }}/activity-member/{{ $row->id_act_mem_auto }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
	                    <label class="col-md-12">รหัส student</label>
	                    <div class="col-md-12">
							<input type="number" name="id_student" class="form-control form-control-line" placeholder="ใส่หัส student" value="{{ $row->id_student }}">
	                    </div>
	                </div>
					<div class="form-group">
	                    <label class="col-md-12">รหัส activity</label>
	                    <div class="col-md-12">
							<input type="number" name="id_activity" placeholder="ใส่รหัส activity" class="form-control form-control-line" value="{{ $row->id_activity }}">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-md-12">ชั่วโมงที่ทำกิจกรรม</label>
	                    <div class="col-md-12">
							<input type="number" name="hour" placeholder="ใส่ชั่วโมงที่ทำกิจกรรม" class="form-control form-control-line" value="{{ $row->hour }}">							
	                    </div>
	                </div>	
	                <div class="form-group">
                        <div class="col-sm-12">
                        	<div class="pull-right">
								<a class="btn btn-outline-primary" href="{{ url('/') }}/activity-member">back</a>
								<button class="btn btn-success" type="submit" >Update</button>                        		
                        	</div>
                        </div>
                    </div>					
				</form>		

				@empty
				<div class="text-center">
					This activity id ({{ $row->id_act_mem_auto }}) does not exist
				</div>
				@endforelse    
			</div>	
		</div>	
	</div>	
</div>
@endsection 