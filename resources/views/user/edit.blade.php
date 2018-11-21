@extends('monster-lite/layouts/theme')

@section('title','แก้ไขข้อมูลพนักงาน')

@section('breadcrumb-menu')

@endsection

@section('content')

@forelse ($table_user as $row)

<form action="{{ url('/') }}/user/{{ $row->id }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

        
    <div class="card">
        <div class="card-block">
                <div class="form-group form-inline">
                        <label class="col-lg-2">ชื่อ</label>
                                <div class="col-lg-3">
                                    <input type="text" name="name"  class="form-control form-control-line" value="{{ $row->name }}" >
                                </div>
                        </div>
                <div class="form-group form-inline">
                        <label class="col-lg-2">สถานะ</label>
                                <div class="col-lg-3">
                                    <input type="text" name="role"  class="form-control form-control-line" value="{{ $row->role }}" >
                                </div>
                         </div>

                         <div class="form-group">
                                <div class="col-lg-12">
                                  <div class="text-center">
                                    <a class="btn btn-outline-primary" href="{{ url('/') }}/user">back</a>
                                    <button class="btn btn-success" type="submit" >Update</button>
                                  </div>
                                </div>
                              </div>
        </div>
    </div>
</form>
    
@empty
    
@endforelse

@endsection

@section('plugins-js')

@endsection