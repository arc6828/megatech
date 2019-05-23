<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#supplierModal">
	<i class="fa fa-plus"></i> เลือกเจ้าหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<table class="table table-hover text-center table-sm" id="table-supplier-modal" style="width:100%"></table>
				</div>
        <hr>
        <div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-order-detail" style="width:100%"></table>
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
	function select_item(id,name,code) {
			console.log(id);
					$('#supplier_id').val(id);
					$('#company_name').val(name);
					$('#supplier_code').text(code);
					$('#supplierModal').modal('hide');
					onChangeCustomer();
	}
	document.addEventListener("DOMContentLoaded", function(event) {
		//console.log("555");
		//AJAX
		$('#supplierModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-supplier-modal') ){
				$.ajax({
	          url: "{{ url('/') }}/api/supplier",
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						//console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							//console.log(element,index);
							var row = [
								element.supplier_code,
								element.company_name,
								//element.contact_name,
								"<button type='button' " +
										"class='btn btn-warning btn-sm'" +
										"onClick='select_item("+element.supplier_id+",`"+element.company_name+"`,`"+element.supplier_code+"`)' "
										+">เลือก</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);

						var table = $('#table-supplier-modal').DataTable({
							data: dataSet,
  						deferRender : true,
							columns: [
									{ title: "รหัส" },
									{ title: "บริษัท" },
									//{ title: "ผู้ติดต่อ" },
									{ title: "#" },
							],
              "pageLength" : 3,
						});

            $('#table-supplier-modal').on( 'click', 'tr', function () {
                var d = table.row( this ).data();
                //console.log("ROW : ",d);

                var key = d[0];
                var table_detail = $('#table-order-detail').DataTable();
                table_detail.search(key).draw();
            } );
					}); //END AJAX
			}


      //detail
      //AJAX
      if(  ! $.fn.DataTable.isDataTable('#table-order-detail') ){
        $.ajax({
            url: "{{ url('/') }}/api/purchase/requisition_detail/index2",
            type: "GET",
            dataType : "json",
        }).done(function(result){
            //console.log(result);
            var dataSet = [];
            result.forEach(function(element,index) {
              //console.log(element,index);
              var id = element.requisition_detail_id;
              var row = [
                element.purchase_requisition_code,
                element.datetime,
                //element.delivery_time,
                element.supplier_code,
                element.company_name,
                element.product_code,
                element.product_name,
                element.amount,
                "<input name='approve_amounts[]' value='"+element.amount+"' class='form-control form-control-sm' style='max-width:40px;' required>",
                //0,
                //0,
                //0,
              ];
              dataSet.push(row);
            });
            //console.log(dataSet);

            var table_detail = $('#table-order-detail').DataTable({
              data: dataSet,
              columns: [
                  { title: "เลขที่ PR" },
                  { title: "วันที่ PR" },
                  //{ title: "วันที่ส่งของ" },
                  { title: "รหัสเจ้าหนี้" },
                  { title: "เจ้าหนี้" },
                  { title: "รหัสสินค้า" },
                  { title: "ชื่อสินค้า" },
                  { title: "จำนวน" },
                  { title: "จำนวนที่อนุมัติ" },
                  //{ title: "ค้างรับ" },
                  //{ title: "ค้างส่ง" },
                  //{ title: "จำนวนคงคลัง" },
              ],
              "pageLength" : 3,
            }); //END DATATABLE
            $('#table-order-detail input').attr("readonly",true);
            table_detail.search("*").draw();
          });//END DONE AJAX
        }
		}); // END MODAL EVENT
	});//END ADD EVENT LISTENER
</script>
