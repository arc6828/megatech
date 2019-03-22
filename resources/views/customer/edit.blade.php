@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขข้อมูลลูกค้า')

@section('content')

@forelse ($table_customer as $row)
<form action="{{url('/')}}/customer/{{$row->customer_id}}" method="POST" id="form">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @include('customer/form')

  <div class="form-group mt-5">
    <div class="col-lg-12">
      <div class="text-center">
        <a class="btn btn-outline-primary " href="{{ url('/') }}/customer">back</a>
        <button class="btn btn-primary" type="submit" >Update</button>
      </div>
    </div>
  </div>
</form>
@empty

@endforelse


@endsection

@section('script')
<script>
  $(document).ready(function(){
    @forelse ($table_customer as $row)
      $("#customer_code").val("{{ $row->customer_code }}");
      $("#company_name").val("{{ $row->company_name }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#user_id").val("{{ $row->user_id }}");
      
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");

    @empty

    @endforelse
  });
</script>
@endsection
