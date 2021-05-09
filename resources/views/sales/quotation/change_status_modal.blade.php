<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" id="btn-change-status" data-toggle="modal"
    data-target="#statusModal">
    <i class="fa fa-refresh"></i> เปลี่ยนสถานะ
</button>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนแปลงสถานะ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/status"
                    method="POST" id="form-duplicate" onsubmit="return confirm('Do you confirm to change status?')">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group ">
                        <lable>สถานะ</label>
                            <select name="sales_status_id" id="sales_status_id2" class="form-control form-control-sm"
                                required>

                                @foreach ($table_sales_status as $row_sales_status)
                                    <option value="{{ $row_sales_status->sales_status_id }}"
                                        {{ $row_sales_status->sales_status_id === '6' ? 'disabled' : '' }}>
                                        {{ $row_sales_status->sales_status_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($mode == 'edit')
                                <script>
                                    document.querySelector("#sales_status_id2").value = "{{ $row->sales_status_id }}"
                                </script>
                            @endif
                    </div>

                    <div class="form-group ">
                        <lable>เหตุผล</label>
                            <input name="reason" class="form-control form-control-sm" id="reason2" value='' > 
                            {{-- required --}}
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-success"
                            id="btn-change-status-submit">เปลี่นแปลงสถานะ</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        //var detail = JSON.parse('@json($table_product)');
        $('#exampleModal').on('shown.bs.modal', function(e) {
            showProduct();
        }); // END MODAL EVENT

    }); //END ADD EVENT LISTENER

    function showProduct() {
        if (!$.fn.DataTable.isDataTable('#table-product-model')) {
            //setPreLoader(true);
            $.ajax({
                url: "{{ url('/') }}/api/product",
                type: "GET",
                dataType: "json",
            }).done(function(result) {
                //console.log(dataSet);

                var table = $('#table-product-model').DataTable({
                    "data": prepareDataSet(result),
                    "deferRender": true,
                    "columns": [{
                            title: "รหัสสินค้า"
                        },
                        //{ title: "Barcode" },
                        {
                            title: "ชื่อสินค้า"
                        },
                        {
                            title: "ราคาขาย"
                        },
                        {
                            title: "จำนวน"
                        },
                        {
                            title: "#คงเหลือ"
                        },
                        {
                            title: "#ค้างส่ง"
                        },
                        {
                            title: "#ค้างรับ"
                        },
                        {
                            title: "#คงเหลือ - ค้างส่ง"
                        },
                        {
                            title: "action"
                        },
                    ],
                    /*"scrollY": "250px",
                    "scrollCollapse": true,*/
                    "paging": false,
                    "order": [
                        [4, "desc"]
                    ],
                }); // END DATATABLE


                table.columns.adjust().draw();

                //DATA TABLE SCROLL
                var tableCont = document.querySelector('#table-product-model');
                tableCont.parentNode.style.overflow = 'auto';
                tableCont.parentNode.style.height = '500px';
                tableCont.parentNode.addEventListener('scroll', function(e) {
                    var scrollTop = this.scrollTop;
                    this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) ' +
                        'translateZ(' + 100 + 'px)';
                    this.querySelector('thead').style.background = "white";
                    this.querySelector('thead').style.zIndex = "3000";
                    this.querySelector('thead').style.marginBottom = "100px";
                    console.log(scrollTop);
                })
                //END DATA TABLE SCROLL



                table.on('search.dt', function() {
                    var search_key = table.search();
                    if (search_key != $('#search_key').val()) {
                        console.log("Hello", table.search());
                        $.ajax({
                            url: "{{ url('/') }}/api/product?q=" + search_key,
                            type: "GET",
                            dataType: "json",
                        }).done(function(result1) {
                            //console.log(dataSet);
                            $('#search_key').val(search_key);
                            var new_data = prepareDataSet(result1);
                            table.clear();
                            table.rows.add(new_data); // Add new data
                            table.columns.adjust().draw(); // Redraw the DataTable
                        });
                    }
                });
                //setPreLoader(false);


            }); //END AJAX
        }
    }

    function prepareDataSet(result) {
        var dataSet = [];
        result.forEach(function(element, index) {
            //console.log(element,index);
            var id = element.product_id;
            var price = parseFloat(element.promotion_price ? element.promotion_price : element.normal_price)
                .toFixed(2);
            var row = [
                element.product_code,
                //element.BARCODE,
                element.product_name,
                price,
                "<input name='amount_create' id='amount_create" + id + "'  value='" + element.quantity +
                "' style='width:50px;' >",
                element.amount_in_stock,
                element.pending_in,
                element.pending_out,
                element.amount_in_stock - element.pending_out,
                "<button type='button' json='" + JSON.stringify(element) +
                "' class='btn btn-success btn-create btn-sm' onclick='addProduct(this);' style='position:static; will-change:unset;'>" +
                "<span class='fa fa-plus'></span>" +
                "</button>",
            ];
            dataSet.push(row);
        });
        //console.log(dataSet);
        return dataSet;
    }

    function addProduct(obj) {
        var product = JSON.parse(obj.getAttribute("json"));
        product["amount"] = document.querySelector("#amount_create" + product.product_id).value;
        product["discount_price"] = product.promotion_price ? product.promotion_price : product.normal_price;
        //console.log("CLICK PRODUCT : ", product);

        var table = $('#table-quotation-detail').DataTable();
        var row = createRow("+", product);
        table.row.add(row).draw(false);
        refreshDetailTableEvent();
        document.querySelector("#btn-close").click();
        //console.log("CLICK");
    }

</script>
