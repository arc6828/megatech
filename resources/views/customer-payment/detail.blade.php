@php
//$invoices = $invoices? $invoices : [];
$customer_billing_total = ( $invoices ? $invoices->sum('total_debt') : 0 ) +  ( $debts ? $debts->sum('total_debt') : 0 );
@endphp
<div class="card mb-4">
    <!-- <div class="card-header">รายละเอียด Invoice</div> -->
    <div class="card-body">
        <h3>รายละเอียด Invoice</h3>
        <div class="table-responsive table-binvoiceed">
            <table width="100%" class="table table-hover text-center table-sm table-bordered" id="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ใบวางบิล</th>
                        <th class="text-center">เลขที่เอกสาร</th>
                        <th class="text-center">วันที่</th>
                        <th class="text-center">เอกสารอ้างอิง</th>
                        <th class="text-center">ยอดหนี้คงค้าง</th>
                        <th class="text-center">รับชำระ</th>
                        <!-- <th class="text-center d-none">ยอดรวม</th> -->
                        <th class="text-center">คงเหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $row)
                    <tr>
                        <td> <input type="checkbox" index="{{ $loop->index }}" onchange="onSelect(this);"> </td>
                        <td>{{ isset($row->customer_billing_detail) ? $row->customer_billing_detail->customer_billing->doc_no : '' }}</td>
                        <td>{{ $row->invoice_code }}</td>
                        <td>{{ explode(" ",$row->datetime)[0] }}</td>
                        
                        <td>{{ $row->external_reference_id }}</td>
                        <td>{{ $row->total_debt }}</td>
                        <td>
                            <input style="width:100px;" name="invoice_payments[]" total_debt="{{ $row->total_debt }}"  value="0" class="invoice_payments payments">
                            
                            <input type="hidden" name="invoice_ids[]" value="{{ $row->invoice_id }}">
                        </td>
                        <!-- <td class="d-none">{{ number_format($row->total?$row->total:0,2) }}</td> -->
                        <td>
                        <input style="width:100px;" name="remains[]" total_debt="{{ $row->total_debt }}" class="remains" value="{{ $row->total_debt }}" class="remains">
                        </td>
                    </tr>
                    @endforeach
                    @foreach($debts as $row)
                    <tr>
                        <td> <input type="checkbox" index="{{ count($invoices) + $loop->index }}" onchange="onSelect(this);"> </td>
                        
                        <td></td>
                        <td>{{ $row->doc_no }}</td>
                        <td>{{ explode(" ",$row->date)[0] }}</td>
                        
                        <td> </td>
                        <td>{{ $row->total_debt }}</td>
                        <td>
                            <input style="width:100px;" name="customer_debt_payments[]" total_debt="{{ $row->total_debt }}" value="0" class="invoice_payments payments">                            
                            <input type="hidden" name="customer_debt_ids[]" value="{{ $row->id }}">
                        </td>
                        <!-- <td class="d-none">{{ number_format($row->total?$row->total:0,2) }}</td> -->
                        <td>
                            <input style="width:100px;" name="remains[]" total_debt="{{ $row->total_debt }}" class="remains" value="{{ $row->total_debt }}" class="remains">
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center">รวม</th>
                        <th class="text-center">
                            <input style="width:100px;"  name="debt_total" type="text" id="debt_total" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : $customer_billing_total }}"  readonly>            
                        </th>
                        <th class="text-center">
                            <!-- <input style="width:100px;"  name="payment_total" type="text" id="payment_total" value="{{ isset($customerpayment->payment_total) ? $customerpayment->payment_total : $customer_billing_total}}" readonly> -->
                            <input style="width:100px;"  name="payment_total" type="text" id="payment_total" value="0" readonly>
                        </th>
                        <!-- <th class="text-center d-none">ยอดรวม</th> -->
                        <th class="text-center">
                            <input style="width:100px;"  name="remain_total" type="text" id="remain_total" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : $customer_billing_total }}" readonly>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>

        <!-- <div class="form-group form-row text-center pr-5">
            <label for="debt_total" class="col-lg-3 control-label">{{ 'ยอดรวมหนี้' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="debt_total" type="text" id="debt_total" value="{{ isset($customerpayment->debt_total) ? $customerpayment->debt_total : $customer_billing_total }}"  readonly>
            
            
            <label for="payment_total" class="col-lg-3 control-label">{{ 'ยอดรวมรับชำระ' }}</label>
            <input class="col-lg-3 form-control form-control-sm" name="payment_total" type="text" id="payment_total" value="{{ isset($customerpayment->payment_total) ? $customerpayment->payment_total : $customer_billing_total}}" readonly>
            
        </div> -->

        <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            console.log("555");
            //$('#table').DataTable().order( [ 0, 'desc' ] ).draw();
        });

        function onSelect(element){
            let i = element.getAttribute("index");            
            let payment = document.querySelectorAll(".invoice_payments")[i];
            let remain = document.querySelectorAll(".remains")[i];
            if(element.checked){
                console.log("checked");
                payment.value = payment.getAttribute("total_debt");
                $(payment).change();
            }else{
                console.log("unchecked");
                payment.value = 0;
                $(payment).change();
            }
        }

        </script>

    </div>
</div>