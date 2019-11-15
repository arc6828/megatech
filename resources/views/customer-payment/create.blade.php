@extends('layouts/argon-dashboard/theme')

@section('title',  'สร้างการรับชำระเงิน'  )

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/customer-payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/customer-payment') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('customer-payment.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>

                @php
                    $customer_billing_details = $customer_billing->customer_billing_details;
                @endphp
                <div class="card">
                    <div class="card-header">รายละเอียดใบวางบิล</div>
                    <div class="card-body">
                        <div class="table-responsive table-binvoiceed">
                            <table width="100%" class="table table-hover text-center table-sm" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">รหัสลูกค้า</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th>
                                        <th class="text-center">ยอดรวม</th>
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer_billing_details as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/') }}/sales/invoice/{{ $row->invoice->invoice_id }}/edit">
                                                {{ $row->invoice->invoice_code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->invoice->datetime }}</td>
                                        <td>{{ $row->invoice->Customer->customer_code }}</td>
                                        <td><a href="{{ url('/customer') }}/{{ $row->invoice->customer_id }}">{{ $row->invoice->Customer->company_name }}</a></td>
                                        <td>{{ $row->invoice->total_debt }}</td>
                                        <td>{{ number_format($row->invoice->total?$row->invoice->total:0,2) }}</td>
                                        <td>{{ $row->invoice->User->short_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                   
                        <script>
                        document.addEventListener("DOMContentLoaded", function(event) {
                                console.log("555");
                                //$('#table').DataTable().order( [ 0, 'desc' ] ).draw();
                        });

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
