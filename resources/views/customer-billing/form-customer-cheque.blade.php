
@php
$checklist = $customer->checklist;
@endphp
<div class="accordion" id="accordionExample2">
  <div class="card bg-light">
    <div class="card-header py-1" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <!-- Collapsible Group Item #1 --> <i class="fa fa-plus"></i> รายละเอียดรับเช็ค
        </button>
      </h2>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample2">
      <div class="card-body pt-1 pb-2">
        <!-- Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. -->
        <div class="card  mt-4 bg-yellow">
          <div class="card-body">
            <!-- <h2>รับเช็ค</h2> -->
            <div class="row">            
              <div class="form-group col-lg-3">
                <label  >เงื่อนไขรับเช็ค </label>
                <input name="cheqe_condition"  id="cheqe_condition"  class="form-control form-control-sm  "  >
              </div>
              <div class="form-group col-lg-6">
                <label >หมายเหตุการรับเช็ค</label>
                <input name="remark_cheque" id="remark_cheque" class="form-control form-control-sm  "  >
              </div>
            </div>
            <div class="row">      
              <div class="form-group col-lg-3 {{ $errors->has('billing_invoice') ? 'has-error' : ''}}">
                  <label for="cheque_billing" class="control-label">
                    <input type="checkbox" {{ $checklist->cheque_billing === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_billing').value = this.checked"> 
                    {{ 'เอกสารวางบิล' }}
                  </label>
                  <input class="form-control form-control-sm checklist" name="cheque_billing" type="text" id="cheque_billing" value="{{ isset($checklist->cheque_billing) ? $checklist->cheque_billing : ''}}" >
                  {!! $errors->first('cheque_billing', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group col-lg-3 {{ $errors->has('cheque_receipt') ? 'has-error' : ''}}">
                  <label for="cheque_receipt" class="control-label">
                    <input type="checkbox" {{ $checklist->cheque_receipt === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_receipt').value = this.checked"> 
                    {{ 'ใบเสร็จรับเงิน' }}
                  </label>
                  <input class="form-control form-control-sm checklist" name="cheque_receipt" type="text" id="cheque_receipt" value="{{ isset($checklist->cheque_receipt) ? $checklist->cheque_receipt : ''}}" >
                  {!! $errors->first('cheque_receipt', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group col-lg-3 {{ $errors->has('cheque_po') ? 'has-error' : ''}}">
                  <label for="cheque_po" class="control-label">
                    <input type="checkbox" {{ $checklist->cheque_po === "true" ? 'checked' : ''}} onclick="document.querySelector('#cheque_po').value = this.checked"> 
                    {{ 'P/O' }}
                  </label>
                  <input class="form-control form-control-sm checklist" name="cheque_po" type="text" id="cheque_po" value="{{ isset($checklist->cheque_po) ? $checklist->cheque_po : ''}}" >
                  {!! $errors->first('cheque_po', '<p class="help-block">:message</p>') !!}
              </div>
              
              
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   
   
</div>


