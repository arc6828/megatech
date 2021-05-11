@extends('layouts/print')

@section('title', 'ใบวางบิล')

@section('content')

    <style>
        td,
        th {
            padding-left: 10px;
            padding-right: 10px;
        }

        table.no-padding-cell td,
        table.no-padding-cell th {
            padding-bottom: 0px;
            padding-top: 10px;
        }

        .inline {
            display: inline-block;
        }

        .company_name {
            font-size: xx-large;
            line-height: 0.7;
            font-weight: 700;
        }

        .sub_company_name {
            line-height: 0.8;
        }

    </style>

    @php
    $row = $customerbilling;
    @endphp
    <div>
        @foreach ($company as $company)
            <div class="inline" style="width:30%; text-align:center;">
                <div style="padding-right: 10px; padding-left: 10px;">
                    <img src="{{ url('/') }}/images/megatech-logo-small.jpg" style="width:100%">
                </div>
                <div> <strong>เลขประจำตัวผู้เสียภาษี</strong> {{ $company->number_tex }}</div>
            </div>
            <div class="inline" style="width:69%;">
                <div class="company_name">{{ $company->thname_company }}</div>
                <div class="company_name">{{ $company->enname_company }}</div>
                <div class="sub_company_name">{{ $company->address }}30</div>
                <div class="sub_company_name">
                    Tel: {{ $company->tal }}
                    Fax: {{ $company->fax }}
                    E-mail: {{ $company->email }}
                </div>
                <div class="sub_company_name">www.megatechcuttingtool.com</div>
        @endforeach
    </div>
    <div style="text-align:center;">
        <div class="inline" style="width:30%;  ">

        </div>
        <div class="inline" style="width:39%;   ">
            <div style="padding-left : 40px; padding-right:40px;">
                <table style="width:100%; text-align:center;">
                    <tr>
                        <td style="padding: 0px 10px;">
                            <div class="company_name" style="border:1px solid; padding: 10px 0px; ">@yield('title')</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="inline" style="width:30%;  ">
            <div class="">
                <table class="no-padding-cell" border="1" style="border-collapse: collapse; width:100%; text-align:center;">
                    <tr>
                        <th>เลขที่</th>
                        <td>{{ $row->doc_no }}</td>
                    </tr>
                    <tr>
                        <th>วันที่</th>
                        @php
                            $datetime_array = explode(' ', $row->created_at);
                            $date_array = explode('-', $datetime_array[0]);
                            $date = "{$date_array[2]}/{$date_array[1]}/{$date_array[0]}";
                        @endphp
                        <td>{{ $date }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="margin-top:10px;">
        <table border="1" style="border-collapse: collapse; width:100%;">
            <tr>
                <td>
                    <strong>ลูกค้า :</strong> {{ $row->customer->company_name }} <br>
                    <strong>ที่อยู่ :</strong> {{ $row->customer->address }} {{ $row->customer->address2 }} <br>
                    <strong>โทร :</strong> {{ $row->customer->telephone }}
                    <strong style="margin-left:100px;">แฟ๊กซ์ :</strong> {{ $row->customer->fax }}
                    <strong style="margin-left:100px;">รหัสลูกค้า :</strong> {{ $row->customer->customer_code }}
                    <strong style="margin-left:100px;">Sale :</strong> {{ $row->customer->user->short_name }} <br>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top:10px; display : none; ">
        <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
            <tr>
                <th>กำหนดยืนราคา</th>
                <th>วันที่ส่งของ</th>
                <th>ระยะเวลาหนี้</th>
                <th>พนักงานขาย</th>
            </tr>
            <tr>
                <td>30 วัน</td>
                <td>{{ $row->customer->delivery_time }} วัน</td>
                <td>{{ $row->customer->debt_duration }}</td>
                <td>{{ $row->user->name }}</td>
            </tr>
        </table>
    </div>
    <div style="margin-top:10px;">
        <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
            <thead>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">เลขที่เอกสาร</th>
                    <th class="text-center">วันที่</th>
                    <th class="text-center">เอกสารอ้างอิง</th>
                    <th class="text-center">ยอดรวม</th>
                </tr>
            </thead>
            @foreach ($row->customer_billing_details as $row_detail)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $row_detail->invoice->invoice_code }} </td>
                    <td>{{ $row_detail->invoice->datetime }}</td>
                    <td>{{ $row_detail->invoice->external_reference_id }}</td>
                    <td>{{ number_format($row_detail->invoice->total ? $row_detail->invoice->total : 0, 2) }}</td>

                </tr>
            @endforeach
            @for ($i = 0; $i < 10 - count($row->customer_billing_details); $i++)
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
            @endfor
            <tr>
                <td colspan="3" style="text-align:center;">
                    ({{ $total_text }})
                </td>
                <td colspan="1" style="text-align:right;">
                    <strong>รวมทั้งสิ้น</strong>
                </td>
                <td colspan="1" style="text-align:center;">
                    <strong>{{ number_format($row->total, 2) }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:left;">
                    <strong>หมายเหตุ</strong> {{ $row->remark != '' ? $row->remark : '-' }}
                </td>
            </tr>
        </table>
    </div>

    <div style="text-align:center; margin-top:100px;">
        <div class="inline" style="width:24%;">
            ___________________<br>
            ผู้รับวางบิล<br>
            วันที่ __/__/____
        </div>
        <div class="inline" style="width:24%;">
            ___________________<br>
            ผู้วางบิล<br>
            วันที่ __/__/____
        </div>
        <div class="inline" style="width:24%;">
            ___________________<br>
            วันที่นัดรับเช็ค / โอนเงิน<br>
            .
        </div>
        <div class="inline" style="width:24%;">
            ___________________<br>
            ผู้ตรวจสอบ<br>
            .
        </div>
    </div>

    <div class="" style="text-align : center; margin-top:30px;">
        <div class="">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->doc_no, 'C128') }}" alt="barcode" />
        </div>
        <div class="">
            {{ $row->doc_no }}
        </div>
    </div>
    @php
    $customer = $row->customer;
    @endphp


    @php
    $checklist = $customer->checklist;
    @endphp
    <div class="card  mt-4 bg-info">
        <div class="card-body">
            <h2>เครดิต</h2>
            <div class="row">

                <div class="form-group col-lg-3">
                    <label>วิธีการขาย </label> {{ isset($customer) ? $customer->payment_method : '' }}

                </div>
                <div class="form-group col-lg-3">
                    <label>วงเงินเครดิต</label> {{ isset($customer) ? $customer->max_credit : '' }}

                </div>
                <div class="form-group col-lg-3">
                    <label>ระยะเวลาหนี้</label> {{ isset($customer) ? $customer->debt_duration : '' }}
                    <input type="number" name="debt_duration" id="debt_duration" class="form-control form-control-sm  "
                        value="{{ isset($customer) ? $customer->debt_duration : '' }}">
                </div>
                <div class="form-group col-lg-3">
                    <label>วันที่ตัดรอบบิล </label> {{ isset($customer) ? $customer->billing_cycle_date : '' }}

                </div>
            </div>





        </div>
    </div>

    <div class="card  mt-4 bg-info">
        <div class="card-body">
            <div class="row">


                <div class="form-group col-lg-3">
                    <label>เงื่อนไขวางบิล </label> {{ isset($customer) ? $customer->billing_duration : '' }}
                </div>
                <div class="form-group col-lg-3">
                    <label>ช่องทางการวางบิล {{ isset($customer) ? $customer->billing_method : '' }}</label>
                </div>

                <div class="form-group col-lg-6">
                    <label>หมายเหตุการวางบิล {{ isset($customer) ? $customer->billing_remark : '' }}</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-3 {{ $errors->has('billing_invoice') ? 'has-error' : '' }}">
                    <label for="billing_invoice" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_invoice === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_invoice').value = this.checked">
                        {{ 'ใบกำกับภาษี' }}
                    </label>
                </div>
                <div class="form-group col-lg-3 {{ $errors->has('billing_po') ? 'has-error' : '' }}">
                    <label for="billing_po" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_po === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_po').value = this.checked">
                        {{ 'P/O' }}
                    </label>

                </div>
                <div class="form-group col-lg-3 {{ $errors->has('billing_receipt') ? 'has-error' : '' }}">
                    <label for="billing_receipt" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_receipt === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_receipt').value = this.checked">
                        {{ 'ใบเสร็จรับเงิน' }}
                    </label>

                </div>
                <div class="form-group col-lg-3 {{ $errors->has('billing_envelope') ? 'has-error' : '' }}">
                    <label for="billing_envelope" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_envelope === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_envelope').value = this.checked">
                        {{ 'ซองจดหมายติดแสตมป์' }}
                    </label>

                </div>
                <div class="form-group col-lg-3 {{ $errors->has('billing_delivery') ? 'has-error' : '' }}">
                    <label for="billing_delivery" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_delivery === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_delivery').value = this.checked">
                        {{ 'ส่งของพร้อมวางบิล' }}
                    </label>

                </div>
                <div class="form-group col-lg-3 {{ $errors->has('billing_reference') ? 'has-error' : '' }}">
                    <label for="billing_reference" class="control-label">
                        <input type="checkbox" {{ $checklist->billing_reference === 'true' ? 'checked' : '' }}
                            onclick="document.querySelector('#billing_reference').value = this.checked">
                        {{ 'พิมพ์เอกสารแนบใบวางบิล' }}
                    </label>

                </div>
            </div>


        </div>
    </div>








@endsection
