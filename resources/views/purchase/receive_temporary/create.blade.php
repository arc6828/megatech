@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0','การซื้อ')

@section('level-1-url', url('purchase/receive_temporary'))
@section('level-1','ใบรับของชั่วคราว')

@section('title','สร้าง')

@section('background-tag','bg-success')

@section('content')

<form class="" action="{{ url('/') }}/purchase/receive_temporary" method="POST" onsubmit="return confirm('ต้องการสร้างใบรับของชั่วคราว ?')">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('purchase/receive_temporary/form')
    <div class="text-center mt-5">
      <a class="btn btn-outline-success " href="{{ url('/') }}/purchase/receive_temporary">back</a>
      <button type="submit" class="btn btn-success " id="form-submit">Save</button>

    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#receive_temporary_code").value = "";
    document.querySelector("#supplier_id").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';

    document.querySelector("#debt_duration").value = "60";
    document.querySelector("#billing_duration").value = "30";
    document.querySelector("#payment_condition").value = "ภายใน 30 วัน";
    document.querySelector("#receive_type_id").value = "2";
    document.querySelector("#tax_type_id").value = "2";
    document.querySelector("#receive_time").value = "30";
    document.querySelector("#zone_id").value = "1";

    document.querySelector("#department_id").value = "{{ Auth::user()->role}}";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";
  });

</script>

@endsection
