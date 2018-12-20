<div class="card" id="table">
	<div class="card-block">
		<style>
		.input{
			max-width: 50px;
			width: 100%;
		}
		</style>

		<div class="table-responsive">
			<table class="table table-hover text-center" id="table-quotation-detail" style="width:100%"></table>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
			 	var detail = JSON.parse('@json($table_quotation_detail)');
				//console.log("DETAIL : ",detail);
				var dataSet = [];
				detail.forEach(function(element,index) {
					//console.log(element,index);
					var id = element.quotation_detail_id;
					var row = [
						id,
						element.product_code,
						element.product_name,
						"<input class='input' name='amount_edit'  value='"+element.amount+"' >",
						element.product_unit,
						"<input class='input' name='normal_price_edit'  value='"+element.normal_price+"' disabled>",
						"<input class='input' name='discount_percent_edit'  value='"+(100 - element.discount_price / element.normal_price * 100)+"'>",
						"<input class='input' name='discount_price_edit'  value='"+element.discount_price+"'>",
						"<input class='input' name='total_edit'  value='"+(element.discount_price *  element.amount)+"' disabled>",
						"<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' >" +
							"<span class='fa fa-trash'></span>" +
						"</a>",
					];
					dataSet.push(row);
				});
				//console.log(dataSet);

				$('#table-quotation-detail').DataTable({
					"data": dataSet,
					"columns": [
							{ title: "#" },
							{ title: "รหัสสินค้า" },
							{ title: "ชื่อสินค้า" },
							{ title: "จำนวน" },
							{ title: "หน่วย" },
							{ title: "ราคาตั้ง" },
							{ title: "ส่วนลด %" },
							{ title: "ราคาขาย" },
							{ title: "ราคาขายรวม" },
							{ title: "action" },
					],
					"fnCreatedRow" : function( nRow, aData, iDataIndex ) {
						//console.log("aData : ", aData, iDataIndex);
			      $(nRow).attr('id', "row-"+aData[0]);
			    },
				}); //END DataTable

				//EVENT HANDLER

				//ON CHANGE + ON KEYUP
				document.querySelectorAll(".input").forEach(function(element,index){
					element.addEventListener("change", function(event){
						//console.log("CHANGE : ", this,this.getAttribute("data_id"));
					  onChange3(this);
					});
					element.addEventListener("keyup", function(){
					  onChange3(this);
					});
				}); //END foreach
				function onChange3(obj){
					//var row = document.querySelector("#row-"+id);
					var row = $(obj).parents('tr')[0];
					var discount_price_edit = row.querySelector("input[name='discount_price_edit']");
					var discount_percent_edit = row.querySelector("input[name='discount_percent_edit']");
					var normal_price_edit = row.querySelector("input[name='normal_price_edit']");
					var total_edit = row.querySelector("input[name='total_edit']");
					var amount_edit = row.querySelector("input[name='amount_edit']");
					//console.log("DOM : ",obj);
					//var btn_submit = row.querySelector("input[name='new_btn_submit']");
					//console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
					switch (obj.name) {
						case "discount_percent_edit":
							//EFFECT TO #discount_price_edit
							//console.log("EFFECT TO #discount_price_edit");
							discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (discount_percent_edit.value) / 100;

							break;
						case "discount_price_edit":
							//EFFECT TO #discount_percent_edit
							discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
							break;
					}
					//EFFECT TO #total_edit
					total_edit.value = amount_edit.value * discount_price_edit.value;
					//console.log(obj.value, obj.id);
				}

				//ON DELETION
				addClickEventToDelete();

				//removeClickEventToDelete();



			});//END DOMContentLoaded

			function addClickEventToDelete(){
				document.querySelectorAll(".btn-delete-detail").forEach(function(element,index){
					element.addEventListener("click", myFunction,true);
				}); //END foreach
			}
			function removeClickEventToDelete(){
				document.querySelectorAll(".btn-delete-detail").forEach(function(element,index){
					element.removeEventListener("click", myFunction,true);
				}); //END foreach
			}
			function myFunction(event){
				//console.log("CHANGE : ", this,this.getAttribute("data_id"));
				//onChange3(this,this.getAttribute("data_id"));
				var want_to_delete = confirm('Are you sure to delete this quotation detail?');
				if(want_to_delete){
					var table = $('#table-quotation-detail').DataTable();
					table
						.row( $(this).parents('tr') )
						.remove()
						.draw();
				}
			}
		</script>

		<div class="text-center">

			@include('sales/quotation_detail/create_modal')

		</div>
	</div>
</div>
