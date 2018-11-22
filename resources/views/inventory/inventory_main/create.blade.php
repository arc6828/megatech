@extends('monster-lite/layouts/theme')

@section('title','เพิ่มลูกค้า')

@section('breadcrumb-menu')

@endsection

@section('content')
<form action="{{ url('/') }}/inventory_main" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="card">
            <div class="card-block">
                    <div class="form-group form-inline">
                            <label class="col-lg-2">รายละเอียด</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="inventory_name"  class="form-control form-control-line"  >
                                    </div>
                    </div>
                    <div class="form-group">
                            <div class="col-lg-12">
                              <div class="text-center">
                                <a class="btn btn-outline-primary" href="{{ url('/') }}/inventory_main">back</a>
                                <button class="btn btn-success" type="submit" >Create</button>
                              </div>
                            </div>
                        </div>
            </div>
    </div>
</form>
@endsection

@section('plugins-js')

@endsection
