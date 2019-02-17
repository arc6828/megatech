@extends('monster-lite/layouts/theme')

@section('title','ลดหนี้')

@section('breadcrumb-menu')

@endsection

@section('content')

<form action="#" method="POST" id="form-reduce">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">เลขที่เอกสาร</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <input type="text" name=""  class="form-control form-control-line"  >
                        </div>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">วันที่</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <input type="date" name=""  class="form-control form-control-line"  >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">รหัสเจ้าหนี้</label>
                        <div class="col col-sm-5 col-md-5 col-lg-5 col-xl-5">
                            <input type="text" name=""  class="form-control form-control-line"  >
                        </div>
                        @include('finance/billing_note/modal-customer')
                    </div>
                </div>
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">เลขที่ใบกำกับภาษี</label>
                            <div class="col col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                <input type="text" name=""  class="form-control form-control-line"  >
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">อ้างอิงเอกสาร</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <input type="text" name=""  class="form-control form-control-line"  >
                        </div>
                        {{-- Modal ???? --}}
                    </div>
                </div>
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">ลดหนี้โดย</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <select type="date" name=""  class="form-control form-control-line"  >
                                <option value="">หักยอดหนี้ IV,AR</option>
                                <option value="">จ่ายเป็นเงินสด</option>
                                <option value="">ตัดกับรับชำนะหนี้</option>
                                <option value="">จ่ายเป็นเช็ค</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">ชนิดภาษี</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <select type="date" name=""  class="form-control form-control-line"  >
                                    @foreach ($table_tax_type as $row)
                                        <option value="{{ $row->tax_type_id }}">{{ $row->tax_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group form-inline">
                                <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">รหัสพนักงาน</label>
                                <div class="col col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                    <input type="text" name=""  class="form-control form-control-line"  >
                                </div>
                                @include('customer/modal-user')
                            </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">รหัสแผนก</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <input type="text" name=""  class="form-control form-control-line"  >
                            </div>
                            {{-- Modal --}}
                        </div>
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">รหัส JOB#</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <input type="text" name=""  class="form-control form-control-line"   >
                            </div>
                            {{-- Modal --}}
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">เขตการขาย</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <select name=""  class="form-control form-control-line"  >
                                         @foreach ($table_zone as $row_zone)
                                            <option value="{{ $row_zone->zone_id }}">{{ $row_zone->zone_name }}</option>
                                         @endforeach
                                    </select>
                            </div>
                            {{-- Modal ???? --}}
                        </div>
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">ภาระภาษี</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <select name=""  class="form-control form-control-line"  >
                                    <option value="">เกณฑ์สิทธิ์</option>
                                    <option value="">เกณฑ์เงินสด</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-inline">
                                    <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">มูลค่าฐานภาษี</label>
                                    <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <input type="text" name=""  class="form-control form-control-line"  >
                                    </div>
                                    {{-- Modal --}}
                                </div>
                            </div>
                            <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group form-inline">
                                        <label class="col col-sm-5 col-md-4 col-lg-3 col-xl-3">ยื่นภาษีในงวด</label>
                                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                            <input type="text" name=""  class="form-control form-control-line"  >
                                        </div>
                                        {{-- Modal --}}
                                    </div>
                                </div>
                </div>
                <div class="row">
                        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-inline">
                                            <input type="checkbox" name=""  class="form-control form-control-line"  >
                                            <label class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">ภาษีมูลค่าเพิ่มยื่นเพิ่ม</label>
                                    {{-- Modal --}}
                                </div>
                        </div>
                        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-inline">
                                            <input type="checkbox" name=""  class="form-control form-control-line"  >
                                            <label class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">ภาษีไม่ขอคืน</label>
                                    {{-- Modal --}}
                                </div>
                        </div>
                        {{-- <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-inline">
                                    <input type="checkbox" class="form-controle form-control-line">
                                    <label class="col col-sm-8 col-md-8 col-lg-6 col-xl-6">ภาษีมูลค่าเพิ่มยื่นเพิ่ม</label>
                                </div>
                            </div> --}}
                </div>
            <div class="calculate bg-info">
                <div class="row" style="padding-top: 10px">
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                        <label class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 text-white">คำอธิบาย</label>
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                        <label class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 text-white">ยอดรวม</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="text" class="form-control form-control-line">
                </div>
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <input type="hidden" class="form-control form-control-line">
                    </div>
                 <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="text" class="form-control form-control-line">
                </div>
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="number" id="total" class="form-control form-control-line" onchange="changeTotal()">
                </div>
            </div>
            <hr style="border: 1px soild;background: black">
            <div class="row">
                <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">

                </div>
                <div class="col col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="row">
                    <div class="form-group form-inline">
                        <label class="col col-sm-1 col-md-1 col-lg-1 col-xl-1">ส่วนลด</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-4">
                            <input type="number" id="discount" class="form-control form-control-line" onchange="changeTotal()">
                        </div>
                    </div>
                    <div id="show-discount" class="col col-sm-2 col-md-2 col-lg-2 col-xl-2" ></div>
                    <div id="show-total" class="col col-sm-2 col-md-2 col-lg-2 col-xl-2" ></div>
                    <input type="hidden" id="value-total">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group form-inline">
                        <label class="col col-sm-5 col-md-5 col-lg-5 col-xl-5">อัตราภาษีมูลค่าเพิ่ม</label>
                        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-4">
                            <input type="number" id="tax" style="width: 70%" class="form-control form-control-line" value="7.00">
                        </div>
                    </div>
                </div>
                <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group form-inline">
                            <label class="col col-sm-5 col-md-5 col-lg-5 col-xl-5">มูลค่าภาษี</label>
                            <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-4">
                                <input type="number" id="tax_total" style="width: 70%" class="form-control form-control-line" value="7">
                            </div>
                        </div>
                </div>
            </div>


            <div class="check">
                ส่วนของเช็ค!!!
            </div>
        </div>
    </div>
</form>

<script>
    function changeTotal() {
    var tax = document.getElementById('tax');
    var discount = document.getElementById('discount').value;
    var show_disc = document.getElementById('show-discount');
    var total = document.getElementById('total').value;
    var show_total = document.getElementById('show-total');
    var value_total = document.getElementById('value-total');
    var tax_total = document.getElementById('tax_total');

    show_disc.innerHTML = discount;
    show_total.innerHTML = total - discount;
    value_total.value = total - discount; 
    tax_total.value = value_total.value*(tax.value/100);
    }
    function submitForm(){
	var form = document.getElementById('form-reduce');
	form.action = "{{ url('/') }}/finance/reduce";
	form.submit();
    }
</script>

@section('navbar-menu')
<div style="margin:21px;">
<a href="javascript:void(0)" onclick="submitForm()" class="btn btn-success">Save</a>
<a href="{{ url('/') }}/finance/reduce" class="btn btn-danger">Back</a>
</div>
@endsection

@endsection