@extends('layouts/argon-dashboard/theme')
@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน')

@section('level-1-url', url('finance/customer-payment'))
@section('level-1','รับชำระเงิน')

@section('title', 'รายละเอียด')

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- <div class="card-header">@yield('title') {{ $customerpayment->id }}</div> -->
                    <div class="card-body">

                        <!-- <a href="{{ url('/finance/customer-payment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/customer-payment/' . $customerpayment->id . '/edit') }}" title="Edit CustomerPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customerpayment' . '/' . $customerpayment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/> -->

                        <div class="form-group form-row text-center pr-5">    
                            <label class="col-lg-3"> รหัสเอกสาร </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->doc_no }} </small>
                            
                            <label class="col-lg-3"> วันที่ </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->created_at }} </small>
                        </div>
                        <div class="form-group form-row text-center pr-5">    
                            <label class="col-lg-3"> รหัสลูกค้า </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->customer->customer_code }} {{ $customerpayment->customer->company_name }}  </small>
                            
                            <label class="col-lg-3"> ยื่นภาษีในงวด </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->round }} </small>
                        </div>
                        <div class="form-group form-row text-center pr-5">    
                            <label class="col-lg-3"> พนักงานผู้บันทึก </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->user->name }}  </small>
                            
                            <label class="col-lg-3"> หมายเหตุ </label>
                            <small class="col-lg-3 text-left"> {{ $customerpayment->remark }} </small>
                        </div>

                        <div class="form-group form-row text-center pr-5">    
                            <label class="col-lg-3"> ยอดรวมหนี้ </label>
                            <small class="col-lg-3 text-left"> {{ number_format($customerpayment->debt_total,2) }}  </small>
                            
                            <label class="col-lg-3"> ยอดรวมรับชำระ </label>
                            <small class="col-lg-3 text-left"> {{ number_format($customerpayment->payment_total,2) }} </small>
                        </div>                        
                        <div class="form-group form-row text-center pr-5">    
                            <label class="col-lg-3"> อัพโหลดรูป </label>
                            <small class="col-lg-3 text-left"> <a href="{{ url('/storage/'.$customerpayment->payment_file) }}" target="_blank">{{ $customerpayment->payment_file }}<a>  </small>
                            
                        </div>     

                    </div>
                </div>

                @php
                    $customer_invoices = $customerpayment->customer_invoices;
                    $customer_debts = $customerpayment->customer_debts;
                    $customer_payment_details = $customerpayment->details()->get();
                @endphp
                <div class="card mb-4">
                    <!-- <div class="card-header">รายละเอียดใบรับชำระเงิน</div> -->
                    <div class="card-body">
                        <div class="table-responsive table-binvoiceed">
                            <h3>รายละเอียดใบรับชำระเงิน</h3>
                            <table width="100%" class="table table-hover text-center table-sm table-bordered" id="table">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-center">ใบวางบิล</th>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">เอกสารอ้างอิง</th>
                                        <th class="text-center">ยอดหนี้</th>
                                        <th class="text-center">ยอดชำระ</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer_payment_details as $row)
                                    <tr>
                                        <td>
                                            @php
                                                $short_code = substr($row->code , 0, 2);
                                            @endphp
                                            @switch($short_code)
                                                @case("IV")
                                                    {{ $row->invoice->customer_billing_detail->customer_billing->doc_no }}
                                                    @break
                                            @endswitch                                            
                                        </td>
                                        <td>{{ $row->invoice->invoice_code }}</td>
                                        <td>{{ explode(" ", $row->invoice->datetime)[0] }}</td>                                        
                                        <td>{{ $row->invoice->external_reference_id }}</td>
                                        <td>{{ number_format($row->total_debt,2) }}</td>
                                        <td>{{ number_format($row->total_payment,2) }}</td>
                                        <td>{{ number_format($row->total_remain,2) }}</td>
                                        <!-- <td class="d-none">
                                            <input style="width:100px;" name="invoice_payments[]" value="{{ $row->total_debt }}">
                                            
                                            <input type="hidden" name="invoice_ids[]" value="{{ $row->invoice_id }}">
                                        </td>
                                        <td class="d-none">{{ number_format($row->total?$row->total:0,2) }}</td> -->
                                         
                                    </tr>
                                    @endforeach

                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        
                                        <th class="text-center"> </th>
                                        <th class="text-center"> </th>
                                        <th class="text-center"> </th>
                                        <th class="text-center"> รวม </th>
                                        <th class="text-center">{{ number_format($customer_payment_details->sum('total_debt') , 2) }}</th>
                                        <th class="text-center">{{ number_format($customer_payment_details->sum('total_payment') , 2) }}</th>
                                        <th class="text-center">{{ number_format($customer_payment_details->sum('total_remain') , 2) }}</th> 
                                    </tr>
                                </tfoot>

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


                @php
                    $transaction_code_object = [
                        "discount-fee" => "ส่วนลด/ค่าธรรมเนียม",
                        "cash-transfer-in" => "โอนเงินสด",
                        "deposite-cheque" => "ฝากด้วยเช็ค",
                        "credit" => "บัตรเครดิต",
                    ];
                @endphp
                @php                    
                    $bank_transactions = $customerpayment->bank_transactions()->get();
                @endphp


                <div class="card mb-4">
                    <!-- <div class="card-header">รายละเอียดใบรับชำระเงิน</div> -->
                    <div class="card-body">
                        <div class="table-responsive table-binvoiceed">
                            <h3>วิธีการชำระเงิน</h3>
                            <table width="100%" class="table table-hover text-center table-sm table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>ประเภทธุรกรรม</th>
                                        <th>วันที่</th>
                                        <th>ธนาคาร</th>
                                        <th>ยอดเงิน</th>
                                        <th>เลขที่เช็ค</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bank_transactions as $item)
                                    <tr>
                                        <th>{{ $transaction_code_object[$item['transaction_code']] }}</th>
                                        <th>{{ explode(" ",$item->created_at)[0] }}</th>
                                        <th>{{ $item->bank_account->code }} {{ $item->bank_account->name }} {{ $item->bank_account->branch }}</th>
                                        <th>{{ $item->amount }}</th>
                                        <th>{{ $item->cheque_code }}</th>
                                        <th>{{ $item->remark }}</th>
                                    </tr>
                                    @endforeach

                                    
                                </tbody>
                                </tfoot>
                                    <tr>    
                                        <th></th>
                                        <th></th>
                                        <th>รวม</th>
                                        <th>{{ number_format($bank_transactions->sum('amount'),2) }}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>

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
