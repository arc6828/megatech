@extends('layouts/print')

@section('title', 'ใบรับคืน')

@section('background-tag', 'bg-warning')

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
    @forelse($table_invoice as $row)

        <div>
            @foreach ($table_company as $company)
                <div class="inline" style="width:30%; text-align:center;">
                    <div style="padding-right: 10px; padding-left: 10px;">
                        <img src="{{ url('/') }}/images/megatech-logo-small.jpg" style="width:100%">
                    </div>
                    <div> <strong>เลขประจำตัวผู้เสียภาษี</strong> {{ $company->number_tex }}</div>
                </div>
                <div class="inline" style="width:69%;">
                    <div class="company_name">{{ $company->thname_company }}</div>
                    <div class="company_name">{{ $company->enname_company }}</div>
                    <div class="sub_company_name">{{ $company->address }}</div>
                    <div class="sub_company_name">
                        Tel: {{ $company->tal }}
                        Fax: {{ $company->fax }}
                        E-mail: {{ $company->email }}
                    </div>
                    <div class="sub_company_name">www.megatechcuttingtool.com</div>
                </div>
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
                                <div class="company_name" style="border:1px solid; padding: 10px 0px; ">ใบรับคืน</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="inline" style="width:30%;  ">
                <div>
                    <table class="no-padding-cell" border="1"
                        style="border-collapse: collapse; width:100%; text-align:center;">
                        <tr>
                            <th>เลขที่</th>
                            <td>{{ $row->invoice_code }}</td>
                        </tr>
                        <tr>
                            <th>วันที่</th>
                            <td>{{ $row->datetime }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div style="margin-top:10px;">
            <table border="1" style="border-collapse: collapse; width:100%;">
                <tr>
                    <td>
                        <strong>ลูกค้า :</strong> {{ $row->company_name }} {{ $row->tax_number }}<br>
                        <strong>ที่อยู่ :</strong> {{ $row->address }} <br>
                        <div class="inline" style="width:25px;"></div>
                        {{ $row->address2 }}
                        @if ($row->province == 'กรุงเทพมหานคร')
                            {{ $row->sub_district ? 'แขวง' . $row->sub_district : '' }}
                            {{ $row->district ? 'เขต' . $row->district : '' }}
                            {{ $row->province ? '' . $row->province : '' }}
                        @else
                            {{ $row->sub_district ? 'ต.' . $row->sub_district : '' }}
                            {{ $row->district ? 'อ.' . $row->district : '' }}
                            {{ $row->province ? 'จ.' . $row->province : '' }}
                        @endif
                        {{ $row->zipcode }} <br>
                        <strong>โทร :</strong> {{ $row->telephone }}
                        <strong style="margin-left:150px;">แฟ๊กซ์ :</strong> {{ $row->fax }}
                        <strong style="margin-left:150px;">รหัสลูกค้า :</strong> {{ $row->customer_code }} <br>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-top:10px;">
            <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>จำนวน</th>
                    <th>หน่วยละ</th>
                    <th>จำนวนเงิน</th>
                </tr>
                @foreach ($table_invoice_detail as $row_detail)


                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row_detail->product_code }}</td>
                        <td>{{ $row_detail->product_name }} </td>
                        <td>{{ $row_detail->amount }}</td>
                        <td>{{ number_format($row_detail->discount_price, 2) }}</td>
                        <td>{{ number_format($row_detail->amount * $row_detail->discount_price, 2) }}</td>
                    </tr>

                @endforeach
            </table>
        </div>
        <div style="text-align:center; margin-top:70px;">
            <div class="inline" style="width:5%;"></div>
            <div class="inline" style="width:33%;">
                _______________________________________<br>
                ผู้ขาย<br>
                วันที่ {{ date('d/m/Y', strtotime($row->datetime)) }}
            </div>
            <div class="inline" style="width:23%;"></div>
            <div class="inline" style="width:33%;">
                _______________________________________<br>
                ผู้อนุมัติ<br>
                วันที่ {{ date('d/m/Y', strtotime($row->datetime)) }}
            </div>
            <div class="inline" style="width:5%;"></div>
        </div>

        <div class="" style="text-align : center; margin-top:30px;">
            <div class="">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($row->invoice_code, 'C128') }}" alt="barcode" />
            </div>
            <div class="">
                {{ $row->invoice_code }}
            </div>
        </div>
    @empty
    @endforelse
@endsection
