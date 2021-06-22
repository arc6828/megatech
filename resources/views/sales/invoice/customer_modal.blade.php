<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#customerModal">
    <i class="fa fa-plus"></i> เลือกลูกหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เลือกลูกหนี้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-1">
                <div class="table-responsive">
                    <table class="table table-hover text-center table-sm" id="table-customer-modal" style="width:100%">
                    </table>
                </div>

                <hr />
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดใบจอง</h5>
                <div class="table-responsive">
                    <table class="table table-hover text-center table-sm" id="table-order-detail" style="width:100%">
                    </table>
                </div>
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    //onClick
    function select_item(id, name, code) {
        console.log(id);
        $('#customer_id').val(id);
        $('#contact_name').val(name);
        $('#customer_code').val(code);
        // $('#customerModal').modal('hide');		
        // $("#btn-ref-order").attr("data-id",id);
        // $("#btn-ref-order").attr("customer_code", code);

        let table_detail = $('#table-order-detail').DataTable();
        table_detail.search(code).draw();
        // onChangeCustomer(id);
    }
    document.addEventListener("DOMContentLoaded", function(event) {
        //console.log("555");
        //AJAX
        $('#customerModal').on('show.bs.modal', function(e) {
            if (!$.fn.DataTable.isDataTable('#table-customer-modal')) {
                var user_id = "{{ Auth::id() }}";
                $.ajax({
                    url: "{{ url('/') }}/api/customer?user_id=" + user_id,
                    type: "GET",
                    dataType: "json",
                }).done(function(result) {
                    //console.log(result);
                    let dataSet = [];
                    result.forEach(function(element, index) {
                        //console.log(element,index);
                        let row = [
                            element.customer_code,
                            element.company_name +
                            "<input type='hidden' class='customer_id' value='" +
                            element.customer_id + "'>",
                            element.contact_name,
                            // "<button type='button' " +
                            // 		"class='btn btn-warning btn-sm'" +
                            // 		"onClick='select_item("+element.customer_id+",`"+element.contact_name+"`,`"+element.customer_code+"`)' "
                            // 		+">เลือก</button>",
                        ];
                        dataSet.push(row);
                    });
                    //console.log(dataSet);

                    $('#table-customer-modal').DataTable({
                        data: dataSet,
                        paging: false,
                        info: false,
                        deferRender: true,
                        columns: [{
                                title: "รหัส"
                            },
                            {
                                title: "บริษัท"
                            },
                            {
                                title: "ผู้ติดต่อ"
                            },
                            // { title: "#" },
                        ]
                    });
                    //DATA TABLE SCROLL
                    let tableCont = document.querySelector('#table-customer-modal');
                    tableCont.style.cssText = "margin-top : -1px !important; width:100%;";

                    tableCont.parentNode.style.overflow = 'auto';
                    tableCont.parentNode.style.maxHeight = '200px';
                    tableCont.parentNode.addEventListener('scroll', function(e) {
                        let scrollTop = this.scrollTop - 1;
                        this.querySelector('thead').style.transform = 'translateY(' +
                            scrollTop + 'px) ' + 'translateZ(' + 1000 + 'px)';
                        this.querySelector('thead').style.background = "white";
                        this.querySelector('thead').style.zIndex = "3000";
                        //this.querySelector('thead').style.marginBottom = "200px";
                        //console.log(scrollTop);
                    })
                    //END DATA TABLE SCROLL

                    //EVENT FOR CUSTOMER ROW
                    $('#table-customer-modal').on('click', 'tr', function() {
                        let table = $('#table-customer-modal').DataTable();
                        let d = table.row(this).data();
                        console.log(d);
                        console.log("ROW : ", d, $("<div>" + d[1] + "</div>").find(
                            ".customer_id"));
                        let customer_id = $("<div>" + d[1] + "</div>").find(
                            ".customer_id")[0].value;
                        let contact_name = d[2];
                        let customer_code = d[0];
                        select_item(customer_id, contact_name, customer_code);
                        // var key = d[0];
                        // var table_detail = $('#table-order-detail').DataTable();
                        // table_detail.search(key).draw();
                    });
                }); //END AJAX
            } //END IF

            //detail
            //AJAX
            $.ajax({
                    url: "{{ url('/') }}/api/order_detail/index2?order_detail_status_id=1",
                    type: "GET",
                    dataType: "json",
                })
                .done(function(result) {
                    console.log(result);
                    let dataSet = [];
                    result.forEach(function(element, index) {
                        console.log(element, index);
                        let id = element.order_detail_id;
                        let order_id = element.order_id;
                        let row = [
                            "<a href='javascript:void(0)' onclick='fillInvoice(" +
                            order_id + ");'>" + element.order_code + "</a>",
                            //element.date,
                            //element.delivery_time,
                            element.customer_code,
                            element.product_code,
                            element.product_name,
                            element.amount,
                            "<input name='approve_amounts[]' value='" + element
                            .approved_amount +
                            "' class='form-control form-control-sm' style='max-width:50px;' required>",
                            //0,
                            //0,
                            //0,
                        ];
                        dataSet.push(row);
                    });
                    //console.log(dataSet);
                    let table_detail;
                    if (!$.fn.DataTable.isDataTable('#table-order-detail')) {
                        table_detail = $('#table-order-detail').DataTable({
                            paging: false,
                            info: false,
                            data: dataSet,
                            columns: [{
                                    title: "เลขที่ OE"
                                },
                                //{ title: "วันที่ OE" },
                                //{ title: "วันที่ส่งของ" },
                                {
                                    title: "ลูกค้า"
                                },
                                {
                                    title: "รหัสสินค้า"
                                },
                                {
                                    title: "ชื่อสินค้า"
                                },
                                {
                                    title: "จำนวน"
                                },
                                {
                                    title: "จำนวนที่อนุมัติ"
                                },
                                //{ title: "ค้างรับ" },
                                //{ title: "ค้างส่ง" },
                                //{ title: "จำนวนคงคลัง" },
                            ],
                            "pageLength": 3,
                        }); //END DATATABLE
                        //DATA TABLE SCROLL
                        let tableCont = document.querySelector('#table-order-detail');
                        tableCont.style.cssText = "margin-top : -1px !important; width:100%;";

                        tableCont.parentNode.style.overflow = 'auto';
                        tableCont.parentNode.style.maxHeight = '200px';
                        tableCont.parentNode.addEventListener('scroll', function(e) {
                            let scrollTop = this.scrollTop - 1;
                            this.querySelector('thead').style.transform = 'translateY(' +
                                scrollTop + 'px) ' + 'translateZ(' + 1000 + 'px)';
                            this.querySelector('thead').style.background = "white";
                            this.querySelector('thead').style.zIndex = "3000";
                            //this.querySelector('thead').style.marginBottom = "200px";
                            //console.log(scrollTop);
                        })
                    } else {
                        table_detail = $('#table-order-detail').DataTable();
                    }
                    $('#table-order-detail input').attr("readonly", true);


                    table_detail = $('#table-order-detail').DataTable();
                    table_detail.search("*").draw();
                }); //END DONE AJAX
        }); // END MODAL EVENT
    }); //END ADD EVENT LISTENER

    function fillInvoice(order_id) {
        //console.log(order_id, "{{ url('/') }}/api/order/"+order_id);
        $.ajax({
            url: "{{ url('/') }}/api/order/" + order_id,
            type: "GET",
            dataType: "json",
        }).done(function(result) {
            //            console.log("RESULT yyy:", result)
            fillOrder(result);
            //result = result.table_order[0].order_id;
            fillOrderDetail(result);
            //ALL ABOUT EVENT
            refreshDetailTableEvent();
            //AVOID TO EDIT
            $('#table-invoice-detail input').prop('readonly', true);

        }); //END AJAX

        // document.querySelector("#btn-close-order").click();
        $('#customerModal').modal('hide');

    }

    function fillOrder(result) {
        var element = result.table_order[0];

        //document.querySelector("#invoice_code").value = element.invoice_code ;
        document.querySelector("#internal_reference_id").value = element.order_code;
        document.querySelector("#external_reference_id").value = element.external_reference_id;
        let url = "{{ url('storage') }}" + "/" + element.po_file;
        let a = document.querySelector("#po-file-link");
        a.href = url;
        a.target = "_blank";
        a.innerHTML = "ดูไฟล์ P/O";
        // document.querySelector("#external_reference_id").parentNode.innerHTML = "";



        document.querySelector("#customer_id").value = element.customer_id;
        document.querySelector("#customer_code").innerHTML = element.customer_code;
        document.querySelector("#company_name").value = element.company_name;
        document.querySelector("#payment_method").value = element.payment_method;
        document.querySelector("#payment_method_th").value = (element.payment_method == 'credit' ? 'ขายเชื่อ' :
            'ขายสด');
        document.querySelector("#max_credit").value = element.max_credit ? element.max_credit : "0";


        //document.querySelector("#contact_name").value = element.contact_name;
        var str_time = moment(element.datetime).format('YYYY-MM-DDTHH:mm'); //console.log(str_time);
        var dateControl = document.querySelector('#datetime').value =
            str_time; //dateControl.value = '2017-06-01T08:30';
        document.querySelector("#debt_duration").value = element.debt_duration;
        //SET BILLING DURATION
        var date = new Date(element.datetime); // Now
        date.setDate(date.getDate() + Number(element.debt_duration)); // Set now + 30 days as the new date
        //console.log(date);
        document.querySelector("#billing_duration").value = date.toISOString().substr(0, 10);
        document.querySelector("#payment_condition").value = element.payment_condition;
        document.querySelector("#delivery_type_id").value = element.delivery_type_id;
        document.querySelector("#tax_type_id").value = element.tax_type_id;
        //document.querySelector("#delivery_time").value = element.delivery_time;
        document.querySelector("#department_id").value = element.department_id;
        document.querySelector("#sales_status_id").value = element.sales_status_id;
        //document.querySelector("#user_id").value = element.user_id ;

        document.querySelector("#staff_id").value = element.staff_id;

        //alert("sss");
        document.querySelector("#zone_id").value = element.zone_id;
        document.querySelector("#total").value = element.total;
        document.querySelector("#remark").value = element.remark;
        document.querySelector("#vat_percent").value = element.vat_percent;

        onChange(document.querySelector("#vat_percent"));

    }

    function fillOrderDetail(result) {
        //console.log("detail : ", result);
        var dataSet = [];
        result.table_order_detail.forEach(function(element, index) {
            var id = element.order_detail_id;
            console.log("ELEMENT id : ", element);
            var row = createRow(id, element);
            console.log("🚀 ~ file: customer_modal.blade.php ~ line 311 ~ result.table_order_detail.forEach ~ row", row)
            dataSet.push(row);
        });
        console.log(dataSet);
        var table = $('#table-invoice-detail').DataTable();
        table
            .clear()
            .rows.add(dataSet)
            .draw();
    }

</script>
