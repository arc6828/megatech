@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0', 'การซื้อ')

@section('level-1-url', url('purchase/requisition'))
@section('level-1', 'ใบเสนอซื้อ')

@section('title', 'สร้าง')

@section('background-tag', 'bg-success')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="GET">
                        <input class="form-control" name="order_code" id="order_code" placeholder="Enter OE Code ..."
                            value="{{ request('order_code') }}" />
                        <button class="d-none" id="btn-isbn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form class="" action="{{ url('/') }}/purchase/requisition" method="POST"
        onsubmit="return confirm('คุณต้องการสร้างใบเสนอซื้อใช่หรือไม่?');">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        @include('purchase/requisition/form')
        <div class="mt-4 text-center">
            <a class="btn btn-outline-success" href="{{ url('/') }}/purchase/requisition">back</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            //INITIALIZE
            document.querySelector("#purchase_requisition_code").value = "";
            document.querySelector("#internal_reference_id").value = "-";
            document.querySelector("#customer_id").value = "";
            //document.querySelector("#contact_name").value = "";
            var str_time = moment().format('DD MMM YYYY - HH:mm:ss'); //console.log(str_time);
            var dateControl = document.querySelector('#datetime').value =
                str_time; //dateControl.value = '2017-06-01T08:30';
            document.querySelector("#debt_duration").value = "";
            document.querySelector("#billing_duration").value = "";
            document.querySelector("#payment_condition").value = "";
            document.querySelector("#delivery_type_id").value = "";
            document.querySelector("#tax_type_id").value = "";
            document.querySelector("#delivery_time").value = "";
            document.querySelector("#department_id").value = "{{ Auth::user()->role }}";
            document.querySelector("#purchase_status_id").value = "1"; // draft
            document.querySelector("#user_id").value = "{{ Auth::id() }}";
            document.querySelector("#zone_id").value = "1";
            document.querySelector("#total").value = "";
            document.querySelector("#remark").value = "";
            document.querySelector("#vat_percent").value = "7";

            //onChange(document.querySelector("#vat"));
        });

    </script>

@endsection
