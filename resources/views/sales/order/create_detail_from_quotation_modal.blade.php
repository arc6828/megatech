<!-- Button trigger modal -->
<button type="button" class="btn btn-warning  d-none" data-toggle="modal" data-target="#quotationModal" id="btn-ref-quotation">
	<i class="fa fa-plus"></i> อ้างอิงจากใบเสนอราคา
</button>

<!-- Modal -->
<div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:1140px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">อ้างอิงจากใบเสนอราคา</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<table width="100%" class="table table-hover text-center table-sm" id="table-product-quotation-model"></table>

        <div class="text-center">
          <button type="button"
                  class="btn btn-warning"  id="btn-add-products"
                  onclick="addAllProduct();"
                  data-dismiss="modal"
                  >
            <span class='fa fa-shopping-cart'> เพิ่มรายการสินค้า</span>
          </button>
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


		$('#quotationModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-product-quotation-model') ){
				var customer_id = $("#customer_id").val();
				var user_id = "{{ Auth::user()->id }}";
				console.log("URL : ","{{ url('/') }}/api/quotation_detail/customer/"+customer_id+"/user/"+user_id);
				$.ajax({
	          url: "{{ url('/') }}/api/quotation_detail/customer/"+customer_id+"/user/"+user_id,
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							var id = element.quotation_detail_id;
							var row = createRow2(id, element);
							dataSet.push(row);
							//

						});
						//console.log(dataSet);
						var table = $('#table-product-quotation-model').DataTable({
							"data": dataSet,
							"deferRender" : true,
							"columns": [
									{ title: "#" },
									{ title: "QT" },
									{ title: "รหัสสินค้า" },
									{ title: "ชื่อสินค้า" },
									{ title: "จำนวน" },
									//{ title: "หน่วย" },
									{ title: "ราคาตั้ง" },
									{ title: "ส่วนลด %" },
									{ title: "ราคาขาย" },
									{ title: "ราคาขายรวม" },
									//{ title: "action" },
							],
						}).order( [ 1, 'desc' ] ).draw(); // END DATATABLE
            var quotation_code = "{{ request('quotation_code') }}";
            $('#table-product-quotation-model').DataTable().search(quotation_code).draw();
            //IF QUOTATION CODE EXIST
            onSelectAllItem();
					}); //END AJAX
			}
		}); // END MODAL EVENT

		$('#quotationModal').on('hidden.bs.modal', function (e) {
			// do something...
			//GET CUSTOMER ID
			let customer_id = document.querySelector("#customer_id").value;
			//FETCH 			
			let url = 'http://localhost/megatech/public/api/delivery_temporary_detail/customer/'+customer_id;
			console.log(url);
			fetch(url)
				.then(response => response.json())
				.then(data => {
					if(data.length > 0){
						alert("ค้างใบยืม โปรดตรวจสอบใบยืม");
						
						document.querySelector("#btn-ref-dt").click();
						
						//setTimeout(function(){ displayDT(); }, 3000);
						
					}
				});
		})

	}); //END ADD EVENT LISTENER



	function createRow2(id,element){
		return [
			"<input class='check' type='checkbox' value='"+id+"'>"+"<input type='hidden' class='id_edit' name='id_edit2[]'  value='"+id+"' >",

      element.quotation_code ,

			element.product_code+"<input type='hidden' class='product_id_edit' name='product_id_edit2[]'  value='"+element.product_id+"' >",
			element.product_name ,
			"<input class='input amount_edit' name='amount_edit2[]' id='amount_edit2'  value='"+element.amount+"' disabled>",
			"<input class='input normal_price_edit' name='normal_price_edit2[]'  value='"+parseFloat(element.normal_price).toFixed(2)+"' disabled>",
			"<input type='number' step='any' class='input discount_percent_edit' name='discount_percent_edit2[]' max='"+element.max_discount_percent+"'  value='"+(100 - element.discount_price / element.normal_price * 100)+"' disabled>",
			"<input class='input discount_price_edit' name='discount_price_edit2[]'  value='"+parseFloat(element.discount_price).toFixed(2)+"' disabled>",
			"<input class='input total_edit' name='total_edit2[]'  value='"+(element.discount_price *  element.amount)+"' disabled>"+
			"<button type='button' id='btn-add-"+id+"' json='"+JSON.stringify(element)+"' class='btn btn-warning btn-create btn-sm class d-none' onclick='addProduct2(this);'>" +
				"<span class='fa fa-shopping-cart'></span>" +
			"</button>",
		];
	}

	function addProduct(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		//product["amount"] = 1;
		var amount_obj = document.querySelector("#amount_create"+product.product_id).value;
		/*if(amount_obj !== null){
			product["amount"] = amount_obj.value;
		}*/
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product, amount);

		var table = $('#table-order-detail').DataTable();
		var row = createRow("+", product);
		table.row.add(row).draw( false );
		refreshDetailTableEvent();
		document.querySelector("#btn-close-quotation").click();
		//console.log("CLICK");
	}

	function addProduct2(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		//product["amount"] = 1;

		var amount_obj = 1;

		product["discount_price"] = product.discount_price? product.discount_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product, amount);

		var table = $('#table-order-detail').DataTable();
		var row = createRow("+", product);
		table.row.add(row).draw( false );
		refreshDetailTableEvent();

		//document.querySelector("#btn-close-quotation").click();
		//console.log("CLICK");
	}

  function addAllProduct(){
    $("input.check:checked").each(function(){
      var id = $(this).val();
      $("#btn-add-"+id).click();
    });


    document.querySelector("#btn-close-quotation").click();

  }



</script>
