@extends('layouts/argon-dashboard/theme')

<!-- start nav -->
@section('level-0-url', url('purchase'))
@section('level-0', 'การซื้อ')

@section('level-1-url', url('purchase/order'))
@section('level-1', 'ใบสั่งซื้อ')

    @if ($mode == 'edit')
        @section('level-2-url', url('purchase/order/' . $order->purchase_order_id))
        @section('level-2', 'รายละเอียด')
        @endif
        @section('title', $mode == 'edit' ? 'แก้ไข' : 'รายละเอียด')
        @section('background-tag', 'bg-success')
        @section('content')

            @forelse($table_purchase_order as $row)

                <form class="" action="{{ url('/') }}/purchase/order/{{ $row->purchase_order_id }}/update" id="form"
                    method="POST" onsubmit="return confirm('Do you confirm to save?')">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @include('purchase/order/form' , ["method"=>"edit"] )
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function(event) {
                        //INITIALIZE
                        document.querySelector("#purchase_order_code").value = "{{ $row->purchase_order_code }}";
                        document.querySelector("#external_reference_doc").value = "{{ $row->external_reference_doc }}";
                        document.querySelector("#supplier_id").value = "{{ $row->supplier_id }}";
                        document.querySelector("#company_name").value = "{{ $row->company_name }}";
                        document.querySelector("#supplier_code").innerHTML = "{{ $row->supplier_code }}";
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
