@extends('monster-lite/layouts/theme')

@section('title','แฟ้มหลักคลังสินค้า')

@section('navbar-menu')
<div style="margin:21px;">
        <a href="{{ url('/') }}/inventory_main/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
            <i class="fa fa-plus"></i> เพิ่มคลังสินค้า
        </a>
    <div>
@endsection

@section('content')

<div class="card">
    <div class="card-block">
            <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <h4 class="card-title">แฟ้งหลักคลังสินค้า</h4>
                        <h6 class="card-subtitle">Display infomation in the table</h6>
                    </div>
                    <div class="col-lg-6 align-self-center">
                            <form class="" action="{{ url('/') }}/inventory" method="GET">
                                <div class="form-group form-inline pull-right">
                                    <input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
                                    <button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
                                </div>
                            </form>
                        </div>
                </div>
            <div class="row hide">
                    <form action="#" method="POST" id="form_delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        
                        <button type="submit"></button>
                    </form>
            </div>
            <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($table_inventory as $row)
                        <tr>
                            <td><a href="{{ url('/') }}/inventory_main/{{ $row->inventory_id }}/edit">{{ $row->inventory_id }}</a></td>
                            <td>{{ $row->inventory_name }}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="onDelete( {{ $row->inventory_id }} )" class="text-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row hide">
                        <form action="#" method="POST" id="form_delete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            
                            <button type="submit"></button>
                        </form>
                </div>
            <div class="form-group">
                    <div class="col-lg-12">
                        <div class="text-center">
                              <a class="btn btn-outline-primary" href="{{ url('/') }}/inventory">back</a>
                        </div>
                    </div>
                </div>
    </div>
</div>



<script>
        function onDelete(id){
            //--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//
    
            //GET FORM BY ID
            var form = document.getElementById("form_delete");
    
            //CHANGE ACTION TO SPECIFY ID
            form.action = "{{ url('/') }}/inventory_main/"+id;
    
            //SUBMIT
            var want_to_delete = confirm('Are you sure to delete this product?');
            if(want_to_delete){
                form.submit();
            }
        }
        </script>
@endsection
