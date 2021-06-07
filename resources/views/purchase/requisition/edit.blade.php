@extends('layouts/argon-dashboard/theme')
<!-- start nav -->
@section('level-0-url', url('purchase'))
@section('level-0', 'การซื้อ')

@section('level-1-url', url('purchase/requisition'))
@section('level-1', 'ใบเสนอซื้อ')

    @if ($mode == 'edit')
        @section('level-2-url', url('purchase/requisition/' . $purchase_requisition->purchase_requisition_id))
        @section('level-2', 'รายละเอียด')
        @endif

        @section('title', $mode == 'edit' ? 'แก้ไข' : 'รายละเอียด')

            <!-- end nav -->


        @section('background-tag', 'bg-success')

        @section('content')

            @forelse($table_purchase_requisition as $row)
                <form class="" action="{{ url('/') }}/purchase/requisition/{{ $row->purchase_requisition_id }}/update"
                    id="form" method="POST" onsubmit="return confirm('คุณต้องการเพิ่มจำนวนสั่งซื้อ ?');">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    @include('purchase/requisition/form')

                    <div class="mt-4 text-center">
                        <a class="btn btn-outline-success" href="{{ url('/') }}/purchase/requisition">back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
                <script>
                    document.addEventListener("DOMContentLoaded", function(event) {
                        //INITIALIZE
                        document.querySelector("#purchase_requisition_code").value =
                            "{{ $row->purchase_requisition_code }}";
                        document.querySelector("#external_reference_id").value = "{{ $row->external_reference_id }}";
                        document.querySelector("#internal_reference_id").value = "{{ $row->internal_reference_id }}";
                        document.querySelector("#customer_id").value = "{{ $row->customer_id }}";

                        document.querySelector("#company_name").value = "{{ $row->company_name }}";
                        document.querySelector("#customer_code").innerHTML = "{{ $row->customer_code }}";


                        var str_time = moment("{{ $row->datetime }}").format(
                            'DD MMM YYYY - HH:mm:ss'); //console.log(str_time);
                        var dateControl = document.querySelector('#datetime').value =
                            str_time; //dateControl.value = '2017-06-01T08:30';
                        document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";
                        document.querySelector("#billing_duration").value = "{{ $row->billing_duration }}";
                        document.querySelector("#payment_condition").value = "{{ $row->payment_condition }}";
                        document.querySelector("#delivery_type_id").value = "{{ $row->delivery_type_id }}";
                        document.querySelector("#tax_type_id").value = "{{ $row->tax_type_id }}";
                        document.querySelector("#delivery_time").value = "{{ $row->delivery_time }}";
                        document.querySelector("#department_id").value = "{{ $row->department_id }}";
                        document.querySelector("#purchase_status_id").value = "{{ $row->purchase_status_id }}";
                        document.querySelector("#user_id").value = "{{ $row->user_id }}";
                        document.querySelector("#zone_id").value = "{{ $row->zone_id }}";
                        document.querySelector("#total").value = "{{ $row->total }}";
                        document.querySelector("#remark").value = "{{ $row->remark }}";
                        document.querySelector("#vat_percent").value = "{{ $row->vat_percent }}";

                        onChange(document.querySelector("#vat_percent"));
                    });

                </script>

            @empty
                <div class="text-center">
                    This id does not exist
                </div>
            @endforelse

        @endsection
