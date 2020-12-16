<div class="card mb-4">
    <div class="card-body">      
        <!-- <h3>Billing Information</h3> -->
        <div class="form-row form-group text-center pr-5">
            <label for="doc_no" class="col-lg-3 control-label">{{ 'เลขที่เอกสาร' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="doc_no" type="text" id="doc_no" value="{{ isset($customerbilling->doc_no) ? $customerbilling->doc_no : ''}}" >
            
            <label for="code" class="col-lg-3 control-label">{{ 'วันที่' }}</label>
            <input class="col-lg-3 form-control form-control-sm"  value="{{ isset($customerbilling->created_at) ? $customerbilling->created_at : ''}}"  readonly>
        </div>
        @php
            $customer_id = $customer ? $customer->customer_id : '';
            $customer_code = $customer ? $customer->customer_code : '';
            $customer_name = $customer ? $customer->company_name : '';
            $condition_billing = $customer ? $customer->billing_duration : '';
            $condition_cheque = $customer ? $customer->cheque_condition : '';
            $date_billing = $customer ? $customer->date_billing : '';
            $date_cheque = $customer ? $customer->date_cheque : '';
        @endphp
        <div class="form-row form-group text-center pr-5">
            <label for="customer_id" class="col-lg-3 control-label">{{ 'รหัสลูกค้า' }}</label> 
            <input class="form-control form-control-sm" name="customer_id" type="hidden" id="customer_id" value="{{ isset($customerbilling->customer_id) ? $customerbilling->customer_id : $customer_id }}" >
            @include('customer-billing/customer_modal')        
            
            <div class="col-lg-3  input-group input-group-sm ">
                <div class="input-group-prepend">
                    <span class="input-group-text" name="customer_code" id="customer_code"> {{ $customer_code }} </span>
                </div>
                <input class="form-control form-control-sm"  value="{{ isset($customerbilling->customer_id) ? $customerbilling->customer_id : $customer_name  }}" disabled>        
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#customerModal" >
                    <i class="fa fa-plus"></i> เลือก
                    </button>
                </div>
            </div>        

            
           
        </div>

        <div class="form-row form-group text-center pr-5">
            <label for="user_id" class="col-lg-3  control-label">{{ 'พนักงานขาย' }}</label>
            <small class="col-lg-3 text-left ">
                {{ isset($customer) ? $customer->user->name : '' }}
            </small>
            

            <label for="user_id" class="col-lg-3  control-label">{{ 'พนักงานผู้บันทึก' }}</label>
            <input class="form-control form-control-sm" name="user_id" type="hidden" id="user_id" value="{{ isset($customerbilling->user_id) ? $customerbilling->user_id : Auth::id() }}"  readonly>

            <input class="col-lg-3  form-control form-control-sm" value="{{ isset($customerbilling->user_id) ? $customerbilling->user_id : Auth::user()->name }}" disabled >
    


        </div>

        
        <hr>

        <!-- <h3>ข้อมูลวางบิล</h3> -->
        <div class="form-row form-group text-center pr-5">
            <label class="col-lg-3">สถานะการวางบิล<span class="text-red">*</span></label>
            <select name="status" id="status" class="col-lg-3 form-control form-control-sm  ">
                <option value="ready">รอวางบิล</option>
                <option value="wait-for-cheque" >รอรับเช็ค-โอน</option>
                <option value="delay">เลื่อน</option>
            </select>

            <label for="date_billing" class="col-lg-3 control-label">{{ 'วันที่ไปวางบิล' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="date_billing" type="date" id="date_billing" value="{{ isset($customerbilling->date_billing) ? $customerbilling->date_billing : ''}}" >

            <div class="form-group col-lg-3 d-none {{ $errors->has('condition_billing') ? 'has-error' : ''}}">
                <label for="condition_billing" class="control-label">{{ 'เงื่อนไขการวางบิล' }}</label>
                <input class="form-control form-control-sm" name="condition_billing" type="text" id="condition_billing" value="{{ isset($customerbilling->condition_billing) ? $customerbilling->condition_billing : $condition_billing}}" >
                {!! $errors->first('condition_billing', '<p class="help-block">:message</p>') !!}
            </div>
            
            
        </div>
        @if($customer)
            <div class="px-5" >
                @include('customer-billing/form-customer-billing')
            </div>
        @endif
        <hr>
        <!-- <h2>กำหนดการจ่ายชำระหนี้</h2> -->
        <div class="form-row form-group text-center pr-5">
            <label for="condition_cheque" class="col-lg-3 control-label">{{ 'เงื่อนไขรับเช็ค' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="condition_cheque" type="text" id="condition_cheque" value="{{ isset($customerbilling->condition_cheque) ? $customerbilling->condition_cheque : $condition_cheque}}" >
                
            <label for="date_cheque" class="col-lg-3 control-label">{{ 'วันนัดรับเช็ค' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="date_cheque" type="date" id="date_cheque" value="{{ isset($customerbilling->date_cheque) ? $customerbilling->date_cheque : ''}}" >
            
        </div>
        @if($customer)
            <div class="px-5" >
                @include('customer-billing/form-customer-cheque')
            </div>
        @endif
    </div>
</div>

@include('customer-billing/detail')

<div class="card my-4">
    <div class="card-body">  
        <div class="form-group form-row text-center pr-5">
            <label for="remark" class="col-lg-3  control-label">{{ 'หมายเหตุ' }}</label>
            <textarea class="col-lg-3  form-control form-control-sm" rows="2" name="remark" type="textarea" id="remark" >{{ isset($customerbilling->remark) ? $customerbilling->remark : ''}}</textarea>
            
            
        </div>

    </div>
</div>


<div class="form-group form-group text-center pr-5">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
