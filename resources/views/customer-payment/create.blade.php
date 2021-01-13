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

                
                // // validation code here ...
                // var invoice_payments = document.querySelectorAll(".invoice_payments");
                // var sum = 0;
                // for(element of invoice_payments){
                //     sum += parseFloat(element.value ? element.value : '0'); 
                // }
                // var amount_discount_fee = parseFloat((document.querySelector("#amount-discount-fee").value != "" ? document.querySelector("#amount-discount-fee").value : '0'));
                // var amount_cash_transfer_in = parseFloat((document.querySelector("#amount-cash-transfer-in").value != "" ? document.querySelector("#amount-cash-transfer-in").value : '0'));
                // var amount_deposite_cheque = parseFloat((document.querySelector("#amount-deposite-cheque").value != "" ? document.querySelector("#amount-deposite-cheque").value : '0'));
                // var amount_credit = parseFloat((document.querySelector("#amount-credit").value != "" ? document.querySelector("#amount-credit").value : '0'));
                // var total_payment = amount_cash_transfer_in + amount_deposite_cheque + amount_credit;
                // var valid = false;
                // console.log(sum);
                // console.log(amount_discount_fee);
                // console.log(amount_cash_transfer_in);
                // console.log(amount_deposite_cheque);
                // console.log(amount_credit);
                // console.log(total_payment);
                let payment_total = Number(document.querySelector("#payment_total").value);
                let payment_method_total = Number(document.querySelector("#payment_method_total").value);
                if(payment_total == payment_method_total){
                    return confirm('Do you really want to submit the form?');
                }else{
                    alert('คุณกรอกวิธีการชำระเงินไม่ตรงกับยอด');
                    return false;
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
                    @php
                        $transaction_code_object = [
                            "discount-fee" => "ส่วนลด/ค่าธรรมเนียม",
                            "cash-transfer-in" => "โอนเงินสด",
                            "deposite-cheque" => "ฝากด้วยเช็ค",
                            "credit" => "บัตรเครดิต",
                        ];
                    @endphp

                    <div class="card mb-4">
                        <!-- <div class="card-header">วิธีการชำระเงิน</div> -->
                        <div class="card-body">
                            @include('customer-payment/payment-modal')
                            <h3>วิธีการชำระเงิน</h3>
                            <table class="table table-sm text-center  table-bordered">
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
                                            <input class="form-control form-control-sm " name="cheque[]" type="text" id="cheque-{{$key}}" step="any" value="">                            
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" name="remark[]" type="text" id="remark" value="" >  
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </tfoot>
                                    <tr>    
                                        <th></th>
                                        <th></th>
                                        <th>รวม</th>
                                        <th>
                                            <input class="form-control form-control-sm" name="" type="text" id="payment_method_total" value="0" readonly >  
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                

                            </table>                         

                            <div class="form-group form-row mt-4 text-center">
                                <label class="col-lg-3">อัพโหลดไฟล์ชำระเงิน</label>
                                <input class="col-lg-3 form-control form-control-sm" name="payment_file" type="file" id="payment_file" value="" >  
                            <div class="form-group">
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
            let total_debt = Number($('#debt_total').val());
            let sum = 0;
            $('.payments').each(function(i) {
                sum += Number($(this).val());
                
                
            });
            for(let i=0; i<document.querySelectorAll(".payments").length; i++){
                let payment = document.querySelectorAll(".payments")[i];            
                let remain = document.querySelectorAll(".remains")[i]; 
                console.log(payment,remain);
                remain.value = payment.getAttribute("total_debt") - payment.value;
            }
            sum = Number(sum.toFixed(2));
            total_debt = Number(total_debt.toFixed(2));
            let remain = total_debt-sum;
            $("#payment_total").val(sum.toFixed(2));
            $("#remain_total").val(remain.toFixed(2));
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
                    /*
                    let total_payment = $("#payment_total").val();
                    let remaining_amount = Number(total_payment) - Number(amount);
                    if( $("#amount-cash-transfer-in").val() == ""){
                        $("#amount-cash-transfer-in").val(remaining_amount);                    
                        $("#date-cash-transfer-in").val(moment().format("YYYY-MM-DD"));
                    }
                    */
                    break;
                case "cash-transfer-in" : 
                    break;
                case "deposite-cheque" : 
                    break;
                case "credit" : 
                    break;
            }

            let payment_method_total = document.querySelector("#payment_method_total");
            let amount_modal = document.querySelector("#amount_modal");
            let payments_amount = document.querySelectorAll(".payments-amount");

            let payment_total = Number(document.querySelector("#payment_total").value);
            let sum = 0;
            for(let item of payments_amount){
                sum += Number(item.value);
            }
            payment_method_total.value = sum;
            amount_modal.value = Number(payment_total - sum).toFixed(2);
            
        });
    })
    </script>
@endsection
