<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm d-none" id="btn-ref-order" data-toggle="modal" data-target="#orderModal">
	<i class="fa fa-plus"></i> อ้างอิงจากใบจอง
</button>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">อ้างอิงจากใบจอง</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center" id="table-order-model"></table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-order">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		//var detail = JSON.parse('@json($table_product)');
		$('#orderModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-order-model') ){
				$.ajax({
	          url: "{{ url('/') }}/api/order",
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						//console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							console.log(element,index);
							var id = element.order_id;
							//var price = element.promotion_price? element.promotion_price : element.normal_price;
							var row = [
								element.order_code,
								element.datetime,
								element.total,
								element.customer_code,
								element.company_name,
								element.name,
								element.sales_status_name,
								"<button type='button' class='btn btn-warning btn-create' onclick='fillInvoice("+id+");'>" +
									"<span class='fa fa-shopping-cart'></span>" +
								"</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);
						var table = $('#table-order-model').DataTable({
							"data": dataSet,
							"columns": [
								{ title: "เลขที่เอกสาร" },
								{ title: "วันที่" },
								{ title: "ยอดรวม" },
								{ title: "รหัสลูกค้า" },
								{ title: "ชื่อบริษัท" },
								{ title: "รหัสพนักงาน" },
								{ title: "สถานะ" },
								{ title: "action" },
							],
						}); // END DATATABLE
					}); //END AJAX
			}
		}); // END MODAL EVENT

	}); //END ADD EVENT LISTENER

	function fillInvoice(order_id){
		console.log(order_id);
		$.ajax({
				url: "{{ url('/') }}/api/order/"+order_id,
				type: "GET",
				dataType : "json",
		}).done(function(result){
			fillOrder(result);
			fillOrderDetail(result);
			//ALL ABOUT EVENT
			refreshDetailTableEvent();
			//AVOID TO EDIT
			$('#table-invoice-detail input').prop('readonly', true);

		}); //END AJAX

		document.querySelector("#btn-close-order").click();

	}
	function fillOrder(result){
		var element = result.table_order[0];

		//document.querySelector("#invoice_code").value = element.invoice_code ;
		document.querySelector("#internal_reference_id").value = element.order_code ;
		document.querySelector("#external_reference_id").value = element.external_reference_id;
		document.querySelector("#customer_id").value = element.customer_id;
		document.querySelector("#contact_name").value = element.contact_name;
		var str_time = moment(element.datetime).format('YYYY-MM-DDTHH:mm');  //console.log(str_time);
		var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
		document.querySelector("#debt_duration").value = element.debt_duration;
		document.querySelector("#billing_duration").value = element.billing_duration ;
		document.querySelector("#payment_condition").value = element.payment_condition ;
		document.querySelector("#delivery_type_id").value = element.delivery_type_id ;
		document.querySelector("#tax_type_id").value = element.tax_type_id ;
		document.querySelector("#delivery_time").value = element.delivery_time;
		document.querySelector("#department_id").value = element.department_id ;
		document.querySelector("#sales_status_id").value = element.sales_status_id ;
		document.querySelector("#user_id").value = element.user_id ;
		document.querySelector("#zone_id").value = element.zone_id ;
		document.querySelector("#total").value = element.total ;
		document.querySelector("#remark").value = element.remark ;
		document.querySelector("#vat_percent").value = element.vat_percent;

		onChange(document.querySelector("#vat_percent"));

	}
	function fillOrderDetail(result){
		//console.log(result);
		var dataSet = [];
		result.table_order_detail.forEach(function(element,index) {
			var id = element.order_detail_id;
			console.log("ELEMENT id : ",id,element);
			var row = createRow(id, element);
			dataSet.push(row);
		});
		//console.log(dataSet);
		var table = $('#table-invoice-detail').DataTable();
		table
				.clear()
				.rows.add(dataSet)
				.draw();
	}
</script>
