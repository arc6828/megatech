@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน')

@section('level-1-url', url('finance/customer-billing'))
@section('level-1','ใบวางบิล')

@section('title', 'รายละเอียด')

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- <div class="card-header">@yield('title')</div> -->
                    <div class="card-body">

                        <!-- <a href="{{ url('/finance/customer-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a class="d-none" href="{{ url('/finance/customer-billing/' . $customerbilling->id . '/edit') }}" title="Edit CustomerBilling"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerbilling' . '/' . $customerbilling->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm d-none" title="Delete CustomerBilling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/> -->
                        <div class="form-row form-group text-center pr-5" >
                            <label class="col-lg-3"> รหัสเอกสาร </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->doc_no }} </small>
                            
                            <label class="col-lg-3"> วันที่ </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->created_at }} </small>
                        </div>

                        <div class="form-row form-group text-center pr-5" >                            
                            
                            <label class="col-lg-3"> รหัสลูกค้า </label>
                            <small class="col-lg-6 text-left"> {{ $customerbilling->customer->customer_code }}  {{ $customerbilling->customer->company_name }} </small>
                           
                            
                            
                        </div>

                        <div class="form-row form-group text-center pr-5" >                            
                            <label for="user_id" class="col-lg-3  control-label">{{ 'พนักงานขาย' }}</label>
                            <small class="col-lg-3 text-left">
                                {{ isset($customer) ? $customer->user->name : '' }}
                            </small>
                            <label class="col-lg-3"> พนักงานผู้บันทึก </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->user->name }}  </small>
                            
                        </div>

                        

                        <!-- <div class="form-row form-group text-center pr-5" >                            
                            <label class="col-lg-3">  เงื่อนไขการวางบิล </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->condition_billing }} </small>
                            
                            <label class="col-lg-3"> เงื่อนไขการรับเช็ค </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->condition_cheque }}  </small>
                        </div> -->

                        <div class="form-row form-group text-center pr-5" >                            
                            <label class="col-lg-3">  วันที่รับเช็ค </label>
                            <div class="col-lg-3"> 
                                <form method="POST" action="{{ url('/finance/customer-billing/' . $customerbilling->id) }}" accept-charset="UTF-8" class="form-horizontal form-inline" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}       
                                        
                                                                                        
                                        <input class="form-control form-control-sm mr-4" name="date_cheque" type="date" id="date_cheque" value="{{ isset($customerbilling->date_cheque) ? $customerbilling->date_cheque : ''}}" required>                                                    
                                        <input class="form-control form-control-sm " name="status" type="hidden" id="status" value="wait-for-cheque" >                                                    
                                        <button type="submit" class="btn btn-sm btn-primary">save</button>                                              

                                </form>
                            </div>
                            
                            <label class="col-lg-3"> สถานะ </label>
                            <div class="col-lg-3"> 
                                <form method="POST" action="{{ url('/finance/customer-billing/' . $customerbilling->id) }}" accept-charset="UTF-8" class="form-horizontal form-inline" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}    
                                    <select name="status" id="status2" class="form-control form-control-sm">
                                        <option value="ready">รอวางบิล</option>
                                        <option value="wait-for-cheque" >รอรับเช็ค-โอน</option>
                                        <option value="delay">เลื่อน</option>
                                    </select>     
                                    <script>
                                    
                                        document.querySelector("#status2").value = "{{$customerbilling->status}}"; 
                                    
                                    </script>                           
                                    <!-- <button type="submit" class="btn btn-sm btn-primary ml-4">save</button>                                               -->

                                </form>
                            </div>
                        </div>    
                        @if($customer)
                            <div class="px-5" >
                                @include('customer-billing/form-customer-billing')
                            </div>
                        @endif        

                        @if($customer)
                            <div class="px-5" >
                                @include('customer-billing/form-customer-cheque')
                            </div>
                        @endif            

                    </div>
                </div>

                @php
                    $customer_billing_details = $customerbilling->customer_billing_details;
                @endphp
                <div class="card mb-4">
                    <!-- <div class="card-header">รายละเอียดใบวางบิล</div> -->
                    <div class="card-body">
                        <h3>รายละเอียดใบวางบิล</h3>
                        <div class="table-responsive table-binvoiceed">
                            <table width="100%" class="table table-hover text-center table-sm table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <!-- <th class="text-center">รหัสลูกค้า</th> -->
                                        <th class="text-center">PO ลูกค้า</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th>
                                        <!-- <th class="text-center">ยอดรวม</th> -->
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer_billing_details as $row)
                                    <tr>
                                        <td> {{ $row->invoice->invoice_code }} </td>
                                        <td>{{ $row->invoice->datetime }}</td>
                                        <!-- <td>{{ $row->invoice->Customer->customer_code }}</td> -->
                                        <td>{{ $row->invoice->external_reference_id }}</td>
                                        <td>{{ number_format($row->invoice->total_debt,2) }}</td>
                                        <!-- <td>{{ number_format($row->invoice->total?$row->invoice->total:0,2) }}</td> -->
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

                <div class="card mb-4">
                    <!-- <div class="card-header">รายละเอียดใบวางบิล</div> -->
                    <div class="card-body">

                        <div class="form-row form-group text-center pr-5" >                            
                            <label class="col-lg-3">  หมายเหตุ </label>
                            <small class="col-lg-3 text-left"> {{ $customerbilling->remark }} </small>
                            
                            <label class="col-lg-3"> ยอดเงินรวม </label>
                            <small class="col-lg-3 text-left"> {{ number_format($customerbilling->total,2) }} </small>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
