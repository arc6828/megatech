@extends('layouts/argon-dashboard/theme')
@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน')

@section('level-1-url', url('finance/customer-payment'))
@section('level-1','รับชำระเงิน')

@section('title',  'สร้าง'  )
@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <script>
            function validate(form) {

                
                // validation code here ...
                var invoice_payments = document.querySelectorAll(".invoice_payments");
                var sum = 0;
                for(element of invoice_payments){
                    sum += parseFloat(element.value ? element.value : '0'); 
                }
                var amount_discount_fee = parseFloat((document.querySelector("#amount-discount-fee").value != "" ? document.querySelector("#amount-discount-fee").value : '0'));
                var amount_cash_transfer_in = parseFloat((document.querySelector("#amount-cash-transfer-in").value != "" ? document.querySelector("#amount-cash-transfer-in").value : '0'));
                var amount_deposite_cheque = parseFloat((document.querySelector("#amount-deposite-cheque").value != "" ? document.querySelector("#amount-deposite-cheque").value : '0'));
                var amount_credit = parseFloat((document.querySelector("#amount-credit").value != "" ? document.querySelector("#amount-credit").value : '0'));
                var total_payment = amount_cash_transfer_in + amount_deposite_cheque + amount_credit;
                var valid = false;
                console.log(sum);
                console.log(amount_discount_fee);
                console.log(amount_cash_transfer_in);
                console.log(amount_deposite_cheque);
                console.log(amount_credit);
                console.log(total_payment);
                if(total_payment == sum - amount_discount_fee){
                    valid = true;
                }else{
                    valid = false;
                }
                //return false;
                if(!valid) {
                    alert('คุณกรอกวิธีการชำระเงินไม่ตรงกับยอด');
                    return false;
                }
                else {
                    return confirm('Do you really want to submit the form?');
                }
            }
        </script>
    

        <form method="POST" onsubmit="return validate(this);" action="{{ url('/finance/customer-payment') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- <div class="card-header">@yield('title')</div> -->
                        <div class="card-body">
                            <!-- <a href="{{ url('/finance/customer-payment') }}" title="Back" class="btn btn-warning btn-sm"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a>
                            <br />
                            <br /> -->

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

                   @include('customer-payment/detail')

                    <div class="card mb-4">
                        <!-- <div class="card-header">วิธีการชำระเงิน</div> -->
                        <div class="card-body">
                            <h3>วิธีการชำระเงิน</h3>
                            <table class="table table-sm text-center  table-bordered">
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
                                            "discount-fee" => "ส่วนลด/ค่าธรรมเนียม",
                                            "cash-transfer-in" => "โอนเงินสด",
                                            "deposite-cheque" => "ฝากด้วยเช็ค",
                                            "credit" => "บัตรเครดิต",
                                        ];
                                    @endphp
                                    @foreach($transaction_code_object as $key => $value)
                                    <tr>
                                        <td>
                                            <input class="form-control form-control-sm" name="transaction_code[]" type="hidden" id="transaction_code" value="{{ $key }}">   
                                            <input class="form-control form-control-sm" name="" type="text" id="" value="{{ $value }}" readonly>  
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm payments-date" name="date[]" type="date" id="date-{{ $key }}" value="">    
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm" name="bank_account_id[]" id="bank_account_id" >
                                                @foreach( $bank_accounts as $bank_account )
                                                <option value="{{ $bank_account->id }}">{{ $bank_account->name }} {{ $bank_account->branch }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm payments-amount" name="amount[]" type="text" id="amount-{{$key}}" step="any" value="" key="{{ $key }}">                            
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" name="remark[]" type="text" id="remark" value="" >  
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
                <input class="btn btn-primary" type="submit" onclick="validate(this)" value="create">
                <button type="button" class="d-none" onclick="validate(this);"></button>
            </div>
        
        </form>
    </div>

    <script>
    $(function(){
        $(".payments").change(function(){
            console.log("Payment Change !!!");
            var sum = 0;
            $('.payments').each(function(i) {
                sum += Number($(this).val());
                
                
            });
            for(let i=0; i<document.querySelectorAll(".payments").length; i++){
                let payment = document.querySelectorAll(".payments")[i];            
                let remain = document.querySelectorAll(".remains")[i]; 
                console.log(payment,remain);
                remain.value = payment.getAttribute("total_debt") - payment.value;
            }
                
            $("#payment_total").val(sum);
        });
        $(".payments-amount").change(function(){
            //SET TODAY DATE IN THE SAME ROW IF AMOUNT EXIST
            let amount = $(this).val();
            let key = $(this).attr('key');
            if( amount != ""){
                $("#date-"+key).val(moment().format("YYYY-MM-DD"));
            }else{
                $("#date-"+key).val("");
            }
            
            
            //IF FEE CHANGED, SET REMAINING AMOUNT and DATE IN NEXT ROW
            switch(key){
                case "discount-fee" : 
                
                    let total_payment = $("#payment_total").val();
                    let remaining_amount = Number(total_payment) - Number(amount);
                    if( $("#amount-cash-transfer-in").val() == ""){
                        $("#amount-cash-transfer-in").val(remaining_amount);                    
                        $("#date-cash-transfer-in").val(moment().format("YYYY-MM-DD"));
                    }

                    break;
                case "cash-transfer-in" : 
                    break;
                case "deposite-cheque" : 
                    break;
                case "credit" : 
                    break;
            }

            
        });
    })
    </script>
@endsection
