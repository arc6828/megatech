@extends('layouts/argon-dashboard/theme')

@section('title','เพิ่มเจ้าหนี้')


@section('content')
<form action="{{ url('/') }}/supplier" method="POST">
  {{ csrf_field() }}
  {{ method_field('POST') }}
  @include('supplier/form')

  <div class="form-group mt-5">
    <div class="col-lg-12">
      <div class="text-center">
        <a class="btn btn-outline-primary " href="{{ url('/') }}/supplier">back</a>
        <button class="btn btn-primary" type="submit" >Create</button>
      </div>
    </div>
  </div>
</form>




@endsection

@section('plugins-js')

@endsection
