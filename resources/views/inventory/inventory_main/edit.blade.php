@extends('monster-lite/layouts/theme')

@section('title','แก้ไขข้อมูลคลังสินค้า')

@section('breadcrumb-menu')

@endsection

@section('content')
@forelse ($table_inventory as $row)
<form action="{{ url('/') }}/inventory_main/{{ $row->inventory_id }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card">
            <div class="card-block">
                    <div class="form-group form-inline">
                            <label class="col-lg-2">รายละเอียด</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="inventory_name"  class="form-control form-control-line" value="{{ $row->inventory_name }}"  >
                                    </div>
                    </div>
                    <div class="form-group">
                            <div class="col-lg-12">
                              <div class="text-center">
                                <a class="btn btn-outline-primary" href="{{ url('/') }}/inventory_main">back</a>
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