<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการสินค้า</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-product-model" width="100%"></table>
				</div>
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
		$('#exampleModal').on('show.bs.modal', function (e) {
			showProduct();
		}); // END MODAL EVENT

	}); //END ADD EVENT LISTENER

	function showProduct(){
		if(  ! $.fn.DataTable.isDataTable('#table-product-model') ){
			//setPreLoader(true);
			$.ajax({
					url: "{{ url('/') }}/api/product",
					type: "GET",
					dataType : "json",
			}).done(function(result){
					//console.log(result);

					var dataSet = [];
					result.forEach(function(element,index) {
						//console.log(element,index);
						var id = element.product_id;
						var price = element.promotion_price? element.promotion_price : element.normal_price;
						var row = [
							element.product_code,
							element.BARCODE,
							element.product_name + " / " + element.grade ,
							element.amount_in_stock,
							price,
							"<input name='amount_create' id='amount_create"+id+"'  value='"+element.quantity+"' style='width:50px;' >",
							"<button type='button' json='"+JSON.stringify(element)+"' class='btn btn-success btn-create btn-sm' onclick='addProduct(this);'>" +
								"<span class='fa fa-shopping-cart'></span>" +
							"</button>",
						];
						dataSet.push(row);
					});
					//console.log(dataSet);

					var table = $('#table-product-model').DataTable({
						"data": dataSet,
						"deferRender" : true,
						"columns": [
							{ title: "รหัสสินค้า" },
							{ title: "Barcode" },
							{ title: "ชื่อสินค้า" },
							{ title: "จำนวนในคลัง" },
							{ title: "ราคาขาย" },
							{ title: "จำนวน" },
							{ title: "action" },
						],
					}); // END DATATABLE
					//setPreLoader(false);


				}); //END AJAX
		}
	}

	function addProduct(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		product["amount"] = document.querySelector("#amount_create"+product.product_id).value;
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		console.log("CLICK PRODUCT : ", product);

		var table = $('#table-receive_temporary-detail').DataTable();
		var row = createRow("+", product);
		table.row.add(row).draw( false );
		refreshDetailTableEvent();
		document.querySelector("#btn-close").click();
		//console.log("CLICK");
	}
</script>
