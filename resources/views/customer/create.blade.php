@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('customer'))
@section('level-0','แฟ้มลูกค้า')

@section('title','เพิ่มลูกค้า')


@section('content')
<form action="{{ url('/') }}/customer" method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}
  {{ method_field('POST') }}
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  
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
