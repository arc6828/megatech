@extends('layouts/argon-dashboard/theme')
<!-- start nav -->
@section('level-0-url', url('sales'))
@section('level-0','การขาย')

@section('level-1-url', url('sales/order'))
@section('level-1','ใบขาย')

@section('title','สร้าง')


@section('background-tag','bg-warning')

@section('content')
<div class="card mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <form action="{{ url('/') }}/sales/invoice/create" method="GET">
          <input class="form-control"
            name="order_code"id="order_code" placeholder="Enter Order barcode ..." onkeypress="onKeyPressEnter(event);"
            value="{{ request('order_code') }}"
            />
          <button class="d-none" id="btn-isbn">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<form class="" action="{{ url('/') }}/sales/invoice" method="POST" onsubmit="return confirm('คุณต้องการสร้างใบขายใช่หรือไม่?');">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/invoice/form')

    <div class="text-center mt-4">
      <a class="btn btn-outline-success" href="{{ url('/') }}/sales/invoice"> <i class="fa fa-arrow-left" aria-hidden="true"></i> back</a>
      <button type="submit"  class="btn btn-success">Save</button>
    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#invoice_code").value = "";
    document.querySelector("#customer_id").value = "";
    //document.querySelector("#contact_name").value = "";
    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = "60";
    document.querySelector("#billing_duration").value = "30";
    document.querySelector("#payment_condition").value = "ภายใน 30 วัน";
    document.querySelector("#delivery_type_id").value = "2";
    document.querySelector("#tax_type_id").value = "2";
    //document.querySelector("#delivery_time").value = "30";
    document.querySelector("#department_id").value = "{{ Auth::user()->role }}";
    document.querySelector("#sales_status_id").value = "1";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "1";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
    $('#order_code').focus();
    var order_code = $('#order_code').val();
    if( order_code.length > 0 ){
      onKeyISBN();
    }
  });

  //onKeyISBN
  function onKeyISBN(){
    //GET INFORMATION
    var order_id = $("#order_code").val();
    fillInvoice(order_id);
    //SELECT MODAL
    //$("#btn-customer").click();
    //SELECT CUSTOMER BY CLICK

    //$("#").click();
    //SELECT OE BY CLICK

  //  $("#").click();
  }
  function onKeyPressEnter(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13) { //Enter keycode
      //alert('enter press');
      onKeyISBN();
    }
  }

</script>

@endsection
