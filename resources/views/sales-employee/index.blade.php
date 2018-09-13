@extends('monster-lite/layouts/theme')

@section('title','แฟ้มพนักงานขาย')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/finance/debtor/create" class="btn pull-right hidden-sm-down btn-success hide"> 
  <i class="fa fa-plus"></i> เพิ่มลูกค้า
</a>
@endsection

@section('content')

<div class="card">
    <div class="card-block">

    <div class="row">
      <div class="col-sm-6">
        <form class="inline" action="{{ url('/') }}/finance/debtor" method="GET">
          <input type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" class="form-control">
          <button type="submit" class="glyphicon glyphicon-search btn-lg"></button>
        </form>
        <a href="{{url('/')}}/finance" class="btn btn-danger btn-lg">Back</a>
      </div>
    </div>

    @foreach($table_sales_employee as $row)
      <div class="table-responsive">
        <table class="table table-hover text-center">
          <thead>
            <tr>          
              <th>รหัส</th>
              <th>ชื่อ</th>
              <th>อีเมล์</th>
              <th>action</th>
            </tr> 
          </thead>
          <tbody>
            <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->email }}</td>
              <td>
                <div class="row">
                    <a href="{{ url('/') }}/finance/debtor/{{ $row->id }}/edit" class="btn btn-info btn-lg glyphicon glyphicon-pencil" style="height: 3em"></a>
                  <form class="inline" action="{{ url('/') }}/finance/debtor/{{ $row->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="glyphicon glyphicon-remove btn-danger btn-lg" style="height: 3em"></button>
                </form>
                </div>
              </td>
            </tr>   
          </tbody>
        
        </table>  
      </div>
      
    @endforeach

    

  </div>
</div>
@endsection
