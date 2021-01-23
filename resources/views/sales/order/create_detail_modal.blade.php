<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:1200px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการสินค้า</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

        <input hidden id="search_key" value="">
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
					url: "{{ url('/') }}/api/product?customer_id="+document.querySelector("#customer_id").value,
					type: "GET",
					dataType : "json",
			}).done(function(result){
					//console.log(result);
					var dataSet = prepareDataSet(result);
					//console.log(dataSet);
					var table = $('#table-product-model').DataTable({
						"data": dataSet,
						paging : false,
						info : false,
						
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
						"order": [[ 3, "desc" ]],
					}); // END DATATABLE
					//DATA TABLE SCROLL
					var tableCont = document.querySelector('#table-product-model');			
					tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";
					tableCont.parentNode.style.overflow = 'auto';
					tableCont.parentNode.style.maxHeight = '400px';
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
              $.ajax({
        					url: "{{ url('/') }}/api/product?q="+search_key+"&customer_id="+document.querySelector("#customer_id").value ,
        					type: "GET",
        					dataType : "json",
        			}).done(function(result1){
        					console.log(dataSet);
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
        element.BARCODE,
        element.product_name ,
        element.amount_in_stock,
        parseFloat(price).toFixed(2),
        "<input name='amount_create' id='amount_create"+id+"'  value='"+element.quantity+"' style='width:50px;' >",
        "<button type='button' json='"+JSON.stringify(element)+"' class='btn btn-success btn-create btn-sm' onclick='addProduct(this);'>" +
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

		var table = $('#table-order-detail').DataTable();
		let product_id = product.product_id;
		let customer_id = document.querySelector("#customer_id").value;
		let link = "{{ url('/') }}/api/order_detail/customer/"+customer_id+"/product/"+product_id;
		fetch(link)
			.then(response => response.json())
			.then(data => {
				console.log(link);
				console.log(data)
				if(data.discount_price){
					product["discount_price"] = data.discount_price
				}

				var row = createRow("+", product);
				table.row.add(row).draw( false );
				refreshDetailTableEvent();

				document.querySelector("#btn-close").click();
				//CLEAR SEARCH
				$('#table-product-model').DataTable()
					.search( '' )
					.columns().search( '' )
					.draw();
			});
		
		//console.log("CLICK");
	}
</script>
