<div class="d-none form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'เลขที่เอกสาร' }}</label>
    <input class="form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($banktransaction->code) ? $banktransaction->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_account_id') ? 'has-error' : ''}}">
    <label for="bank_account_id" class="control-label">{{ 'รหัสธนาคาร' }}</label>
    <select class="form-control form-control-sm" name="bank_account_id" id="bank_account_id" >
        @foreach( $bank_accounts as $bank_account )
        <option value="{{ $bank_account->id }}">{{ $bank_account->name }} {{ $bank_account->branch }}</option>
        @endforeach
    </select>
    {!! $errors->first('bank_account_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('transaction_code') ? 'has-error' : ''}}">
    <label for="transaction_code" class="control-label">{{ 'ประเภท Transaction' }}</label>
    <input class="form-control form-control-sm" name="transaction_code" type="text" id="transaction_code" value="{{ isset($banktransaction->transaction_code) ? $banktransaction->transaction_code : request('transaction_code')}}" readonly>
    
    {!! $errors->first('transaction_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'ยอดเงินฝาก' }}</label>
    <input class="form-control form-control-sm" name="amount" type="number" id="amount" value="{{ isset($banktransaction->amount) ? $banktransaction->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="d-none form-group {{ $errors->has('balance') ? 'has-error' : ''}}">
    <label for="balance" class="control-label">{{ 'ยอดคงเหลือ' }}</label>
    <input class="form-control form-control-sm" name="balance" type="text" id="balance" value="{{ isset($banktransaction->balance) ? $banktransaction->balance : ''}}" >
    {!! $errors->first('balance', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
    <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($banktransaction->remark) ? $banktransaction->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="d-none form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($banktransaction->user_id) ? $banktransaction->user_id : Auth::id() }}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
