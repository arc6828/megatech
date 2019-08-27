@extends('monster-lite/layouts/theme')

@section('title','ใบวางบิล')

@section('navbar-menu')
<div style="margin:21px;">
	<a href="{{ url('/') }}/finance/billing/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
		<i class="fa fa-plus"></i> เพิ่มใบวางบิล
	</a>
<div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 align-self-center">
        <h4 class="card-title">ใบวางบิล</h4>
        <h6 class="card-subtitle">Display infomation in the table</h6>
    </div>
    <div class="col-lg-6 align-self-center">
        <form class="" action="{{ url('/') }}/finance/billing" method="GET">
            <div class="form-group form-inline pull-right">
                <input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
                <button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
            </div>
        </form>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>เลขที่เอกสาร</th>
            <th>วันที่</th>
            <th>ยอดเงินรวม</th>
            <th>รหัสลูกค้า</th>
            <th>ชื่อบริษัท</th>
            <th>action</th>
            b:
        </tr>
    </thead>
    <tbody>
        @foreach ($table_billing as $row )
        <tr>
            <td>
              <a href="{{ url('/') }}/finance/billing/{{ $row->billing_note_id }}/edit"> {{ $row->billing_note_code }}</a> 
            </td>
            <td>
                {{ $row->date }}
            </td>
            <td>

            </td>
            <td>
                {{ $row->customer_code }}
            </td>
            <td>
                {{ $row->company_name }}
            </td>
            <td>
                <a href="javascript:void(0)" onclick="onDelete( {{ $row->billing_note_id }} )" class="text-danger">
                    <span class="fa fa-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="form-group">
		<div class="col-lg-12">
			<div class="text-center">
				  <a class="btn btn-outline-primary" href="{{ url('/') }}/finance">back</a>
			</div>
		</div>
	</div>
<div class="row hide">
        <form action="#" method="POST" id="form_delete">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            
            <button type="submit"></button>
        </form>
</div>


<script>
        function onDelete(id){
            //--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//
    
            //GET FORM BY ID
            var form = document.getElementById("form_delete");
    
            //CHANGE ACTION TO SPECIFY ID
            form.action = "{{ url('/') }}/finance/billing/"+id;
    
            //SUBMIT
            var want_to_delete = confirm('Are you sure to delete this product?');
            if(want_to_delete){
                form.submit();
            }
        }
        </script>
@endsection