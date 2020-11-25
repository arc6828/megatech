<div class="card mb-4">
    <div class="card-body text-center pr-5">
        <div class="form-row form-group">
            <label for="code" class="col-lg-3 control-label">{{ 'Code' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($issuestock->code) ? $issuestock->code : ''}}" >
            
            <label for="product_id" class="col-lg-3 control-label">{{ 'Product Id' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="product_id" type="number" id="product_id" value="{{ isset($issuestock->product_id) ? $issuestock->product_id : ''}}" >
        </div>
        <div class="form-row form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="amount" class="col-lg-3 control-label">{{ 'Amount' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="amount" type="text" id="amount" value="{{ isset($issuestock->amount) ? $issuestock->amount : ''}}" >
            
            <label for="status_id" class="col-lg-3 control-label">{{ 'Status Id' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="status_id" type="number" id="status_id" value="{{ isset($issuestock->status_id) ? $issuestock->status_id : ''}}" >
        </div>
        <div class="form-row form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            <label for="user_id" class="col-lg-3 control-label">{{ 'User Id' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($issuestock->user_id) ? $issuestock->user_id : ''}}" >
        
            <label for="remark" class="col-lg-3 control-label">{{ 'Remark' }}</label>
            <textarea class="col-lg-3 form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($issuestock->remark) ? $issuestock->remark : ''}}</textarea>
        </div>
        <div class="form-row form-group {{ $errors->has('total') ? 'has-error' : ''}}">
            <label for="total" class="col-lg-3 control-label">{{ 'Total' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($issuestock->total) ? $issuestock->total : ''}}" >
        
            <label for="revision" class="col-lg-3 control-label">{{ 'Revision' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="revision" type="number" id="revision" value="{{ isset($issuestock->revision) ? $issuestock->revision : ''}}" >
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        @include('issue-stock/detail')
        <div class="text-center pt-4">
        @include('issue-stock/create_detail_modal')
        </div>
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
