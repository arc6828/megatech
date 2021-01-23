<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-success float-right" id="btn-customer" data-toggle="modal" data-target="#paymentModal">
	<i class="fa fa-plus"></i> เพิ่มวิธีการชำระเงิน
</button>

@php
//$invoices = $invoices? $invoices : [];
$customer_billing_total = ( $invoices ? $invoices->sum('total_debt') : 0 ) +  ( $debts ? $debts->sum('total_debt') : 0 );
@endphp

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">เลือกวิธีการชำระเงิน</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="form-group">
                    <label>ประเภทธุรกรรม</label>
                    <select class="form-control form-control-sm" id="transaction_code_modal" >                   
                        @foreach($transaction_code_object as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>                    
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>เลขที่เช็ค (ถ้ามี)</label>
                    <input class="form-control form-control-sm" id="check_modal" value="">
                </div>
                <div class="form-group">
                    <label>ธนาคาร</label>
                    <select class="form-control form-control-sm" id="bank_account_id_modal" >
                        @foreach( $bank_accounts as $bank_account )
                        <option value="{{ $bank_account->id }}">{{ $bank_account->name }} {{ $bank_account->branch }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>ยอดเงิน</label>
                    <input class="form-control form-control-sm" id="amount_modal" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : $customer_billing_total }}">
                </div>
                
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-success" data-dismiss="modal" id="btn-add-payment" onclick="addPayment();">เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

<script>	
	document.addEventListener("DOMContentLoaded", function(event) {
		
	});
    function addPayment(){
        console.log("ADD PAYMENT");
        let transaction_code_modal = document.querySelector("#transaction_code_modal").value;
        let element;
        switch(transaction_code_modal){
            case "discount-fee" : 
                element = document.querySelector("#amount-discount-fee")
                element.value = document.querySelector("#amount_modal").value;
                $(element).change();
                break;
            case "cash-transfer-in" :             
                element = document.querySelector("#amount-cash-transfer-in")
                element.value = document.querySelector("#amount_modal").value;
                $(element).change();
                break;
            case "deposite-cheque" :             
                element = document.querySelector("#amount-deposite-cheque")
                element.value = document.querySelector("#amount_modal").value;
                $(element).change();
                break;
            case "credit" : 
                break;

        }
    }
</script>
