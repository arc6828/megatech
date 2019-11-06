<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($bankaccount->code) ? $bankaccount->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control form-control-sm" name="name" type="text" id="name" value="{{ isset($bankaccount->name) ? $bankaccount->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('branch') ? 'has-error' : ''}}">
    <label for="branch" class="control-label">{{ 'Branch' }}</label>
    <input class="form-control form-control-sm" name="branch" type="text" id="branch" value="{{ isset($bankaccount->branch) ? $bankaccount->branch : ''}}" >
    {!! $errors->first('branch', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="control-label">{{ 'Category Id' }}</label>
    <input class="form-control form-control-sm" name="category_id" type="number" id="category_id" value="{{ isset($bankaccount->category_id) ? $bankaccount->category_id : ''}}" >
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('account_no') ? 'has-error' : ''}}">
    <label for="account_no" class="control-label">{{ 'Account No' }}</label>
    <input class="form-control form-control-sm" name="account_no" type="text" id="account_no" value="{{ isset($bankaccount->account_no) ? $bankaccount->account_no : ''}}" >
    {!! $errors->first('account_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('balance_bring_forword') ? 'has-error' : ''}}">
    <label for="balance_bring_forword" class="control-label">{{ 'Balance Bring Forword' }}</label>
    <input class="form-control form-control-sm" name="balance_bring_forword" type="number" id="balance_bring_forword" value="{{ isset($bankaccount->balance_bring_forword) ? $bankaccount->balance_bring_forword : ''}}" >
    {!! $errors->first('balance_bring_forword', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('balance') ? 'has-error' : ''}}">
    <label for="balance" class="control-label">{{ 'Balance' }}</label>
    <input class="form-control form-control-sm" name="balance" type="number" id="balance" value="{{ isset($bankaccount->balance) ? $bankaccount->balance : ''}}" >
    {!! $errors->first('balance', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
