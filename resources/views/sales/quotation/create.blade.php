@extends('layouts/argon-dashboard/theme')

@section('title','สร้างใบเสนอราคา')

@section('background-tag','bg-warning')

@section('content')

<form class="" action="{{ url('/') }}/sales/quotation" method="POST" onsubmit="return confirm('Do you confirm to save?')" >
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/quotation/form')
    <div class="text-center mt-5">
      <a class="btn btn-outline-success " href="{{ url('/') }}/sales/quotation">back</a>
      <button type="submit" class="btn btn-success " id="form-submit">Save</button>

    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#quotation_code").value = "";
    document.querySelector("#customer_id").value = "";
    //document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';

    //CUSTOMER DATA
    document.querySelector("#debt_duration").value = "";
    document.querySelector("#billing_duration").value = "";
    document.querySelector("#payment_condition").value = "";
    document.querySelector("#delivery_type_id").value = "";
    document.querySelector("#tax_type_id").value = "";
    document.querySelector("#delivery_time").value = "";
    document.querySelector("#zone_id").value = "";

    //END
    document.querySelector("#department_id").value = "{{ Auth::user()->role}}";
    document.querySelector("#sales_status_id").value = "1"; //ส่งใบเสนอราคา
    document.querySelector("#user_id").value = "{{ Auth::id() }}";

    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
    $('form input').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
    @if( !empty(request('customer_id')) )
      $("#btn-customer").click();
      
      
    @endif
    
  });

</script>

@endsection
