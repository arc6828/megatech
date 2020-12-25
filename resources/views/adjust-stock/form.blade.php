<div class="card mb-4">
    <div class="card-body text-center pr-5">        
        <div class="form-row form-group {{ $errors->has('code') ? 'has-error' : ''}}">
            <label for="code" class="col-lg-3 control-label">{{ 'เลขที่เอกสาร' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($adjuststock->code) ? $adjuststock->code : ''}}" readonly>
            

            <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
            <input class="col-lg-3 form-control form-control-sm"  value="{{ isset($issuestock->created_at) ? $issuestock->created_at : ''}}"  readonly>
        </div>
        <div class="form-row form-group {{ $errors->has('reference') ? 'has-error' : ''}}">
            <label for="reference" class="col-lg-3 control-label">{{ 'เอกสารอ้างอิง' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="reference" type="text" id="reference" value="{{ isset($adjuststock->reference) ? $adjuststock->reference : ''}}" >
            
        
            <label for="adjust_type" class="col-lg-3 control-label">{{ 'ชนิดการปรับปรุง' }}</label>
            <select name="adjust_type" id="adjust_type" class="col-lg-3 form-control form-control-sm" >
                <option value="-1">ปรับลด</option>
                <option value="1">ปรับเพิ่ม</option>
            </select>
            <script>
                document.querySelector("#adjust_type").value="{{ isset($adjuststock->adjust_type) ? $adjuststock->adjust_type : -1}}" ;
            </script>
            
        </div>
        <div class="form-row form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
            <label for="adjust_definition_id" class="col-lg-3 control-label">{{ 'รหัสการปรับปรุง' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="adjust_definition_id" type="number" id="adjust_definition_id" value="{{ isset($adjuststock->adjust_definition_id) ? $adjuststock->adjust_definition_id : ''}}" readonly>
            

            <label for="status_id" class="col-lg-3 control-label">{{ 'สถานะ' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="status_id" type="hidden" id="status_id" value="{{ isset($adjuststock->status_id) ? $adjuststock->status_id : ''}}" >
          
        </div>
        <div class="form-row form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="user_id" type="hidden" id="user_id" value="{{ isset($adjuststock->user_id) ? $adjuststock->user_id : Auth::id()  }}" >
            <input class="col-lg-3 form-control form-control-sm" type="text" value="{{ isset($adjuststock->user_id) ? $adjuststock->user->name : Auth::user()->name }}" readonly>
             
        
            <label for="remark" class="col-lg-3 control-label">{{ 'หมายเหตุ' }}</label>
            <textarea class="col-lg-3 form-control form-control-sm" rows="2" name="remark" type="textarea" id="remark" >{{ isset($adjuststock->remark) ? $adjuststock->remark : ''}}</textarea>
            
        </div>
        <!-- <div class="form-row form-group {{ $errors->has('total') ? 'has-error' : ''}}">
            <label for="total" class="col-lg-3 control-label">{{ 'Total' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="total" type="number" id="total" value="{{ isset($adjuststock->total) ? $adjuststock->total : ''}}" >
            {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-row form-group {{ $errors->has('revision') ? 'has-error' : ''}}">
            <label for="revision" class="col-lg-3 control-label">{{ 'Revision' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="revision" type="number" id="revision" value="{{ isset($adjuststock->revision) ? $adjuststock->revision : ''}}" >
            {!! $errors->first('revision', '<p class="help-block">:message</p>') !!}
        </div> -->


        <!-- <div class="form-row form-group">
            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
        </div> -->
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        @include('adjust-stock/detail')
        <div class="text-center pt-4">
        @include('adjust-stock/create_detail_modal')
        </div>
    </div>
</div>


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
