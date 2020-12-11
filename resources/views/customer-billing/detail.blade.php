<div class="card">
    <!-- <div class="card-header">รายละเอียดใบวางบิล</div> -->
    <div class="card-body">
        <h4>รายละเอียดใบวางบิล</h4>
        <div class="table-responsive table-binvoiceed">
            <table width="100%" class="table table-hover text-center table-bordered table-sm" id="table">
                <thead>
                    <tr>
                        <th class="text-center">เลขที่เอกสาร</th>
                        <th class="text-center">วันที่</th>
                        <th class="text-center">PO ลูกค้า</th>
                        <!-- <th class="text-center">รหัสลูกค้า</th> -->
                        <!-- <th class="text-center">ชื่อบริษัท</th> -->
                        <th class="text-center">ยอดหนี้คงค้าง</th>
                        <!-- <th class="text-center">ยอดรวม</th> -->
                        <!-- <th class="text-center">รหัสพนักงาน</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($table_invoice as $row)
                    <tr>
                        <td>
                            {{ $row->invoice_code }}
                        </td>
                        <td>{{ $row->datetime }}</td>
                        <td>{{ $row->external_reference_id }}</td>
                        <!-- <td>{{ $row->Customer->customer_code }}</td> -->
                        <!-- <td>{{ $row->Customer->company_name }}</td> -->
                        <td>{{ $row->total_debt }}</td>
                        <!-- <td>{{ number_format($row->total?$row->total:0,2) }}</td> -->
                        <!-- <td>{{ $row->User->short_name }}</td> -->
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>