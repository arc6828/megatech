<div class="form-row form-group text-center pr-5">
    <label for="bank_account_id" class="col-lg-3 control-label">{{ 'รหัสธนาคาร' }}</label>
    <select class="col-lg-3 form-control form-control-sm" name="bank_account_id" id="bank_account_id" >
        @foreach( $bank_accounts as $bank_account )
        <option value="{{ $bank_account->id }}">{{ $bank_account->name }} {{ $bank_account->branch }}</option>
        @endforeach
    </select>

    <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
    <input class="col-lg-3 form-control form-control-sm"  value="{{ isset($bank_account->created_at) ? $bank_account->created_at : ''}}"  readonly>
</div>
<div class="form-row form-group text-center pr-5">
    <label for="transaction_code" class="col-lg-3 control-label">{{ 'ประเภทธุรกรรม' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="transaction_code" type="text" id="transaction_code" value="{{ isset($banktransaction->transaction_code) ? $banktransaction->transaction_code : request('transaction_code')}}" readonly>
    
    <label for="amount" class="col-lg-3 control-label">{{ 'ยอดเงิน' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="amount" type="number" id="amount" value="{{ isset($banktransaction->amount) ? $banktransaction->amount : ''}}" >
    
</div>
<div class="form-row form-group text-center pr-5">
    <label for="remark" class="col-lg-3 control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="col-lg-3 form-control form-control-sm" rows="2" name="remark" type="textarea" id="remark" >{{ isset($banktransaction->remark) ? $banktransaction->remark : ''}}</textarea>
    
    <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($banktransaction->user_id) ? $banktransaction->user_id : Auth::id() }}" >
    
</div>
<div class="d-none form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="col-lg-3 control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($banktransaction->code) ? $banktransaction->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="d-none form-group {{ $errors->has('balance') ? 'has-error' : ''}}">
    <label for="balance" class="col-lg-3 control-label">{{ 'ยอดคงเหลือ' }}</label>
    <input class="col-lg-3 form-control form-control-sm" name="balance" type="text" id="balance" value="{{ isset($banktransaction->balance) ? $banktransaction->balance : ''}}" >
    {!! $errors->first('balance', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group text-center">
    <input class="btn btn-success" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
