@extends('layouts/argon-dashboard/theme')

@section('title',  'สร้างใบรับวางบิล'  )

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        <a href="{{ url('/finance/supplier-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/finance/supplier-billing') }}?end_date={{ request('end_date') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('supplier-billing.form', ['formMode' => 'create'])

                            

                        </form>

                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">รายละเอียดใบรับวางบิล</div>
                    <div class="card-body">
                        <div class="table-responsive table-breceiveed">
                            <table width="100%" class="table table-hover text-center table-sm" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">เลขที่เอกสาร</th>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">รหัสลูกค้า</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">ยอดหนี้คงค้าง</th>
                                        <th class="text-center">ยอดรวม</th>
                                        <th class="text-center">รหัสพนักงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($table_receive as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/') }}/sales/receive/{{ $row->receive_id }}/edit">
                                                {{ $row->receive_code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->datetime }}</td>
                                        <td>{{ $row->Supplier->supplier_code }}</td>
                                        <td><a href="{{ url('/supplier') }}/{{ $row->supplier_id }}">{{ $row->Supplier->company_name }}</a></td>
                                        <td>{{ $row->total_debt }}</td>
                                        <td>{{ number_format($row->total?$row->total:0,2) }}</td>
                                        <td>{{ $row->User->short_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
