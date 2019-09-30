@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบสั่งซื้อ')


@section('content')

<form class="" action="{{ url('/') }}/purchase/order" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('purchase/order/form' , ["method"=>"create"])
    <div class="text-center mt-4">
        <a class="btn btn-outline-primary d-none" href="{{ url('/') }}/purchase/order">back</a>
        <button type="submit" class="btn btn-primary  " id="form-submit">Save</button>
    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#purchase_order_code").value = "";
    document.querySelector("#supplier_id").value = "";
    //document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = "";
    document.querySelector("#billing_duration").value = "";
    document.querySelector("#payment_condition").value = "";
    document.querySelector("#delivery_type_id").value = "";
    document.querySelector("#tax_type_id").value = "";
    document.querySelector("#delivery_time").value = "";
    document.querySelector("#department_id").value = "{{ Auth::user()->role }}";
    document.querySelector("#purchase_status_id").value = "1";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "1";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
  });

</script>

@endsection
