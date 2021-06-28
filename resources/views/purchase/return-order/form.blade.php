<div class="card mb-4">
    <div class="card-body">
        @if (isset($returnorder))
            <div class="form-row form-group form-group my-4">
                <div class="col-lg-4  text-left pl-5">
                    <a href="{{ url('/purchase/return-order') }}" title="Back" class="btn btn-warning btn-sm d-none">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </a>
                </div>
                <div class="col-lg-4">
                    @if (isset($mode))
                        <div class="text-center"><img
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($returnorder->code, 'C128') }}"
                                alt="barcode" /></div>
                        <div class="text-center">{{ $returnorder->code }}</div>
                    @endif
                </div>
                <div class="col-lg-4  text-right">
                    @if (isset($mode))
                        @if ($mode == 'show')
                            @if ($returnorder->purchase_status_id != -1)
                                <a class="btn btn-sm btn-warning btn-print mr-2"
                                    href="{{ url('/') }}/purchase/return-order/{{ $returnorder->id }}/edit"
                                    title="พิมพ์">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                            @endif
                        @elseif($mode=="edit")
                            @if (isset($returnorder->purchase_status_id))
                                @if ($returnorder->purchase_status_id == 5)
                                    <a class="px-2 btn btn-sm btn-success" href="javascript:void(0)"
                                        onclick="approved()">
                                        <i class="fas fa-check"></i> อนุมัติ
                                    </a>
                                @endif
                                @if ($returnorder->purchase_status_id > 0)
                                    <a href="javascript:void(0)"
                                        onclick="document.querySelector('#form-cancel-submit').click(); "
                                        class="px-2 btn btn-sm btn-danger">
                                        <span class="fa fa-trash"> ยกเลิก RO</span>
                                    </a>
                                @endif
                            @endif

                        @endif

                        <a class="btn btn-primary btn-sm btn-print mr-2"
                            href="{{ url('/') }}/purchase/return-order/{{ $returnorder->id }}/pdf"
                            target="_blank" title="พิมพ์">
                            <i class="fas fa-print"></i> พิมพ์
                        </a>
                    @endif


                </div>

            </div>
        @endif
        <div class="text-center pr-5">
            <div class="form-row form-group form-group ">
                <label for="code" class="col-lg-3 control-label">{{ 'รหัสเอกสาร' }}</label>
                <input class="col-lg-3 form-control form-control-sm" name="code" type="text" id="code"
                    value="{{ isset($returnorder->code) ? $returnorder->code : '' }}" readonly>
                <label for="supplier_id" class="col-lg-3 control-label">{{ 'รหัสเจ้าหนี้' }}</label>
                <input class="col-lg-3 form-control form-control-sm d-none" name="supplier_id" type="number"
                    id="supplier_id" value="{{ isset($returnorder->supplier_id) ? $returnorder->supplier_id : '' }}">
                <input class="form-control form-control-sm   col-lg-3" type="text"
                    value="{{ isset($returnorder->supplier_id) ? $returnorder->supplier->supplier_code : '' }}"
                    readonly>

            </div>
            <div class="form-row form-group form-group ">
                <label for="supplier_id" class="col-lg-3 control-label">{{ 'วันที่เวลา' }}</label>
                <input class="col-lg-3 form-control form-control-sm" name="" type="" id=""
                    value="{{ isset($returnorder->created_at) ? $returnorder->created_at : '' }}" readonly>
                <label for="purchase_receive_code" class="col-lg-3 control-label">{{ 'รหัสเอกสาร RC' }}</label>
                <input class="col-lg-3 form-control form-control-sm" name="purchase_receive_code" type="text"
                    id="purchase_receive_code"
                    value="{{ isset($returnorder->purchase_receive_code) ? $returnorder->purchase_receive_code : '' }}">

            </div>
            <div class="form-row form-group">

                <label for="tax_type_id" class="col-lg-3 control-label">{{ 'ชนิดภาษี' }}</label>
                <input class="col-lg-3 form-control form-control-sm" name="tax_type_id" type="hidden" id="tax_type_id"
                    value="{{ isset($returnorder->tax_type_id) ? $returnorder->tax_type_id : '' }}">
                <input class="form-control form-control-sm   col-lg-3" type="text"
                    value="{{ isset($returnorder->tax_type_id) ? $returnorder->tax_type->tax_type_name : '' }}"
                    readonly>

                <label for="purchase_status_id" class="col-lg-3 control-label">{{ 'สถานะ' }}</label>
                <input class="col-lg-3 form-control form-control-sm" name="purchase_status_id" type="hidden"
                    id="purchase_status_id"
                    value="{{ isset($returnorder->purchase_status_id) ? $returnorder->purchase_status_id : '' }}">
                <div class="col-lg-3">
                    @if (isset($returnorder->purchase_status_id))
                        @switch($returnorder->purchase_status_id)
                            @case(-1)
                                <span class="badge badge-pill badge-secondary">{{$returnorder->purchase_status->purchase_status_name}}</span>
                            @break
                             @case(5)
                                <span class="badge badge-pill badge-primary">{{$returnorder->purchase_status->purchase_status_name}}</span>
                            @break
                               @case(14)
                                <span class="badge badge-pill badge-success">{{$returnorder->purchase_status->purchase_status_name}}</span>
                            @break
                            @default
                                <span class="badge badge-pill badge-success d-none">Yes</span>
                            @break
                        @endswitch

                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <label for="user_id" class="col-lg-3 control-label">{{ 'พนักงานผู้บันทึก' }}</label>
                    <input class="col-lg-3 form-control form-control-sm" name="user_id" type="hidden" id="user_id"
                        value="{{ isset($returnorder->user_id) ? $returnorder->user_id : '' }}">
                    <input class="form-control form-control-sm   col-lg-3" type="text"
                        value="{{ isset($returnorder->user_id) ? $returnorder->user->name : '' }}" readonly>


                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            @include('purchase/return-order/detail')
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="form-row form-group">
                <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }} col-lg-6">
                    <label for="remark" class="control-label">{{ 'หมายเหตุ' }}</label>
                    <textarea class="form-control form-control-sm" rows="5" name="remark" type="textarea"
                        id="remark">{{ isset($returnorder->remark) ? $returnorder->remark : '' }}</textarea>
                    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-lg-1">
                    <input type="hidden" name="temp_total" value="0" />
                </div>
                <div class="col-lg-5">
                    <div
                        class="form-group {{ $errors->has('total_before_vat') ? 'has-error' : '' }} form-row form-group">
                        <label for="total_before_vat" class="control-label col-lg-6">{{ 'ยอดรวมก่อนภาษี' }}</label>
                        <input class="form-control form-control-sm col-lg-6" name="total_before_vat" type="number"
                            id="total_before_vat"
                            value="{{ isset($returnorder->total_before_vat) ? $returnorder->total_before_vat : '' }}"
                            readonly>
                        {!! $errors->first('total_before_vat', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }} form-row form-group">
                        <label for="vat" class="control-label col-lg-3">{{ 'ภาษีมูลค่าเพิ่ม' }}</label>
                        <input class="form-control form-control-sm col-lg-2" name="vat_percent" type="number"
                            id="vat_percent"
                            value="{{ isset($returnorder->vat_percent) ? $returnorder->vat_percent : '' }}" readonly>
                        <!-- {!! $errors->first('vat', '<p class="help-block">:message</p>') !!} -->
                        <label for="vat_percent" class="control-label col-lg-1">{{ '%' }}</label>
                        <input class="form-control form-control-sm col-lg-6" name="vat" type="number" id="vat"
                            value="{{ isset($returnorder->vat) ? $returnorder->vat : '' }}" readonly>
                        <!-- {!! $errors->first('vat_percent', '<p class="help-block">:message</p>') !!} -->
                    </div>
                    <div class="form-group {{ $errors->has('total_after_vat') ? 'has-error' : '' }} form-row form-group">
                        <label for="total_after_vat" class="control-label col-lg-6">{{ 'ยอดรวมหลังภาษี' }}</label>
                        <input class="form-control form-control-sm col-lg-6" name="total_after_vat" type="number"
                            id="total_after_vat"
                            value="{{ isset($returnorder->total_after_vat) ? $returnorder->total_after_vat : '' }}"
                            readonly>
                        <!-- {!! $errors->first('total_after_vat', '<p class="help-block">:message</p>') !!} -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="form-group text-center">
                        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
                    </div> -->


    @if (isset($mode))
        @if ($mode == 'edit')
            <div class="form-group text-center">
                <input class="btn btn-success" type="submit" value="Save">
            </div>
        @elseif( $mode == "show" )
            <script>
                let elements = document.querySelectorAll("input, button.btn-success");
                // console.log("want to approved", elements);
                for (var item of elements) {
                    item.setAttribute("disabled", "");
                };
            </script>
        @endif
    @else
        <div class="form-group text-center">
            <input class="btn btn-success" type="submit" value="Save">
        </div>
    @endif

    <script>
        function refreshTotal() {
            var total = 0;
            document.querySelectorAll("input[name='totals[]']").forEach(function(element, index) {
                total += parseFloat(element.value);
            }); //END foreach\
            console.log("Total : " + total);
            document.querySelector("input[name='temp_total']").value = total;
        }

        function onChange() {
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
                    total_before_vat.value = total.value - vat.value * 1;
                    total_after_vat.value = total.value;
                    break;
                case "2":
                    //EFFECT TO #vat_percent
                    //console.log("CASE 2");
                    total_before_vat.value = total.value;
                    total_after_vat.value = total.value * 1 + vat.value * 1;
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

        function approved() {

            let elements = document.querySelector("#form-approve").children;

            console.log("want to approved", elements);
            for (var item of elements) {
                item.removeAttribute("disabled");
            };

            document.querySelector("#form-approve-submit").click();

        }
    </script>
