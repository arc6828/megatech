<div class="card mt-4" id="table">
    <div class="card-body">
        <style>
            .input {
                max-width: 50px;
                width: 100%;
            }

        </style>

        <div class="table-responsive">
            <table class="table table-hover text-center" id="table-purchase_requisition-detail" style="width:100%">
            </table>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var detail = JSON.parse('@json($table_purchase_requisition_detail)');
                //console.log("DETAIL : ",detail);
                var dataSet = [];
                detail_dict = {};
                detail.forEach(function(element, index) {

                    if (detail_dict["" + element.product_id]) {
                        detail_dict["" + element.product_id].amount += Number(element.amount);
                    } else {
                        detail_dict["" + element.product_id] = element;
                        detail_dict["" + element.product_id].amount = Number(element.amount);
                        detail_dict["" + element.product_id].amount_wait = 0;
                        detail_dict["" + element.product_id].amount_no = 0;
                        detail_dict["" + element.product_id].amount_yes = 0;
                    }
                    let status = element.purchase_requisition_detail_status_id;
                    switch (status) {
                        case "1":
                            status = "อนุมัติ";
                            detail_dict["" + element.product_id].amount_yes += Number(element.amount);
                            break;
                        case "2":
                            status = "ไม่อนุมัติ";
                            detail_dict["" + element.product_id].amount_no = Number(element.amount);
                            break;
                        case "3":
                            status = "รออนุมัติ";
                            detail_dict["" + element.product_id].amount_wait = Number(element.amount);
                            break;
                        case "4":
                            status = "กำหนดเจ้าซื้อแล้ว";
                            detail_dict["" + element.product_id].amount_yes += Number(element.amount);
                            break;
                        case "5":
                            status = "ออก PO แล้ว";
                            detail_dict["" + element.product_id].amount_yes += Number(element.amount);
                            break;
                        case "6":
                            status = "รับสินค้าแล้ว";
                            break;

                    }
                });
                //console.log("detail_dict : ", detail_dict);
                detail = Object.values(detail_dict);

                detail.forEach(function(element, index) {
                    //console.log(element,index);
                    var id = element.purchase_requisition_detail_id;
                    var row = createRow(id, element);
                    dataSet.push(row);
                });
                //console.log(dataSet);

                $('#table-purchase_requisition-detail').DataTable({
                    "ordering": false,
                    "searching": false,
                    "info": false,
                    "paging": false,
                    "pageLength": 50,
                    "data": dataSet,
                    "columns": [{
                            title: "รหัสสินค้า"
                        },
                        {
                            title: "ชื่อสินค้า"
                        },
                        {
                            title: "สั่งซื้อ"
                        },
                        {
                            title: "รออนุมัติ"
                        },
                        {
                            title: "ไม่อนุมัติ"
                        },
                        {
                            title: "อนุมัติ"
                        },
                        //{ title: "หน่วย" },
                        //{ title: "ราคาตั้ง" },
                        //{ title: "ส่วนลด %" },
                        //{ title: "ราคาขาย" },
                        //{ title: "ราคาขายรวม" },
                        //{ title: "สถานะ" },
                        // { title: "action" },
                    ],
                    "fnCreatedRow": function(nRow, aData, iDataIndex) {
                        //console.log("aData : ", aData, iDataIndex);
                        $(nRow).attr('id', "row-" + aData[0]);
                    },
                }); //END DataTable

                //ALL ABOUT EVENT
                refreshDetailTableEvent();


                //Load Product
                showProduct();

            }); //END DOMContentLoaded

            //EVENT HANDLER
            function createRow(id, element) {
                let status = element.purchase_requisition_detail_status_id;
                switch (status) {
                    case "1":
                        status = "อนุมัติ";
                        break;
                    case "2":
                        status = "ไม่อนุมัติ";
                        break;
                    case "3":
                        status = "รออนุมัติ";
                        break;
                    case "4":
                        status = "กำหนดเจ้าซื้อแล้ว";
                        break;
                    case "5":
                        status = "ออก PO แล้ว";
                        break;
                    case "6":
                        status = "รับสินค้าแล้ว";
                        break;
                    default:
                        status = "รออนุมัติ";
                        element.purchase_requisition_detail_status_id = 3;
                        break;
                }
                return [
                    "<input type='hidden' class='id_edit' name='id_edit[]'  value='" + id + "' >" +
                    element.product_code +
                    "<input type='hidden' class='product_id_edit' name='product_id_edit[]'  value='" + element
                    .product_id + "' >",
                    element.product_name,

                    "<input class='input amount_edit' name='amount_edit[]'  value='" + element.amount + "' >",
                    "" + (element.before_approved_amount ? element.before_approved_amount : 0) + "",
                    "" + (element.amount_no ? element.amount_no : 0) + "",
                    "" + (element.approved_amount ? element.approved_amount : 0) + "",

                    //element.product_unit,
                    //"<input class='input normal_price_edit' name='normal_price_edit[]'  value='"+element.normal_price+"' disabled>",
                    //			"<input type='number' step='any' class='input discount_percent_edit' name='discount_percent_edit[]' max="+element.max_discount_percent+"  value='"+(100 - element.discount_price / element.normal_price * 100)+"'>",
                    //"<input class='input discount_price_edit' name='discount_price_edit[]'  value='"+element.discount_price+"'>",
                    //"<input class='input total_edit' name='total_edit[]'  value='"+(element.discount_price *  element.amount)+"' disabled>",
                    //""+status +"<input type='hidden' name='purchase_requisition_detail_status_id_edit[]'  value='"+element.purchase_requisition_detail_status_id+"' >",
                    //   "<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' >" +
                    //     "<span class='fa fa-trash'></span>" +
                    //   "</a>",
                ];
            }

            //ON CHANGE + ON KEYUP
            function calculateNumber() {
                document.querySelectorAll(".input").forEach(function(element, index) {
                    element.removeEventListener("change", onChange3, true);
                    element.removeEventListener("keyup", onChange3, true);
                    element.addEventListener("change", onChange3, true);
                    element.addEventListener("keyup", onChange3, true);
                }); //END foreach
            }

            function onChange3() {
                //var row = document.querySelector("#row-"+id);
                var obj = event.target;
                var row = $(obj).parents('tr')[0];
                var discount_price_edit = row.querySelector(".discount_price_edit");
                var discount_percent_edit = row.querySelector(".discount_percent_edit");
                var normal_price_edit = row.querySelector(".normal_price_edit");
                var total_edit = row.querySelector(".total_edit");
                var amount_edit = row.querySelector(".amount_edit");
                console.log("DOM : ", discount_percent_edit);
                //var btn_submit = row.querySelector("input[name='new_btn_submit']");
                //console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
                switch (obj.name) {
                    case "discount_percent_edit[]":
                        //EFFECT TO #discount_price_edit
                        console.log("EFFECT TO #discount_price_edit");
                        discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (
                            discount_percent_edit.value) / 100;

                        break;
                    case "discount_price_edit[]":
                        //EFFECT TO #discount_percent_edit
                        console.log("EFFECT TO #discount_percent_edit");
                        discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
                        break;
                }
                //EFFECT TO #total_edit
                total_edit.value = amount_edit.value * discount_price_edit.value;
                //console.log(obj.value, obj.id);


                onChange(document.getElementById("vat_percent"));
            }

            function toDelete() {
                document.querySelectorAll(".btn-delete-detail").forEach(function(element, index) {
                    element.removeEventListener("click", myFunction, true);
                    element.addEventListener("click", myFunction, true);
                }); //END foreach
            }

            function myFunction(event) {
                //console.log("CHANGE : ", this,this.getAttribute("data_id"));
                //onChange3(this,this.getAttribute("data_id"));
                var want_to_delete = confirm('Are you sure to delete this purchase_requisition detail?');
                if (want_to_delete) {
                    var table = $('#table-purchase_requisition-detail').DataTable();
                    table
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                    onChange(document.getElementById("vat_percent"));
                }
            }

            function refreshDetailTableEvent() {
                toDelete();
                calculateNumber();
                onChange(document.getElementById("vat_percent"));
            }

        </script>

        <div class="text-center">

            @include('purchase/requisition/create_detail_modal')

        </div>
    </div>
</div>
