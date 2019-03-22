@extends('layouts/argon-dashboard/theme')

@section('title','เพิ่มลูกค้า')


@section('content')
<form action="{{ url('/') }}/customer" method="POST">
  {{ csrf_field() }}
  {{ method_field('POST') }}
  @include('customer/form')

  <div class="form-group mt-5">
    <div class="col-lg-12">
      <div class="text-center">
        <a class="btn btn-outline-primary " href="{{ url('/') }}/customer">back</a>
        <button class="btn btn-primary" type="submit" >Create</button>
      </div>
    </div>
  </div>
</form>




@endsection

@section('plugins-js')

@endsection
