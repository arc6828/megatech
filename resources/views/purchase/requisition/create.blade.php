@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบเสนอซื้อ')

@section('content')

<form class="" action="{{ url('/') }}/purchase/requisition" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('purchase/requisition/form')
    <div class="mt-4 text-center">
      <a class="btn btn-outline-primary" href="{{ url('/') }}/purchase/requisition">back</a>
      <button type="submit" class="btn btn-primary" >Save</button>
    </div>

</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#purchase_requisition_code").value = "";
    document.querySelector("#customer_id").value = "";
    document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = "60";
    document.querySelector("#billing_duration").value = "30";
    document.querySelector("#payment_condition").value = "ภายใน 30 วัน";
    document.querySelector("#delivery_type_id").value = "2";
    document.querySelector("#tax_type_id").value = "2";
    document.querySelector("#delivery_time").value = "30";
    document.querySelector("#department_id").value = "1";
    document.querySelector("#purchase_status_id").value = "8";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "1";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
  });

</script>

@endsection
