<div class="form-group form-row text-center pr-5">
    <label for="doc_no" class="col-lg-3 control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="doc_no" type="text" id="doc_no"
        value="{{ isset($customerpayment->doc_no) ? $customerpayment->doc_no : '' }}" readonly>

    <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
    <input class="col-lg-3 form-control form-control-sm"
        value="{{ isset($customerpayment->created_at) ? $customerpayment->created_at : '' }}" readonly>
</div>
@php
$customer_id = $customer ? $customer->customer_id : '';
$customer_code = $customer ? $customer->customer_code : '';
$customer_name = $customer ? $customer->company_name : '';
$customer_billing_id = '';
$customer_billing_doc_no = '';
$customer_billing_total = ($invoices ? $invoices->sum('total_debt') : 0) + ($debts ? $debts->sum('total_debt') : 0);

@endphp
<div class="form-group form-row text-center pr-5">
    <label for="customer_id" class="col-lg-3 control-label">{{ 'รหัสลูกค้า' }}</label>
    @include('customer-payment/customer_modal')
    <div class="col-lg-3  input-group input-group-sm ">
        <div class="input-group-prepend">
            <span class="input-group-text" name="customer_code" id="customer_code">
                {{ isset($customerpayment->customer_id) ? $customerpayment->customer->customer_code : $customer_code }}
            </span>
        </div>
        <input class="form-control form-control-sm"
            value="{{ isset($customerpayment->customer_id) ? $customerpayment->customer->company_name : $customer_name }}"
            disabled>
        <div class="input-group-append">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#customerModal">
                <i class="fa fa-plus"></i> เลือก
            </button>
        </div>
    </div>

    <label for="round" class="col-lg-3 control-label">{{ 'ยื่นภาษีในงวด' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="round" type="text" id="round"
        value="{{ isset($customerpayment->round) ? $customerpayment->round : '' }}">

</div>
<div class="form-group form-row text-center pr-5">
    <label for="user_id" class="col-lg-3  control-label">{{ 'พนักงานขาย' }}</label>
    <small class="col-lg-3  text-left">
        {{ isset($customerpayment->user_id) ? $customerpayment->customer->user->name : '' }}
    </small>

    <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
    <input class="col-lg-3 form-control form-control-sm d-none" name="user_id" type="number" id="user_id"
        value="{{ isset($customerpayment->user_id) ? $customerpayment->user_id : Auth::id() }}">
    <input class="col-lg-3 form-control form-control-sm"
        value="{{ isset($customerpayment->user_id) ? $customerpayment->user->name : Auth::user()->name }}" disabled>

</div>

<div class="form-group form-row text-center pr-5">
    <label for="remark" class="col-lg-3 control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="col-lg-3 form-control form-control-sm" rows="2" name="remark" type="textarea"
        id="remark">{{ isset($customerpayment->remark) ? $customerpayment->remark : '' }}</textarea>
</div>
@include('customer-payment/detail')
@php
$transaction_code_object = [
    'discount-fee' => 'ส่วนลด/ค่าธรรมเนียม',
    'cash-transfer-in' => 'โอนเงินสด',
    'deposite-cheque' => 'ฝากด้วยเช็ค',
    'credit' => 'บัตรเครดิต',
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

                @foreach ($transaction_code_object as $key => $value)
                    <tr>
                        <td>
                            <input class="form-control form-control-sm" name="transaction_code[]" type="hidden"
                                id="transaction_code" value="{{ $key }}">
                            <input class="form-control form-control-sm" name="" type="text" id=""
                                value="{{ $value }}" readonly>
                        </td>
                        <td>
                            <input class="form-control form-control-sm payments-date" name="date[]" type="date"
                                id="date-{{ $key }}" value="">
                        </td>
                        <td>
                            <select class="form-control form-control-sm" name="bank_account_id[]" id="bank_account_id">
                                @foreach ($bank_accounts as $bank_account)
                                    <option value="{{ $bank_account->id }}">{{ $bank_account->name }}
                                        {{ $bank_account->branch }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="form-control form-control-sm payments-amount" name="amount[]" type="text"
                                id="amount-{{ $key }}" step="any" value="" key="{{ $key }}">
                        </td>
                        <td>
                            <input class="form-control form-control-sm " name="cheque[]" type="text"
                                id="cheque-{{ $key }}" step="any" value="">
                        </td>
                        <td>
                            <input class="form-control form-control-sm" name="remark[]" type="text" id="remark"
                                value="">
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
                    <input class="form-control form-control-sm" name="" type="text" id="payment_method_total" value="0"
                        readonly>
                </th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>

        <div class="form-group form-row mt-4 text-center">
            <label class="col-lg-3">อัพโหลดไฟล์ชำระเงิน</label>
            <input class="col-lg-3 form-control form-control-sm" name="payment_file" type="file" id="payment_file"
                value="">
            <div class="form-group">
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
        </div>

        {{-- <div class="form-group d-none {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="col-lg-3 control-label">{{ 'รหัสแผนก' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="role" type="text" id="role" value="{{ isset($customerpayment->role) ? $customerpayment->role : Auth::user()->role }}" readonly>
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}

    <label for="customer_billing_id" class="col-lg-3 control-label">{{ 'เลขที่ใบวางบิล' }}</label>
    <input class="form-control form-control-sm d-none" name="customer_billing_id" type="hidden" id="customer_billing_id" value="{{ isset($customerpayment->customer_billing_id) ? $customerpayment->customer_billing_id : $customer_billing_id }}" >
    <input class="col-lg-3 form-control form-control-sm" value="{{ isset($customerpayment->customer_billing_id) ? $customerpayment->customer_billing_id : $customer_billing_doc_no }}" disabled>
    
</div>

<div class="form-group d-none {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="col-lg-3 control-label">{{ 'ส่วนลด ณ รับชำระ' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="discount" type="number" id="discount" value="{{ isset($customerpayment->discount) ? $customerpayment->discount : ''}}" readonly>
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group d-none {{ $errors->has('cash') ? 'has-error' : ''}}">
    <label for="cash" class="col-lg-3 control-label">{{ 'ยอดเงินสดรับ' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="cash" type="number" id="cash" value="{{ isset($customerpayment->cash) ? $customerpayment->cash : ''}}" readonly >
    {!! $errors->first('cash', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('credit') ? 'has-error' : ''}}">
    <label for="credit" class="col-lg-3 control-label">{{ 'ยอดเช็ครับ' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="credit" type="number" id="credit" value="{{ isset($customerpayment->credit) ? $customerpayment->credit : ''}}" readonly>
    {!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('tax') ? 'has-error' : ''}}">
    <label for="tax" class="col-lg-3 control-label">{{ 'ภาษี ณ  ที่จ่าย' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="tax" type="number" id="tax" value="{{ isset($customerpayment->tax) ? $customerpayment->tax : ''}}" >
    {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
</div>
<!--for cheque -->
<div class="form-group d-none {{ $errors->has('cheque_type_code') ? 'has-error' : ''}}">
    <label for="cheque_type_code" class="col-lg-3 control-label">{{ 'Cheque Type Code' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="cheque_type_code" type="text" id="cheque_type_code" value="{{ isset($cheque->cheque_type_code) ? $cheque->cheque_type_code :  'cheque-in' }}" readonly>
    {!! $errors->first('cheque_type_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cheque_date') ? 'has-error' : ''}}">
    <label for="cheque_date" class="col-lg-3 control-label">{{ 'Cheque Date' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="cheque_date" type="date" id="cheque_date" value="{{ isset($cheque->cheque_date) ? $cheque->cheque_date : ''}}" >
    {!! $errors->first('cheque_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cheque_no') ? 'has-error' : ''}}">
    <label for="cheque_no" class="col-lg-3 control-label">{{ 'เลขที่เช็ค' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="cheque_no" type="text" id="cheque_no" value="{{ isset($cheque->cheque_no) ? $cheque->cheque_no : ''}}" >
    {!! $errors->first('cheque_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('total_cheque') ? 'has-error' : ''}}">
    <label for="total_cheque" class="col-lg-3 control-label">{{ 'ยอดเช็ครับ' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="total_cheque" type="number" id="total_cheque" value="{{ isset($cheque->total_cheque) ? $cheque->total_cheque : ''}}" >
    {!! $errors->first('total_cheque', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="col-lg-3 control-label">{{ 'รายละเอียดสาขา' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="reference" type="text" id="reference" value="{{ isset($cheque->reference) ? $cheque->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-lg-3 control-label">{{ 'Status' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="status" type="text" id="status" value="{{ isset($cheque->status) ? $cheque->status : 'pending'}}"  readonly>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div> --}}
