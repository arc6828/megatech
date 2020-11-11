@extends('layouts/argon-dashboard/theme')
<!-- start nav -->
@section('level-0-url', url('sales'))
@section('level-0','การขาย')

@section('level-1-url', url('sales/order'))
@section('level-1','ใบจอง')


@section('title','สร้าง')

@section('background-tag','bg-warning')


@section('content')

<div class="card mb-4">
  <div class="card-body">
    <form action="" method="GET">
      <input class="form-control"
        name="quotation_code" id="quotation_code"
        placeholder="Enter quotation Code ..."
        value="{{ request('quotation_code') }}"
        />
      <button class="d-none" id="btn-isbn">Submit</button>
    </form>
  </div>
</div>


<form class="main-form" action="{{ url('/') }}/sales/order" method="POST" onsubmit="return confirm('Do you confirm to save?')" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    @include('sales/order/form')
    <div class="text-center mt-4">

      <a class="btn btn-outline-success " href="{{ url('/') }}/sales/order">back</a>
      <button class="btn btn-success" type="submit" id="form-submit">Save</button>
    </div>
</form>

<script >
  document.addEventListener("DOMContentLoaded", function(event) {
    //INITIALIZE
    document.querySelector("#order_code").value = "";

    document.querySelector("#external_reference_id").value = "-";
    document.querySelector("#customer_id").value = "";


    document.querySelector("#customer_code").value = "";
    document.querySelector("#company_name").value = "";

    var str_time = moment().format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    document.querySelector("#debt_duration").value = "";
    document.querySelector("#billing_duration").value = "";
    document.querySelector("#payment_condition").value = "";
    document.querySelector("#delivery_type_id").value = "";
    document.querySelector("#tax_type_id").value = "";
    document.querySelector("#delivery_time").value = "";
    document.querySelector("#department_id").value = "{{ Auth::user()->role }}";
    document.querySelector("#sales_status_id").value = "7";
    document.querySelector("#user_id").value = "{{ Auth::id() }}";
    document.querySelector("#zone_id").value = "";
    document.querySelector("#total").value = "";
    document.querySelector("#remark").value = "";
    document.querySelector("#vat_percent").value = "7";

    //onChange(document.querySelector("#vat"));
    $("#quotation_code").focus();

    existQuotationCode();

    
    $('form.main-form input').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

    

  });

  function existQuotationCode(){
    //CLICK TO POPUP THE MODAL
    //console.log("SPAN : ", $("#customer_code"));
    if("{{ request('quotation_code') }}".length > 0){
      $("#customer_code").text("{{ $customer_code }}");
      $("#btn-customer").click();
    }
  }

  function onCustomerClick(){
    if("{{ request('quotation_code') }}".length > 0){
      //CLICK TO SELECT THE CUSTOMER + SEARCH BY QUOTATION CODE
      $("#btn-{{ $customer_code }}").click();

    }
  }

  function onSelectAllItem(){
    if("{{ request('quotation_code') }}".length > 0){
      //CHECKED ALL
      $("#table-product-quotation-model input[type=checkbox]").prop("checked",true);
      //SUBMIT
      console.log("#btn-add-products : ",$("#btn-add-products"));
      //$("#btn-add-products").click();
      //addAllProduct();

      //$("#quotation_code").focus();
      //$('#customerModal').modal('hide');
      //$('#quotationModal').modal('hide');
      document.querySelector("#table-product-quotation-model").click();
      document.querySelector("#btn-close-customer").click();
      //console.log("HEY ");
      //$.modal.close();
    }
  }
</script>

@endsection
