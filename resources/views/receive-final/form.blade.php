<div class="card mb-4">
    <div class="card-body text-center pr-5">
        <div class="form-row form-group">
            <label for="code" class="col-lg-3 control-label">{{ 'รหัสเอกสาร' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($receivefinal->code) ? $receivefinal->code : ''}}" readonly>
            {!! $errors->first('code', '<p class="help-block">:message</p>') !!}

            <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
            <input class="col-lg-3 form-control form-control-sm form-control form-control-sm-sm"  value="{{ isset($issuestock->created_at) ? $issuestock->created_at : ''}}"  readonly>
        </div>
        <div class="form-row form-group {{ $errors->has('is_code') ? 'has-error' : ''}}">
            <label for="is_code" class="col-lg-3 control-label">{{ 'รหัสเบิกสินค้าไปผลิต' }}</label>
            <div class="col-lg-3  input-group input-group-sm ">                
                <input class="form-control form-control-sm" name="is_code" type="text" id="is_code" value="{{ isset($receivefinal->is_code) ? $receivefinal->is_code : ''}}" readonly>
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#issueStockModal"  >
                    <i class="fa fa-plus"></i> เลือกเอกสาร
                    </button>
                </div>
            </div>       
            @if(!isset($mode))
            @include('receive-final/create_issue_stock_modal')
            @endif
        
            <label for="status_id" class="col-lg-3 control-label">{{ 'สถานะ' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="status_id" type="hidden" id="status_id" value="{{ isset($receivefinal->status_id) ? $receivefinal->status_id : ''}}" >
            <div class="col-lg-3 ">
            @if(isset($receivefinal->status_id))
                @switch($receivefinal->status_id)
                    @case("-1")
                        <span class="badge badge-pill badge-secondary">Void</span>
                        @break
                    @default
                        <span class="badge badge-pill badge-success">รับสินค้าสำเร็จรูป</span>								
                        @break
                @endswitch
            @endif
            </div>
        </div>
        <div class="form-row form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="user_id" type="hidden" id="user_id" value="{{ isset($issuestock->user_id) ? $issuestock->user_id : Auth::id() }}" >
            <input class="col-lg-3 form-control form-control-sm" type="text" value="{{ isset($issuestock->user_id) ? $issuestock->user->name : Auth::user()->name }}" readonly>
        
            <label for="remark" class="col-lg-3 control-label">{{ 'หมายเหตุ' }}</label>
            <textarea class="col-lg-3 form-control form-control-sm" rows="2" name="remark" type="textarea" id="remark" >{{ isset($receivefinal->remark) ? $receivefinal->remark : ''}}</textarea>
            {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-row form-group d-none">
            <label for="total" class="col-lg-3 control-label">{{ 'Total' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($receivefinal->total) ? $receivefinal->total : ''}}" >
            {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
        
            <label for="revision" class="col-lg-3 control-label">{{ 'Revision' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="revision" type="number" id="revision" value="{{ isset($receivefinal->revision) ? $receivefinal->revision : ''}}" >
            {!! $errors->first('revision', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        @include('receive-final/detail')
        <div class="text-center pt-4">
        </div>
    </div>
</div>

<!-- <div class="form-group">
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
