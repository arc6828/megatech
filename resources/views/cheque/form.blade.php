<div class="form-group {{ $errors->has('cheque_type_code') ? 'has-error' : ''}}">
    <label for="cheque_type_code" class="control-label">{{ 'Cheque Type Code' }}</label>
    <input class="form-control form-control-sm" name="cheque_type_code" type="text" id="cheque_type_code" value="{{ isset($cheque->cheque_type_code) ? $cheque->cheque_type_code :  request('cheque_type_code') }}" readonly>
    {!! $errors->first('cheque_type_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('doc_no') ? 'has-error' : ''}}">
    <label for="doc_no" class="control-label">{{ 'Doc No' }}</label>
    <input class="form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($cheque->doc_no) ? $cheque->doc_no : ''}}" readonly>
    {!! $errors->first('doc_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_date') ? 'has-error' : ''}}">
    <label for="cheque_date" class="control-label">{{ 'Cheque Date' }}</label>
    <input class="form-control form-control-sm" name="cheque_date" type="date" id="cheque_date" value="{{ isset($cheque->cheque_date) ? $cheque->cheque_date : ''}}" >
    {!! $errors->first('cheque_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('cheque_type') ? 'has-error' : ''}}">
    <label for="cheque_type" class="control-label">{{ 'Cheque Type' }}</label>
    <input class="form-control form-control-sm" name="cheque_type" type="text" id="cheque_type" value="{{ isset($cheque->cheque_type) ? $cheque->cheque_type : ''}}" >
    {!! $errors->first('cheque_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cheque_no') ? 'has-error' : ''}}">
    <label for="cheque_no" class="control-label">{{ 'Cheque No' }}</label>
    <input class="form-control form-control-sm" name="cheque_no" type="text" id="cheque_no" value="{{ isset($cheque->cheque_no) ? $cheque->cheque_no : ''}}" >
    {!! $errors->first('cheque_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($cheque->total) ? $cheque->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_fee') ? 'has-error' : ''}}">
    <label for="bank_fee" class="control-label">{{ 'Bank Fee' }}</label>
    <input class="form-control form-control-sm" name="bank_fee" type="number" id="bank_fee" value="{{ isset($cheque->bank_fee) ? $cheque->bank_fee : ''}}" >
    {!! $errors->first('bank_fee', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_account_id') ? 'has-error' : ''}}">
    <label for="bank_account_id" class="control-label">{{ 'รหัสธนาคาร' }}</label>
    <select class="form-control form-control-sm" name="bank_account_id" id="bank_account_id" >
        @foreach( $bank_accounts as $bank_account )
        <option value="{{ $bank_account->id }}">{{ $bank_account->code }}  {{ $bank_account->name }} {{ $bank_account->branch }}</option>
        @endforeach
    </select>
    {!! $errors->first('bank_account_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('passed_cheque_date') ? 'has-error' : ''}}">
    <label for="passed_cheque_date" class="control-label">{{ 'Passed Cheque Date' }}</label>
    <input class="form-control form-control-sm" name="passed_cheque_date" type="date" id="passed_cheque_date" value="{{ isset($cheque->passed_cheque_date) ? $cheque->passed_cheque_date : ''}}" >
    {!! $errors->first('passed_cheque_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
    <label for="reference" class="control-label">{{ 'Reference' }}</label>
    <input class="form-control form-control-sm" name="reference" type="text" id="reference" value="{{ isset($cheque->reference) ? $cheque->reference : ''}}" >
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control form-control-sm" name="status" type="text" id="status" value="{{ isset($cheque->status) ? $cheque->status : 'pending'}}"  readonly>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($cheque->user_id) ? $cheque->user_id : Auth::id() }}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
