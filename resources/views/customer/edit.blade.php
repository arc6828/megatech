@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('customer'))
@section('level-0','แฟ้มลูกค้า')



@if( $mode == "edit" )
  @section('level-2-url', url('customer/'.$customer->customer_id ))
  @section('level-2','รายละเอียด')
@endif

@section('title', $mode == "edit" ? 'แก้ไข' : 'รายละเอียด')

@section('title','แก้ไขข้อมูลลูกค้า')

@section('content')
@forelse ($table_customer as $row)

<form action="{{url('/')}}/customer/{{$row->customer_id}}" method="POST" id="form" enctype="multipart/form-data" class="mt-4" 
onsubmit="return (checkID(document.querySelector('#tax_number').value)) || document.querySelector('#tax_number').value=='-' " >
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @include('customer/form')

  @php
  $contact = $customer->contacts;
  @endphp
  @include('customer/contact-index-card', ['type' => 'customer'])


  @php
  $comment = $customer->comments;
  @endphp
  @include('customer/comment-index-card', ['type' => 'customer'])

  <div class="form-group mt-5">
    <div class="col-lg-12">
      <div class="text-center">
        <a class="btn btn-outline-success " href="{{ url('/') }}/customer">back</a>
        <button class="btn btn-success" type="submit" >Update</button>
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
      $("#name").val("{{ $row->name }}");
      $("#contact_name").val("{{ $row->contact_name }}");
      $("#telephone").val("{{ $row->telephone }}");
      $("#fax").val("{{ $row->fax }}");

      $("#address").val("{{ isset($row->sub_district) ? $row->address : $row->address.' '. $row->address2 }}");
      /*
      $("#province").val("{{ $row->province }}");
      $("#district").val("{{ $row->district }}");
      $("#sub_district").val("{{ $row->sub_district }}");
      $("#zipcode").val("{{ $row->zipcode }}");
      */
      $("#delivery_address").val("{{ isset($row->delivery_sub_district) ? $row->delivery_address : $row->delivery_address.' '. $row->delivery_address2  }}   ");
      /*
      $("#delivery_province").val("{{ $row->delivery_province }}");
      $("#delivery_district").val("{{ $row->delivery_district }}");
      $("#delivery_sub_district").val("{{ $row->delivery_sub_district }}");
      $("#delivery_zipcode").val("{{ $row->delivery_zipcode }}");
      */
      $("#zone_id").val("{{ $row->zone_id }}");
      $("#delivery_type_id").val("{{ $row->delivery_type_id }}");
      $("#remark").val("{{ $row->remark }}");
      document.querySelector("#payment_method").value = "{{ isset($row->payment_method) ? $row->payment_method : 'credit' }}";
      $("#max_credit").val("{{ $row->max_credit }}");
      $("#debt_duration").val("{{ $row->debt_duration }}");
      $("#billing_duration").val("{{ $row->billing_duration }}");
      $("#cheqe_condition").val("{{ $row->cheqe_condition }}");
      $("#tax_number").val("{{ $row->tax_number }}");
      $("#location_type_id").val("{{ $row->location_type_id }}");
      $("#branch_id").val("{{ $row->branch_id }}");
      //UPLOAD
      @if( $row->upload != null)
        @foreach(json_decode($row->upload) as $row_upload)
          $("#file_name_{{ $row_upload->key }}").text("{{ $row_upload->value }}");
          $("#file_name_{{ $row_upload->key }}").attr("href","{{ url('/').'/storage/'.$row_upload->value }}");
        @endforeach
      @endif

      //CONTACT
      /*$("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");*/
      

    @empty

    @endforelse


  });
</script>

@endsection
