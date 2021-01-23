@extends('layouts/argon-dashboard/theme')

@section('title',  'รายละเอียดชำระเงิน'  )
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title') {{ $supplierpayment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/supplier-payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/supplier-payment/' . $supplierpayment->id . '/edit') }}" title="Edit SupplierPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('supplierpayment' . '/' . $supplierpayment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplierpayment->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $supplierpayment->doc_no }} </td></tr>
                                    <tr><th> Supplier Id </th><td> {{ $supplierpayment->supplier->supplier_code }} {{ $supplierpayment->supplier->company_name }} </td></tr>
                                    <tr><th> Role </th><td> {{ $supplierpayment->role }} </td></tr>
                                    <tr><th> Remark </th><td> {{ $supplierpayment->remark }} </td></tr>
                                    <tr><th> Round </th><td> {{ $supplierpayment->round }} </td></tr>
                                    <tr><th> Supplier Billing Id </th><td> </td></tr>
                                    <tr><th> Discount </th><td> {{ number_format($supplierpayment->discount,2)  }} </td></tr>
                                    <tr><th> Debt Total </th><td> {{ number_format($supplierpayment->debt_total,2) }} </td></tr>
                                    <tr><th> Cash </th><td> {{ number_format($supplierpayment->cash,2)  }} </td></tr>
                                    <tr><th> Credit </th><td> {{ number_format($supplierpayment->credit,2)  }} </td></tr>
                                    <tr><th> Tax </th><td> {{ number_format($supplierpayment->tax,2)  }} </td></tr>
                                    <tr><th> Payment Total </th><td> {{ number_format($supplierpayment->payment_total,2)  }} </td></tr>
                                    <tr><th> User Id </th><td> {{ $supplierpayment->user->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @php
                    $supplier_receives = $supplierpayment->supplier_receives;
                @endphp
                <div class="card">
                    <div class="card-header">รายละเอียดใบรับชำระเงิน</div>
                    <div class="card-body">
                        <div class="table-responsive table-breceiveed">
                            <table width="100%" class="table table-hover text-center table-sm" id="table">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-center">ใบวางบิล</th>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">เอกสารอ้างอิง</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th>
                                        <th class="text-center">ยอดรวม</th>
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier_receives as $row)
                                    <tr>
                                        <td>{{ $row->supplier_billing_detail->supplier_billing->doc_no }}</td>
                                        <td>
                                            <a href="{{ url('/') }}/sales/receive/{{ $row->receive_id }}/edit">
                                                {{ $row->receive_code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->datetime }}</td>
                                        
                                        <td>{{ $row->external_reference_id }}</td>
                                        <td>{{ $row->total_debt }}</td>
                                        <td>
                                            <input style="width:100px;" name="receive_payments[]" value="{{ $row->total_debt }}">
                                            
                                            <input type="hidden" name="receive_ids[]" value="{{ $row->receive_id }}">
                                        </td>
                                        <td class="d-none">{{ number_format($row->total?$row->total:0,2) }}</td>
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
