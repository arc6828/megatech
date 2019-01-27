@extends('monster-lite/layouts/theme')

@section('title','ลดหนี้')

@section('navbar-menu')
<div style="margin:21px;">
	<a href="{{ url('/') }}/finance/reduce/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
		<i class="fa fa-plus"></i> ลดหนี้
	</a>
<div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6 align-self-center">
        <h4 class="card-title">ลดหนี้</h4>
        <h6 class="card-subtitle">Display infomation in the table</h6>
    </div>
    <div class="col-lg-6 align-self-center">
        <form class="" action="{{ url('/') }}/finance/reduce" method="GET">
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
            <th>วันที่เอกสาร</th>
            <th>ยอดหนี้สุทธิ</th>
            <th>รหัสลูกค้า</th>
            <th>ชื่อบริษัท</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>
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
		form.action = "{{ url('/') }}/finance/reduce/"+id;

		//SUBMIT
		var want_to_delete = confirm('Are you sure to delete this debtout?');
		if(want_to_delete){
			form.submit();
		}
	}
	</script>

@endsection