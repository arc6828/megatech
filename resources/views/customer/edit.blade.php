@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขข้อมูลลูกค้า')

@section('navbar-menu')
<div style="margin:21px;">
  <a class="btn btn-outline-primary" href="{{ url('/') }}/customer">back</a>
  <button class="btn btn-success" type="submit" onclick="document.getElementById('form').submit();">Update</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection


@section('content')
@forelse ($table_customer as $row)
<form action="{{url('/')}}/customer/{{$row->customer_id}}" method="POST" id="form">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  @include('customer/form')

  <div class="form-group mt-5">
    <div class="col-lg-12">
      <div class="text-center">
        <a class="btn btn-outline-primary " href="{{ url('/') }}/customer">back</a>
        <button class="btn btn-success" type="submit" >Update</button>
      </div>
    </div>
  </div>
</form>
@empty

@endforelse

@endsection

@section('script')
<script>
$(document).ready(function(){
  //console.log("HELLO");
  //initDistrict();
});
</script>
@endsection
