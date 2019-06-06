@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบส่งของชั่วคราว')

@section('content')

<form class="" action="{{ url('/') }}/sales/delivery_temporary" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/delivery_temporary/form')
    <div class="text-center mt-5">
      <a class="btn btn-outline-primary " href="{{ url('/') }}/sales/delivery_temporary">back</a>
      <button type="submit" class="btn btn-primary " id="form-submit">Save</button>

    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#delivery_temporary_code").value = "";
    document.querySelector("#customer_id").value = "";
    //document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';

    //CUSTOMER DATA
    document.querySelector("#debt_duration").value = "60";
    document.querySelector("#billing_duration").value = "30";
    document.querySelector("#payment_condition").value = "ภายใน 30 วัน";
    document.querySelector("#delivery_type_id").value = "2";
    document.querySelector("#tax_type_id").value = "2";
    document.querySelector("#delivery_time").value = "30";
    document.querySelector("#zone_id").value = "1";

    //END
    document.querySelector("#department_id").value = "{{ Auth::user()->role}}";
    document.querySelector("#sales_status_id").value = "1";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";

    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
  });

</script>

@endsection
