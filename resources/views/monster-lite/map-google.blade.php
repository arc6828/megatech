@extends('monster-lite/layouts/theme')

@section('title','Google map')

@section('content')

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Simple Basic Map</h4>
                <div id="gmaps-simple" class="gmaps"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('plugins-js')
<!-- google maps api -->
<script src="https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyC6EpDuzLcc5fhxZfr30n4eNoHOQQGLlTY "></script>
<script src="{{url('/')}}/assets/plugins/gmaps/gmaps.min.js"></script>
<script src="{{url('/')}}/assets/plugins/gmaps/jquery.gmaps.js"></script>
@endsection