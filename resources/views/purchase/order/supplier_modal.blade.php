<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#supplierModal">
    <i class="fa fa-plus"></i> เลือกเจ้าหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เลือกเจ้าหนี้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mt--4 modal-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center table-sm" id="table-supplier-modal" style="width:100%">
                    </table>
                </div>
                <hr>
                <h5 class="modal-title" id="exampleModalLabel">รายการจากใบเสนอซื้อ</h5>
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
        //console.log("supplier_id : ",$('#supplier_id').val());
        $('#supplier_id').val(id);
        $('#company_name').val(name);
        $('#supplier_code').text(code);
        $.ajax({
            url: "{{ url('/') }}/api/supplier/" + id,
            type: "GET",
            dataType: "json",
        }).done(function(result) {
            var supplier = result[0];
            $('#supplier_id').val(supplier.supplier_id);
            $('#company_name').val(supplier.company_name);
            $('#supplier_code').text(supplier.supplier_code);
            $('#debt_duration').val(supplier.debt_duration);
            $('#billing_duration').val(supplier.billing_duration);
            $('#payment_condition').val(supplier.payment_condition);
            $('#delivery_type_id').val(supplier.delivery_type_id);
            $('#tax_type_id').val(supplier.tax_type_id);
            $('#delivery_time').val(supplier.delivery_time);
            console.log(result, supplier.supplier_id);
            //console.log("supplier_id : ",$('#supplier_id').val());
            $('#supplierModal').modal('hide');
            onChangeCustomer();
        }); //END AJAX




    }
    document.addEventListener("DOMContentLoaded", function(event) {
        //console.log("555");
        //AJAX
        $('#supplierModal').on('show.bs.modal', function(e) {
            if (!$.fn.DataTable.isDataTable('#table-supplier-modal')) {
                $.ajax({
                    url: "{{ url('/') }}/api/supplier",
                    type: "GET",
                    dataType: "json",
                }).done(function(result) {
                    //console.log(result);
                    var dataSet = [];
                    result.forEach(function(element, index) {
                        //console.log(element,index);
                        var row = [
                            element.supplier_code,
                            element.company_name,
                            //element.contact_name,
                            "<button type='button' " +
                            "class='btn btn-success btn-sm'" +
                            "onClick='select_item(" + element.supplier_id + ",`" +
                            element.company_name + "`,`" + element.supplier_code +
                            "`)' " +
                            ">เลือก</button>",
                        ];
                        dataSet.push(row);
                    });
                    //console.log(dataSet);

                    var table = $('#table-supplier-modal').DataTable({
                        data: dataSet,
                        deferRender: true,
                        paging: false,
                        info: false,
                        columns: [{
                                title: "รหัส"
                            },
                            {
                                title: "บริษัท"
                            },
                            //{ title: "ผู้ติดต่อ" },
                            {
                                title: "#"
                            },
                        ],
                        "pageLength": 3,
                    });
                    //DATA TABLE SCROLL
                    var tableCont = document.querySelector('#table-supplier-modal');
                    tableCont.style.cssText = "margin-top : -1px !important; width:100%;";
                    tableCont.parentNode.style.overflow = 'auto';
                    tableCont.parentNode.style.maxHeight = '200px';
                    tableCont.parentNode.addEventListener('scroll', function(e) {
                        var scrollTop = this.scrollTop;
                        this.querySelector('thead').style.transform = 'translateY(' +
                            scrollTop + 'px) ' + 'translateZ(' + 100 + 'px)';
                        this.querySelector('thead').style.background = "white";
                        this.querySelector('thead').style.zIndex = "3000";
                        this.querySelector('thead').style.marginBottom = "100px";
                        console.log(scrollTop);
                    })
                    //END DATA TABLE SCROLL

                    $('#table-supplier-modal').on('click', 'tr', function() {
                        var d = table.row(this).data();
                        //console.log("ROW : ",d);

                        var key = d[0];
                        var table_detail = $('#table-order-detail').DataTable();
                        table_detail.search(key).draw();
                    });
                }); //END AJAX
            }


            //detail
            //AJAX
            if (!$.fn.DataTable.isDataTable('#table-order-detail')) {
                $.ajax({
                    url: "{{ url('/') }}/api/purchase/order_detail/index_create/",
                    type: "GET",
                    dataType: "json",
                }).done(function(result) {
                    //console.log(result);
                    var dataSet = [];
                    result.forEach(function(element, index) {
                        //console.log(element,index);
                        var id = element.requisition_detail_id;
                        var row = [
                            element.purchase_requisition_code,
                            moment(element.datetime).format('DD-MM-YYYY'),
                            //element.delivery_time,
                            element.supplier_code,
                            //element.company_name,
                            element.product_code,
                            element.product_name + " / " + element.grade,
                            element.amount,
                            "<input type='number' name='approve_amounts[]' value='" +
                            element.supplier_amount +
                            "' class='form-control form-control-sm' style='max-width:100px;' readonly required>",
                            //0,
                            //0,
                            //0,
                        ];
                        dataSet.push(row);
                        //GROUP BY PRODUCT
                        /*
                        var found = false;
                        var found_index = -1;

                        for(var i=0; i<index; i++){
                          if(dataSet[i][2] == element.supplier_code){
                            found = true;
                            found_index = i;
                            break;
                          }
                        }
                        if(found){ // check if supplier exist
                          dataSet[i][6] = parseInt(dataSet[i][6]) + parseInt(element.amount);
                        }else{                
                          dataSet.push(row);
                        }
                        */
                        //
                    });
                    //console.log(dataSet);

                    var table_detail = $('#table-order-detail').DataTable({
                        data: dataSet,
                        info: false,
                        paging: false,
                        columns: [{
                                title: "เลขที่ PR"
                            },
                            {
                                title: "วันที่ PR"
                            },
                            //{ title: "วันที่ส่งของ" },
                            {
                                title: "รหัสเจ้าหนี้"
                            },
                            //{ title: "เจ้าหนี้" },
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
                    var tableCont = document.querySelector('#table-order-detail');
                    tableCont.style.cssText = "margin-top : -1px !important; width:100%;";
                    tableCont.parentNode.style.overflow = 'auto';
                    tableCont.parentNode.style.maxHeight = '200px';
                    tableCont.parentNode.addEventListener('scroll', function(e) {
                        var scrollTop = this.scrollTop;
                        this.querySelector('thead').style.transform = 'translateY(' +
                            scrollTop + 'px) ' + 'translateZ(' + 100 + 'px)';
                        this.querySelector('thead').style.background = "white";
                        this.querySelector('thead').style.zIndex = "3000";
                        this.querySelector('thead').style.marginBottom = "100px";
                        console.log(scrollTop);
                    })
                    //END DATA TABLE SCROLL
                    $('#table-order-detail input').attr("readonly", true);
                    table_detail.search("*").draw();
                }); //END DONE AJAX
            }
        }); // END MODAL EVENT
    }); //END ADD EVENT LISTENER

</script>
