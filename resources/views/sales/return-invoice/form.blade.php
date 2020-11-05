<div class="card mb-4">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-lg-3">
                <a href="{{ url('/sales/return-invoice') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>                        
            </div>
        </div>
        <div class="form-row">
            <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}} col-lg-3">
                <label for="code" class="control-label">{{ 'รหัสเอกสาร' }}</label>
                <input class="form-control form-control-sm" name="code" type="text" id="code" value="{{ isset($returninvoice->code) ? $returninvoice->code : ''}}" readonly>
                {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}} col-lg-6 ">
                <label for="customer_id" class="control-label">{{ 'รหัสลูกหนี้' }}</label>
                <input class="form-control form-control-sm" name="customer_id" type="number" id="customer_id" value="{{ isset($returninvoice->customer_id) ? $returninvoice->customer_id : ''}}" >
                {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
            </div>    
            <div class="form-group {{ $errors->has('created_at') ? 'has-error' : ''}} col-lg-3 ">
                <label for="customer_id" class="control-label">{{ 'วันที่เวลา' }}</label>
                <input class="form-control form-control-sm" name="" type="" id="" value="{{ isset($returninvoice->created_at) ? $returninvoice->created_at : ''}}" readonly>
                {!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-row">

            <div class="form-group {{ $errors->has('invoice_code') ? 'has-error' : ''}} col-lg-3 ">
                <label for="invoice_code" class="control-label">{{ 'รหัสเอกสาร Invoice' }}</label>
                <input class="form-control form-control-sm" name="invoice_code" type="text" id="invoice_code" value="{{ isset($returninvoice->invoice_code) ? $returninvoice->invoice_code : ''}}" >
                {!! $errors->first('invoice_code', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('tax_type_id') ? 'has-error' : ''}} col-lg-3 ">
                <label for="tax_type_id" class="control-label">{{ 'ชนิดภาษี' }}</label>
                <input class="form-control form-control-sm" name="tax_type_id" type="number" id="tax_type_id" value="{{ isset($returninvoice->tax_type_id) ? $returninvoice->tax_type_id : ''}}" >
                {!! $errors->first('tax_type_id', '<p class="help-block">:message</p>') !!}
            </div>
            
            <div class="form-group {{ $errors->has('sales_status_id') ? 'has-error' : ''}} col-lg-3 ">
                <label for="sales_status_id" class="control-label">{{ 'สถานะ' }}</label>
                <input class="form-control form-control-sm" name="sales_status_id" type="number" id="sales_status_id" value="{{ isset($returninvoice->sales_status_id) ? $returninvoice->sales_status_id : ''}}" >
                {!! $errors->first('sales_status_id', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}} col-lg-3 ">
                <label for="user_id" class="control-label">{{ 'พนักงาน' }}</label>
                <input class="form-control form-control-sm" name="user_id" type="number" id="user_id" value="{{ isset($returninvoice->user_id) ? $returninvoice->user_id : ''}}" >        
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>

            
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        @include('sales/return-invoice/detail')
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}} col-lg-6">
                <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
                <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea" id="remark" >{{ isset($returninvoice->remark) ? $returninvoice->remark : ''}}</textarea>
                {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-lg-1">                
                <input type="hidden"  name="temp_total" value="0"  />
            </div>
            <div class="col-lg-5">
                <div class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : ''}} form-row">
                    <label for="total_before_vat" class="control-label col-lg-6">{{ 'ยอดรวมก่อนภาษี' }}</label>
                    <input class="form-control form-control-sm col-lg-6" name="total_before_vat" type="number" id="total_before_vat" value="{{ isset($returninvoice->total_before_vat) ? $returninvoice->total_before_vat : ''}}" readonly>
                    {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('vat') ? 'has-error' : ''}} form-row">
                    <label for="vat" class="control-label col-lg-3">{{ 'ภาษีมูลค่าเพิ่ม' }}</label>
                    <input class="form-control form-control-sm col-lg-2" name="vat_percent" type="number" id="vat_percent" value="{{ isset($returninvoice->vat_percent) ? $returninvoice->vat_percent : ''}}" readonly>
                    <!-- {!! $errors->first('vat', '<p class="help-block">:message</p>') !!} -->
                    <label for="vat_percent" class="control-label col-lg-1">{{ '%' }}</label>
                    <input class="form-control form-control-sm col-lg-6" name="vat" type="number" id="vat" value="{{ isset($returninvoice->vat) ? $returninvoice->vat : ''}}" readonly >
                    <!-- {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!} -->
                </div>
                <div class="form-group {{ $errors->has('total_after_vat') ? 'has-error' : ''}} form-row" >
                    <label for="total_after_vat" class="control-label col-lg-6">{{ 'ยอดรวมหลังภาษี' }}</label>
                    <input class="form-control form-control-sm col-lg-6" name="total_after_vat" type="number" id="total_after_vat" value="{{ isset($returninvoice->total_after_vat) ? $returninvoice->total_after_vat : ''}}" readonly>
                    <!-- {!! $errors->first('total_after_vat', '<p class="help-block">:message</p>') !!} -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group text-center">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

<script>
function refreshTotal(){
    var total = 0;
    document.querySelectorAll("input[name='totals[]']").forEach(function(element,index){
        total += parseFloat(element.value);
    }); //END foreach\
    console.log("Total : " + total);
    document.querySelector("input[name='temp_total']").value = total;
}

function onChange(){
    //RECALCULATE TOTAL FIRST
    refreshTotal();
    //MAIN
        var vat = document.querySelector("input[name='vat']");
        var vat_percent = document.querySelector("input[name='vat_percent']");
        var total = document.querySelector("input[name='temp_total']");
        var total_before_vat = document.querySelector("input[name='total_before_vat']");
        var total_after_vat = document.querySelector("input[name='total_after_vat']");;
        var tax_type_id = document.querySelector("input[name='tax_type_id']");;
        //console.log("print",vat,vat_percent,total_before_vat);

        //SET VAT
        vat.value = Number(total.value) * Number(vat_percent.value) / 100;

        //DISPLAY ON TOTAL
        vat_percent.disabled = false;
        vat_percent.readonly = false;
        switch (tax_type_id.value) {
            case "1":
                //EFFECT TO #vat
                //console.log("CASE 1");
                total_before_vat.value = total.value -  vat.value*1;
                total_after_vat.value = total.value ;
                break;
            case "2":
                //EFFECT TO #vat_percent
                //console.log("CASE 2");
                total_before_vat.value = total.value;
                total_after_vat.value = total.value*1 + vat.value*1;
                break;
            default:
                vat_percent.disabled = true;
                vat_percent.readonly = true;
                vat_percent.value = 0;
                vat.value = 0;
                //console.log("CASE OTHERS");
                total_before_vat.value = total.value;
                total_after_vat.value = total.value;
                break;
        }

    total.value = parseFloat(total.value).toFixed(2);
    total_before_vat.value = parseFloat(total_before_vat.value).toFixed(2);
    total_after_vat.value = parseFloat(total_after_vat.value).toFixed(2);
    vat.value = parseFloat(vat.value).toFixed(2);
    //roundnum
    // document.querySelectorAll(".roundnum").forEach(function(element) {
    //     //console.log(element);
    //     //element.value = parseFloat(element.value).toFixed(2)
    // });



}
</script>