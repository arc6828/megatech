@extends('layouts/argon-dashboard/theme')

@section('title',  'ใบวางบิล #'.$customerbilling->id   )

@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">

                        <a href="{{ url('/finance/customer-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a class="d-none" href="{{ url('/finance/customer-billing/' . $customerbilling->id . '/edit') }}" title="Edit CustomerBilling"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerbilling' . '/' . $customerbilling->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm d-none" title="Delete CustomerBilling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customerbilling->id }}</td>
                                    </tr>
                                    <tr><th> Doc No </th><td> {{ $customerbilling->doc_no }} </td></tr>
                                    <tr><th> Total </th><td> {{ number_format($customerbilling->total,2) }} </td></tr>
                                    <tr><th> Customer Id </th><td> {{ $customerbilling->customer->customer_code }}  {{ $customerbilling->customer->company_name }} </td></tr>
                                    <tr><th> Condition Billing </th><td> {{ $customerbilling->condition_billing }} </td></tr>
                                    <tr><th> Condition Cheque </th><td> {{ $customerbilling->condition_cheque }} </td></tr>
                                    <tr><th> Date Billing </th><td> {{ $customerbilling->date_billing }} </td></tr>
                                    <tr>
                                        <th> Date Cheque </th>
                                        <td>                                             
                                            <form method="POST" action="{{ url('/finance/customer-billing/' . $customerbilling->id) }}" accept-charset="UTF-8" class="form-horizontal form-inline" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}       
                                                    
                                                    {{ $customerbilling->date_cheque }}                                              
                                                    <input class="form-control form-control-sm ml-4 mr-4" name="date_cheque" type="date" id="date_cheque" value="{{ isset($customerbilling->date_cheque) ? $customerbilling->date_cheque : ''}}" >                                                    
                                                    <input class="form-control form-control-sm " name="status" type="hidden" id="status" value="wait-for-cheque" >                                                    
                                                    <button type="submit" class="btn btn-sm btn-primary">save</button>                                              

                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <td> 
                                            
                                            
                                            
                                            <form method="POST" action="{{ url('/finance/customer-billing/' . $customerbilling->id) }}" accept-charset="UTF-8" class="form-horizontal form-inline" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}     
                                                @switch($customerbilling->status)
                                                    @case("ready") 
                                                        <span class="badge badge-pill badge-warning">รอวางบิล</span>
                                                        @break
                                                    @case("wait-for-cheque") 
                                                        <span class="badge badge-pill badge-success">รอรับเช็ค-โอน</span>
                                                        @break
                                                    @case("delay") 
                                                        <span class="badge badge-pill badge-danger">เลื่อน</span>
                                                        @break
                                                @endswitch 
                                                <select name="status" id="status" class="form-control form-control-sm ml-4">
                                                    <option value="ready">รอวางบิล</option>
                                                    <option value="wait-for-cheque" >รอรับเช็ค-โอน</option>
                                                    <option value="delay">เลื่อน</option>
                                                </select>                                
                                                <button type="submit" class="btn btn-sm btn-primary ml-4">save</button>                                              

                                            </form>

                                        </td>
                                    </tr>
                                    <tr><th> Remark </th><td> {{ $customerbilling->remark }} </td></tr>
                                    <tr><th> User Id </th><td> {{ $customerbilling->user->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @php
                    $customer_billing_details = $customerbilling->customer_billing_details;
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
                                        <td><a href2="{{ url('/customer') }}/{{ $row->invoice->customer_id }}">{{ $row->invoice->Customer->company_name }}</a></td>
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
