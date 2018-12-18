@extends('monster-lite/layouts/theme')

@section('title','สร้างใบเสนอราคา')

@section('navbar-menu')
  <div style="margin: 21px;">
    <a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/quotation">back</a>
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
  </div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<form class="" action="{{ url('/') }}/sales/quotation" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/quotation/form')
</form>



@endsection
