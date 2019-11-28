@extends('layouts/argon-dashboard/theme')

@section('title',  'รายละเอียดรับชำระเงิน'  )
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title') {{ $customerpayment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/customer-payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/customer-payment/' . $customerpayment->id . '/edit') }}" title="Edit CustomerPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerpayment' . '/' . $customerpayment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customerpayment->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $customerpayment->doc_no }} </td></tr>
                                    <tr><th> Customer Id </th><td> {{ $customerpayment->customer->customer_code }} {{ $customerpayment->customer->company_name }} </td></tr>
                                    <tr><th> Role </th><td> {{ $customerpayment->role }} </td></tr>
                                    <tr><th> Remark </th><td> {{ $customerpayment->remark }} </td></tr>
                                    <tr><th> Round </th><td> {{ $customerpayment->round }} </td></tr>
                                    <tr><th> Customer Billing Id </th><td> </td></tr>
                                    <tr><th> Discount </th><td> {{ number_format($customerpayment->discount,2)  }} </td></tr>
                                    <tr><th> Debt Total </th><td> {{ number_format($customerpayment->debt_total,2) }} </td></tr>
                                    <tr><th> Cash </th><td> {{ number_format($customerpayment->cash,2)  }} </td></tr>
                                    <tr><th> Credit </th><td> {{ number_format($customerpayment->credit,2)  }} </td></tr>
                                    <tr><th> Tax </th><td> {{ number_format($customerpayment->tax,2)  }} </td></tr>
                                    <tr><th> Payment Total </th><td> {{ number_format($customerpayment->payment_total,2)  }} </td></tr>
                                    <tr><th> User Id </th><td> {{ $customerpayment->user->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @php
                    $customer_billing_details = $customerpayment->customer_invoices;
                @endphp
                <div class="card">
                    <div class="card-header">รายละเอียดใบรับชำระเงิน</div>
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
                                            <a href="{{ url('/') }}/sales/invoice/{{ $row->invoice_id }}/edit">
                                                {{ $row->invoice_code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->datetime }}</td>
                                        <td>{{ $row->Customer->customer_code }}</td>
                                        <td><a href="{{ url('/customer') }}/{{ $row->customer_id }}">{{ $row->Customer->company_name }}</a></td>
                                        <td>{{ $row->total_debt }}</td>
                                        <td>{{ number_format($row->total?$row->total:0,2) }}</td>
                                        <td>{{ $row->User->short_name }}</td>
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
