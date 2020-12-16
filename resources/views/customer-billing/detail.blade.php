<div class="card">
    <!-- <div class="card-header">รายละเอียดใบวางบิล</div> -->
    <div class="card-body">
        <h4>รายละเอียดใบวางบิล</h4>
        <div class="table-responsive table-binvoiceed">
            <table width="100%" class="table table-hover text-center table-bordered table-sm" id="table">
                <thead>
                    <tr>                    
                        <th class="text-center">#</th>
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
                            <input class="checkboxs" name="checkboxs[]" total_debt="{{ $row->total_debt }}" type="checkbox"  onchange="onSelect();" value="{{ $row->invoice_code }}">
                        </td>
                        <td>
                            {{ $row->invoice_code }}
                            <input name="invoice_codes[]" type="hidden" value="{{ $row->invoice_code }}" >
                        </td>
                        <td>{{ $row->datetime }}</td>
                        <td>{{ $row->external_reference_id }}</td>
                        <!-- <td>{{ $row->Customer->customer_code }}</td> -->
                        <!-- <td>{{ $row->Customer->company_name }}</td> -->
                        <td clsss="total_debts">{{ $row->total_debt }}</td>
                        <!-- <td>{{ number_format($row->total?$row->total:0,2) }}</td> -->
                        <!-- <td>{{ $row->User->short_name }}</td> -->
                    </tr>
                    @endforeach
                </tbody>
                @php
                    $total = count($table_invoice) > 0 ? $table_invoice->sum('total_debt') : 0;
                @endphp
            
             
                <tfoot>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center">รวม</th>
                        <!-- <th class="text-center">รหัสลูกค้า</th> -->
                        <!-- <th class="text-center">ชื่อบริษัท</th> -->
                        <th class="text-center">
                            <input class="form-control form-control-sm" name="total" type="number" id="total" value="0" min="1" total="{{ isset($customerbilling->total) ? $customerbilling->total : $total }}" readonly >
                        </th>
                        <!-- <th class="text-center">ยอดรวม</th> -->
                        <!-- <th class="text-center">รหัสพนักงาน</th> -->
                    </tr>
                </tfoot>


            </table>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        console.log("555");
        //$('#table').DataTable().order( [ 0, 'desc' ] ).draw();
    });

    function onSelect(){
        console.log("trigger");
        let checkboxs = document.querySelectorAll(".checkboxs");
        let total = 0;
        for(let i=0; i<checkboxs.length; i++){
            let cb = checkboxs[i];
            if(cb.checked){
                total += Number(cb.getAttribute("total_debt"));
            }
        }
        // let i = element.getAttribute("index");            
        document.querySelector("#total").value = total.toFixed(2);
        // let remain = document.querySelectorAll(".remains")[i];
        // if(element.checked){
        //     console.log("checked");
        //     payment.value = payment.getAttribute("total_debt");
        //     $(payment).change();
        // }else{
        //     console.log("unchecked");
        //     payment.value = 0;
        //     $(payment).change();
        // }
    }

</script>