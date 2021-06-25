@extends('layouts/argon-dashboard/theme')
<!-- start nav -->
@section('level-0-url', url('sales'))
@section('level-0', 'การขาย')

@section('level-1-url', url('sales/invoice'))
@section('level-1', 'ใบขาย')

    @if ($mode == 'edit')
        @section('level-2-url', url('sales/invoice/' . $invoice->invoice_id))
        @section('level-2', 'รายละเอียด')
        @endif

        @section('title', $mode == 'edit' ? 'แก้ไข' : 'รายละเอียด')


        @section('background-tag', 'bg-warning')

        @section('navbar-menu')
            <div style="margin: 21px;">
                <a class="btn btn-outline-primary btn-sm" href="{{ url('/') }}/sales/invoice">back</a>
                <button class="btn btn-primary btn-sm" onclick="document.getElementById('form-submit').click();">Save</button>
            </div>
        @endsection

        @section('breadcrumb-menu')

        @endsection

        @section('content')

            @forelse($table_invoice as $row)

                <form class="d-none" action="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}/cancel" id="form-cancel"
                    method="POST" onsubmit="return confirm('Do you confirm to void?')">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button type="submit" class="btn btn-success " id="form-cancel-submit" style="width:150px;">Save</button>
                </form>

                <form class="" action="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}" id="form" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    @include('sales/invoice/form')

                    @if ($mode == 'edit')
                        <div class="mt-4 text-center">
                            <a href="{{ url('/') }}/sales/invoice" class="btn btn-outline-primary d-none"
                                style="width:150px;">back</a>
                            <button type="submit" class="btn btn-primary d-none" id="form-submit" style="width:150px;">Save</button>
                            <button class="d-none" type="button" onclick="setPreLoader(true);">CSSS</button>
                        </div>
                    @endif

                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function(event) {
                        //INITIALIZE
                        document.querySelector("#invoice_code").value = "{{ $row->invoice_code }}";
                        document.querySelector("#external_reference_id").value = "{{ $row->external_reference_id }}";
                        document.querySelector("#internal_reference_id").value = "{{ $row->internal_reference_id }}";
                        document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
                        document.querySelector("#customer_code").innerHTML = "{{ $row->customer_code }}";
                        document.querySelector("#company_name").value = "{{ $row->company_name }}";
                        document.querySelector("#customer_id").value = "{{ $row->customer_id }}";
                        //document.querySelector("#contact_name").value = "{{ $row->contact_name }}";
                        var str_time = moment("{{ $row->datetime }}").format(
                            'DD MMM YYYY - HH:mm:ss'); //console.log(str_time);
                        var dateControl = document.querySelector('#datetime').value =
                            str_time; //dateControl.value = '2017-06-01T08:30';
                        document.querySelector("#debt_duration").value = "{{ $row->debt_duration }}";

                        document.querySelector("#billing_duration").value =
                            "{{ date('Y-m-d', strtotime('+' . $row->debt_duration . ' days', strtotime($row->datetime))) }}";
                        document.querySelector("#payment_condition").value = "{{ $row->payment_condition }}";
                        document.querySelector("#payment_method").value = "{{ $row->payment_method }}";
                        document.querySelector("#payment_method_th").value =
                            "{{ $row->payment_method == 'credit' ? 'ขายเชื่อ' : 'ขายสด' }}";
                        document.querySelector("#max_credit").value = "{{ $row->max_credit }}";
                        document.querySelector("#delivery_type_id").value = "{{ $row->delivery_type_id }}";
                        document.querySelector("#tax_type_id").value = "{{ $row->tax_type_id }}";
                        //document.querySelector("#delivery_time").value = "{{ $row->delivery_time }}";
                        document.querySelector("#department_id").value = "{{ $row->department_id }}";
                        document.querySelector("#sales_status_id").value = "{{ $row->sales_status_id }}";
                        document.querySelector("#user_id").value = "{{ $row->user_id }}";
                        document.querySelector("#staff_id").value = "{{ $row->staff_id }}";
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
