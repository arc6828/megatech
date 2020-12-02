<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการสินค้า</h5>
				<button type="button" class="close" id="btn-close-product" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
        		<input hidden id="search_key" value="">
				<div class="table-responsive" id="table-container" >
					<table class="table table-hover text-center table-sm" id="table-product-model" style="width:100%; margin-top:-1px !important"  ></table>
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

		
		$('#exampleModal').on('shown.bs.modal', function (e) {
			showProduct();
		}); // END MODAL EVENT

	}); //END ADD EVENT LISTENER

	function showProduct(){
		if(  ! $.fn.DataTable.isDataTable('#table-product-model') ){
			//setPreLoader(true);

			//FETCHING
			fetch('{{ url('/') }}/api/product')
				.then(response => response.json())
				.then(result => {
					console.log(result)
					var table = $('#table-product-model').DataTable({
						"data": prepareDataSet(result),
						"deferRender" : true,
						"columns": [
							{ title: "รหัสสินค้า" },
							//{ title: "Barcode" },
							{ title: "ชื่อสินค้า" },
							// { title: "ราคาขาย" },
							{ title: "จำนวน" },
							{ title: "#คงเหลือ" },
							// { title: "#ค้างส่ง" },
							// { title: "#ค้างรับ" },
							// { title: "#คงเหลือ - ค้างส่ง" },
							{ title: "action" },
						],
						/*"scrollY": "250px",
						"scrollCollapse": true,*/
						"paging":         false,
						"order": [[ 4, "desc" ]],
					}); // END DATATABLE

					
					table.columns.adjust().draw();

					//DATA TABLE SCROLL
					var tableCont = document.querySelector('#table-product-model');
					tableCont.parentNode.style.overflow = 'auto';
					tableCont.parentNode.style.height = '500px';
					tableCont.parentNode.addEventListener('scroll',function (e){
						var scrollTop = this.scrollTop;
						this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 100 + 'px)';
						this.querySelector('thead').style.background = "white";
						this.querySelector('thead').style.zIndex = "3000";
						this.querySelector('thead').style.marginBottom = "100px";
						console.log(scrollTop);
					})
					//END DATA TABLE SCROLL


			
					table.on( 'search.dt', function () {
						var search_key = table.search();
						if(search_key != $('#search_key').val()){
							console.log("Hello",table.search() );

							fetch("{{ url('/') }}/api/product?q="+search_key)
								.then(response => response.json())
								.then(result1 => {
									// console.log(result1)
									$('#search_key').val(search_key);
									var new_data = prepareDataSet(result1);
									table.clear();
									table.rows.add(new_data); // Add new data
									table.columns.adjust().draw(); // Redraw the DataTable
								});		 //END FETCH SEARCHING			
						}
					} );
					
				}); //END FETCH FIRST TIME


			
		}
	}

	function prepareDataSet(result){
		var dataSet = [];
		result.forEach(function(element,index) {
		//console.log(element,index);
		var id = element.product_id;
		var price = parseFloat(element.promotion_price? element.promotion_price : element.normal_price).toFixed(2);
		var row = [
			element.product_code,
			//element.BARCODE,
			element.product_name ,
			// price,
			"<input name='amount_create' id='amount_create"+id+"'  value='"+element.quantity+"' style='width:50px;' >",
			element.amount_in_stock,
			// element.pending_in,
			// element.pending_out,
			// element.amount_in_stock - element.pending_out,
			"<button type='button' json='"+JSON.stringify(element)+"' class='btn btn-success btn-create btn-sm' onclick='addProduct(this);' style='position:static; will-change:unset;'>" +
			"<span class='fa fa-plus'></span>" +
			"</button>",
		];
		dataSet.push(row);
		});
		//console.log(dataSet);
		return dataSet;
	}

	function addProduct(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		product["amount"] = document.querySelector("#amount_create"+product.product_id).value;
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product);

		var table = $('#table').DataTable();
		var row = createRow(product);
		table.row.add(row).draw( false );
		//refreshDetailTableEvent();
		document.querySelector("#btn-close-product").click();
		//console.log("CLICK");
	}
</script>
