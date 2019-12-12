@extends('layouts/argon-dashboard/theme')

@section('title',  'ใบวางบิล #'.$supplierbilling->id   )

@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/supplier-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/supplier-billing/' . $supplierbilling->id . '/edit') }}" title="Edit SupplierBilling"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('supplierbilling' . '/' . $supplierbilling->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierBilling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplierbilling->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $supplierbilling->doc_no }} </td></tr>
                                    <tr><th> Total </th><td> {{ number_format($supplierbilling->total,2) }} </td></tr>
                                    <tr><th> Supplier Id </th><td> {{ $supplierbilling->supplier->supplier_code }}  {{ $supplierbilling->supplier->company_name }} </td></tr>
                                    <tr><th> Condition Billing </th><td> {{ $supplierbilling->condition_billing }} </td></tr>
                                    <tr><th> Condition Cheque </th><td> {{ $supplierbilling->condition_cheque }} </td></tr>
                                    <tr><th> Date Billing </th><td> {{ $supplierbilling->date_billing }} </td></tr>
                                    <tr><th> Date Cheque </th><td> {{ $supplierbilling->date_cheque }} </td></tr>
                                    <tr><th> Remark </th><td> {{ $supplierbilling->remark }} </td></tr>
                                    <tr><th> User Id </th><td> {{ $supplierbilling->user->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @php
                    $supplier_billing_details = $supplierbilling->supplier_billing_details;
                @endphp
                <div class="card">
                    <div class="card-header">รายละเอียดใบวางบิล</div>
                    <div class="card-body">
                        <div class="table-responsive table-breceiveed">
                            <table width="100%" class="table table-hover text-center table-sm" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">รหัสเจ้าหนี้</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th>
                                        <th class="text-center">ยอดรวม</th>
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier_billing_details as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/') }}/purchase/receive/{{ $row->receive->receive_id }}/edit">
                                                {{ $row->receive->receive_code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->receive->datetime }}</td>
                                        <td>{{ $row->receive->Supplier->supplier_code }}</td>
                                        <td><a href="{{ url('/supplier') }}/{{ $row->receive->supplier_id }}">{{ $row->receive->Supplier->company_name }}</a></td>
                                        <td>{{ $row->receive->total_debt }}</td>
                                        <td>{{ number_format($row->receive->total?$row->receive->total:0,2) }}</td>
                                        <td>{{ $row->receive->User->short_name }}</td>
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
