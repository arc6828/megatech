<!-- Deplicated -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quotationModal">
	<i class="fa fa-plus"></i> อ้างอิงจากใบเสนอราคา
</button>

<!-- Modal -->
<div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">อ้างอิงจากใบเสนอราคา</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-product-quotation-model"></table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-quotation">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		//var detail = JSON.parse('@json($table_product)');
		$('#quotationModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-product-quotation-model') ){
				$.ajax({
	          url: "{{ url('/') }}/api/product",
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						//console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							console.log(element,index);
							var id = element.product_id;
							var price = element.promotion_price? element.promotion_price : element.normal_price;
							var row = [
								element.product_code,
								element.product_name,
								element.amount_in_stock,
								price,
								"<input class='input' name='amount_create' id='amount_create"+id+"'  value='1' >",
								"<button type='button' json='"+JSON.stringify(element)+"' class='btn btn-sm btn-warning btn-create' onclick='addProduct(this);'>" +
									"<span class='fa fa-shopping-cart'></span>" +
								"</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);
						var table = $('#table-product-quotation-model').DataTable({
							"data": dataSet,
							"columns": [
								{ title: "รหัสสินค้า" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวนในคลัง" },
								{ title: "ราคาขาย" },
								{ title: "จำนวน" },
								{ title: "action" },
							],
						}); // END DATATABLE
					}); //END AJAX
			}
		}); // END MODAL EVENT

	}); //END ADD EVENT LISTENER

	function addProduct(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		product["amount"] = document.querySelector("#amount_create"+product.product_id).value;
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product, amount);

		var table = $('#table-purchase_requisition-detail').DataTable();
		var row = createRow("new", product);
		table.row.add(row).draw( false );
		refreshDetailTableEvent();
		document.querySelector("#btn-close-quotation").click();
		//console.log("CLICK");
	}
</script>
