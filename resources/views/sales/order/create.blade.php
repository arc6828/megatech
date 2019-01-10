@extends('monster-lite/layouts/theme')

@section('title','สร้างใบจอง')

@section('navbar-menu')
  <div style="margin: 21px;">
    <a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/order">back</a>
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
  </div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<form class="" action="{{ url('/') }}/sales/order" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/order/form')
    <div>
      <button type="submit" class="d-none" id="form-submit">Save</button>
    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#order_code").value = "";
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
    document.querySelector("#sales_status_id").value = "8";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "1";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
  });

</script>

@endsection
