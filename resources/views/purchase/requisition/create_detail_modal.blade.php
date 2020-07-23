<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
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
					<table width="100%" class="table table-hover text-center table-sm" id="table-product-model"></table>
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
			$.ajax({
					url: "{{ url('/') }}/api/product",
					type: "GET",
					dataType : "json",
			}).done(function(result){
					//console.log(result);
					var dataSet = prepareDataSet(result);
					//console.log(dataSet);
					var table = $('#table-product-model').DataTable({
						"data": dataSet,
						"columns": [
							{ title: "รหัสสินค้า" },
							{ title: "ชื่อสินค้า" },
							{ title: "จำนวนในคลัง" },
							{ title: "ราคาขาย" },
							{ title: "จำนวน" },
							{ title: "action" },
						],
						"order": [[ 2, "desc" ]],
					}); // END DATATABLE
          table.on( 'search.dt', function () {
            var search_key = table.search();
            if(search_key != $('#search_key').val()){
              console.log("Hello",table.search() );
              $.ajax({
        					url: "{{ url('/') }}/api/product?q="+search_key ,
        					type: "GET",
        					dataType : "json",
        			}).done(function(result1){
        					//console.log(dataSet);
                  $('#search_key').val(search_key);
                  var new_data = prepareDataSet(result1);
                  table.clear();
                  table.rows.add(new_data); // Add new data
                  table.columns.adjust().draw(); // Redraw the DataTable
              });
            }
          } ); // END SEARCH


				}); //END AJAX
		}
	}

  function prepareDataSet(result){
    var dataSet = [];
    result.forEach(function(element,index) {
      //console.log(element,index);
      var id = element.product_id;
      var price = element.promotion_price? element.promotion_price : element.normal_price;
      var row = [
        element.product_code,
        element.product_name,
        element.amount_in_stock,
        price,
        "<input class='input' name='amount_create' id='amount_create"+id+"'  value='1' >",
        "<button type='button' json='"+JSON.stringify(element)+"' class='btn btn-sm btn-success btn-create' onclick='addProduct(this);'>" +
          "<span class='fa fa-plus'></span>" +
        "</button>",
      ];
      dataSet.push(row);
    });
    console.log(dataSet);
    return dataSet;
  }

	function addProduct(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		product["amount"] = document.querySelector("#amount_create"+product.product_id).value;
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product, amount);

		var table = $('#table-purchase_requisition-detail').DataTable();
		var row = createRow("new", product);
		table.row.add(row).draw( false );
		refreshDetailTableEvent();
		document.querySelector("#btn-close").click();
		//console.log("CLICK");
	}
</script>
