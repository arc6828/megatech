<div class="card mb-4">
    <div class="card-body text-center pr-5">
        <div class="form-row form-group">
            <label for="code" class="col-lg-3 control-label">{{ 'รหัสเอกสาร' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($issuestock->code) ? $issuestock->code : ''}}"  readonly>
            
            <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
            <input class="col-lg-3 form-control form-control-sm"  value="{{ isset($issuestock->created_at) ? $issuestock->created_at : ''}}"  readonly>
            
        </div>
        <div class="form-row form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="product_id" class="col-lg-3 control-label">{{ 'สินค้าสำเร็จรูป' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="product_id" type="hidden" id="product_id" value="{{ isset($issuestock->product_id) ? $issuestock->product_id : ''}}" >
            <div class="col-lg-3  input-group input-group-sm ">
                <div class="input-group-prepend">
                    <span class="input-group-text" name="product_code" id="product_code">
                    {{ isset($issuestock->product_id) ? $issuestock->product->product_code : ''}}
                    </span>
                </div>
                <input class="form-control" name="product_name" id="product_name" readonly="" value="{{ isset($issuestock->product_id) ? $issuestock->product->product_name : ''}}">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#productFinalModal"  >
                    <i class="fa fa-plus"></i> เลือกสินค้า
                    </button>
                </div>
            </div>            
            @include('issue-stock/create_detail_final_modal')

            <label for="amount" class="col-lg-3 control-label">{{ 'จำนวน' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="amount" type="text" id="amount" value="{{ isset($issuestock->amount) ? $issuestock->amount : '1'}}" min="1">
            
            
        </div>
        <div class="form-row form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="user_id" type="hidden" id="user_id" value="{{ isset($issuestock->user_id) ? $issuestock->user_id : Auth::id() }}" >
            <input class="col-lg-3 form-control form-control-sm" type="text" value="{{ isset($issuestock->user_id) ? $issuestock->user->name : Auth::user()->name }}" readonly>
        
        
            <label for="status_id" class="col-lg-3 control-label">{{ 'สถานะ' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="status_id" type="hidden" id="status_id" value="{{ isset($issuestock->status_id) ? $issuestock->status_id : ''}}" >
        </div>
        <div class="form-row form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            
            <label for="remark" class="col-lg-3 control-label">{{ 'หมายเหตุ' }}</label>
            <textarea class="col-lg-3 form-control form-control-sm" rows="2" name="remark" type="textarea" id="remark" >{{ isset($issuestock->remark) ? $issuestock->remark : ''}}</textarea>
        </div>
        <div class="form-row form-group {{ $errors->has('total') ? 'has-error' : ''}} d-none">
            <label for="total" class="col-lg-3 control-label">{{ 'ต้นทุน' }}</label>
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

<!-- 
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div> -->



<!-- START DISABLE WHEN SHOW -->
@if(isset($mode))
    @if( $mode == "edit" )
    <div class="form-group text-center mt-2">
        <input class="btn btn-success" id="form-submit" type="submit" value="Save">
    </div>
    @elseif( $mode == "show" )
    <script>
      setTimeout(function(){ 
          let elements = document.querySelectorAll("input, button.btn-success, select");
          // console.log("want to approved", elements);
          for(var item of elements){
            item.setAttribute("disabled","");
          };

        }, 500);
        
    </script>
    @endif
@else 
    <div class="form-group text-center mt-2">
        <input class="btn btn-success" id="form-submit" type="submit" value="Save">
    </div> 
@endif
