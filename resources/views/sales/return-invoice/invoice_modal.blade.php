<!-- Button trigger modal -->
<style>

.modal-xl {
    max-width: 1140px;

}
</style>
<button type="button" class="btn btn-warning btn-sm d-none" id="btn-invoice-modal" data-toggle="modal" data-target="#invoice-modal" customer_code="">
	<i class="fa fa-plus"></i> อ้างอิงจาก invoice
</button> 

<!-- Modal -->
<div class="modal fade" id="invoice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document" style="max-width:90% !important; width:90% !important">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">อ้างอิงจากใบจอง</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="mt--5 modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-invoice-model" style="width:100%"></table>
				</div>
        		
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-order">Close</button>
			</div>
		</div>
	</div>
</div>
<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    /*-webkit-appearance: none;
    margin: 0;*/
  }

  /* Firefox */
  input[type=number] {
    /*-moz-appearance: textfield;*/
  }

  td,th{
    padding-left : 0.25rem !important;
    padding-right : 0.25rem !important;
  }
</style>


<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		
		$('#invoice-modal').on('show.bs.modal', function (e) {
			let customer_id = $('#customer_id').val();

			let url = "{{ url('/') }}/api/invoice?customer_id="+customer_id;
			
			console.log("customer_id  : ", customer_id,url);

			fetch(url)
				.then(response => response.json())
				.then(result => {
					console.log(result)
					//console.log(result);
					var dataSet = [];
					result.forEach(function(element,index) {
						//console.log(element,index);
						var id = element.order_id;
						//var price = element.promotion_price? element.promotion_price : element.normal_price;
						var row = [
							element.invoice_code,
							element.datetime,
							Number(element.total).toLocaleString(),
							element.customer_code,
							//element.company_name,
							//element.short_name,
							//element.sales_status_name,
							"<a  class='btn btn-success btn-create btn-sm' href='{{ url('sales/return-invoice/create?search=') }}"+element.invoice_code+"'>" +
							"<span class='fa fa-shopping-cart'></span>" +
							"</a>",
						];
						//if(element.order_detail_status_id == 1){ //อนุมัติ
							dataSet.push(row);
						//}
					});
					//console.log(dataSet);
					var table;
					if(  ! $.fn.DataTable.isDataTable('#table-invoice-model') ){
						var table = $('#table-invoice-model').DataTable({
							"data": dataSet,
							"columns": [
							{ title: "เลขที่เอกสาร" },
							{ title: "วันที่" },
							{ title: "ยอดรวม" },
							{ title: "รหัสลูกค้า" },
							//{ title: "ชื่อบริษัท" },
							//{ title: "รหัสพนักงาน" },
							//{ title: "สถานะ" },
							{ title: "action" },
							],
							"pageLength" : 3,
						}).order( [ 0, 'desc' ] ).draw();
					}else{
						table = $('#table-invoice-model').DataTable();
					}
					//table.search(customer_code).draw();// END DATATABLE


					

				});


			


			
		}); // END MODAL EVENT
	}); //END ADD EVENT LISTENER

	
</script>
