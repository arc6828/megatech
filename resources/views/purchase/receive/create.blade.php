@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบรับ/ซื้อสินค้า')


@section('content')
<div class="card mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
          <input class="form-control" id="po_code" placeholder="Enter PO Code ..." onkeypress="onKeyPressEnter(event);">
          <button class="d-none" id="btn-isbn"></button>
      </div>
    </div>
  </div>
</div>
<form class="" action="{{ url('/') }}/purchase/receive" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('purchase/receive/form')
    <div class="text-center mt-4">

        <a class="btn btn-outline-primary " href="{{ url('/') }}/purchase/receive">back</a>
        <button type="submit" class="btn btn-primary  " id="form-submit">Save</button>


    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#purchase_receive_code").value = "";
    document.querySelector("#supplier_id").value = "";
    //document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = "60";
    document.querySelector("#billing_duration").value = "30";
    document.querySelector("#payment_condition").value = "ภายใน 30 วัน";
    document.querySelector("#delivery_type_id").value = "2";
    document.querySelector("#tax_type_id").value = "2";
    document.querySelector("#delivery_time").value = "30";
    document.querySelector("#department_id").value = "{{ Auth::user()->role }}";
    //document.querySelector("#sales_status_id").value = "1";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "1";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
    $('#po_code').focus();
  });

</script>

@endsection
