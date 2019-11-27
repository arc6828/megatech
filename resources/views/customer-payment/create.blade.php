@extends('layouts/argon-dashboard/theme')

@section('title',  'สร้างการรับชำระเงิน'  )

@section('content')
    <div class="container">
    

        <form method="POST" action="{{ url('/finance/customer-payment') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
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

                        @include ('customer-payment.form', ['formMode' => 'create'])


                    </div>
                </div>

                @php
                //$invoices = $invoices? $invoices : [];
                @endphp
                <div class="card mb-4">
                    <div class="card-header">รายละเอียด Invoice</div>
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
                                        <th class="text-center">รับชำระ</th>
                                        <th class="text-center d-none">ยอดรวม</th>
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $row)
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
                                        <td><input style="width:100px;"></td>
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

                <div class="card mb-4">
                    <div class="card-header">วิธีการชำระเงิน</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ประเภท Transaction</th>
                                    <th>วันที่</th>
                                    <th>รหัสธนาคาร</th>
                                    <th>ยอดเงินฝาก</th>
                                    <th>หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $transaction_code_object = [
                                        "cash-transfer" => "โอนเงินสด",
                                        "discount-fee" => "ส่วนลด/ค่าธรรมเนียม",
                                        "deposite-cheque" => "ฝากด้วยเช็ค",
                                    ];
                                @endphp
                                @foreach($transaction_code_object as $key => $value)
                                <tr>
                                    <td>
                                        <input class="form-control form-control-sm" name="transaction_code" type="hidden" id="transaction_code" value="{{ $key }}">   
                                        <input class="form-control form-control-sm" name="" type="text" id="" value="{{ $value }}" readonly>  
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" name="date" type="date" id="date" value="">    
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" name="bank_account_id" id="bank_account_id" >
                                            @foreach( $bank_accounts as $bank_account )
                                            <option value="{{ $bank_account->id }}">{{ $bank_account->name }} {{ $bank_account->branch }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" name="amount" type="number" id="amount" value="" >                            
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" name="remark" type="text" id="remark" value="" >  
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                         

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-4">
            <input class="btn btn-primary" type="submit" value="create">
        </div>
        
        </form>
    </div>
@endsection
