@extends('layouts/argon-dashboard/theme')

@section('title','แก้ไขข้อมูลเจ้าหนี้')

@section('content')

@forelse ($table_supplier as $row)

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Contact</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Comment</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

    <form action="{{url('/')}}/supplier/{{$row->supplier_id}}" method="POST" id="form" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      @include('supplier/form')

      <div class="form-group mt-5">
        <div class="col-lg-12">
          <div class="text-center">
            <a class="btn btn-outline-primary " href="{{ url('/') }}/supplier">back</a>
            <button class="btn btn-primary" type="submit" >Update</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    @include('supplier/form-contact')
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    @include('supplier/form-comment')
  </div>
</div>

@empty

@endforelse


@endsection

@section('script')
<script>
  $(document).ready(function(){
    @forelse ($table_supplier as $row)
      $("#supplier_code").val("{{ $row->supplier_code }}");
      $("#company_name").val("{{ $row->company_name }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#user_id").val("{{ $row->user_id }}");
      $("#name").val("{{ $row->name }}");
      $("#contact_name").val("{{ $row->contact_name }}");
      $("#telephone").val("{{ $row->telephone }}");
      $("#fax").val("{{ $row->fax }}");
      $("#address").val("{{ $row->address }} {{ $row->address2 }}");
      $("#province").val("{{ $row->province }}");
      $("#district").val("{{ $row->district }}");
      $("#sub_district").val("{{ $row->sub_district }}");
      $("#zipcode").val("{{ $row->zipcode }}");
      $("#delivery_address").val("{{ $row->delivery_address }}  {{ $row->delivery_address2 }}");
      $("#delivery_province").val("{{ $row->delivery_province }}");
      $("#delivery_district").val("{{ $row->delivery_district }}");
      $("#delivery_sub_district").val("{{ $row->delivery_sub_district }}");
      $("#delivery_zipcode").val("{{ $row->delivery_zipcode }}");
      $("#zone_id").val("{{ $row->zone_id }}");
      $("#transpotation_id").val("{{ $row->transpotation_id }}");
      $("#remark").val("{{ $row->remark }}");
      $("#max_credit").val("{{ $row->max_credit }}");
      $("#debt_duration").val("{{ $row->debt_duration }}");
      $("#billing_condition").val("{{ $row->billing_condition }}");
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
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");
      $("#account_id").val("{{ $row->account_id }}");

    @empty

    @endforelse
  });
</script>
<div class="card  mt-4">
  <div class="card-body">

    <h2>ผู้ติดต่อ</h2>

    <table class="table table-sm table-bordered text-center" id="table">
      <thead>
        <tr>
          <th class="text-center">Date</th>
          <th class="text-center">Comment</th>
        </tr>
      </thead>
      <tbody>

        @foreach(["2019-01-23","2019-02-23"] as $row_contact)
        <tr>
          <td>
            {{ $row_contact }}
          </td>
          <td>
            ...
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  </div>
</div>

@endsection
