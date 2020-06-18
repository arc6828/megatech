<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#customerModal">
	<i class="fa fa-plus"></i> เลือกลูกหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เลือกลูกหนี้</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-customer-modal" style="width:100%"></table>
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
					$('#customer_id').val(id);
					$('#contact_name').val(name);
					$('#customer_code').val(code);
					$('#customerModal').modal('hide');
					fillCustomer(id);
	}

  function fillCustomer(id){
		//console.log(order_id, "{{ url('/') }}/api/order/"+order_id);
		$.ajax({
				url: "{{ url('/') }}/api/customer/"+id,
				type: "GET",
				dataType : "json",
		}).done(function(result){
      console.log("Customer RESULT : " , result)
			//fillOrder(result);
			//fillOrderDetail(result);
			//ALL ABOUT EVENT
			//refreshDetailTableEvent();
			//AVOID TO EDIT
			//$('#table-invoice-detail input').prop('readonly', true);

      var element = result[0];

  		//document.querySelector("#invoice_code").value = element.invoice_code ;
  		//document.querySelector("#internal_reference_id").value = element.order_code ;
  		//document.querySelector("#external_reference_id").value = element.external_reference_id;
  		document.querySelector("#customer_id").value = element.customer_id;
  		document.querySelector("#customer_code").innerHTML = element.customer_code;
  		document.querySelector("#company_name").value = element.company_name;


  		//document.querySelector("#contact_name").value = element.contact_name;
  		//var str_time = moment(element.datetime).format('YYYY-MM-DDTHH:mm');  //console.log(str_time);
  		//var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
  		/*
		  document.querySelector("#debt_duration").value = element.debt_duration;
  		document.querySelector("#billing_duration").value = element.billing_duration ;
  		document.querySelector("#payment_condition").value = element.payment_condition ;
  		document.querySelector("#delivery_type_id").value = element.delivery_type_id ;
  		document.querySelector("#tax_type_id").value = element.tax_type_id ;
  		document.querySelector("#delivery_time").value = element.delivery_time;
  		//document.querySelector("#department_id").value = element.department_id ;
  		document.querySelector("#purchase_status_id").value = 1 ;
		  */
		  document.querySelector("#debt_duration").value = "0";
  		document.querySelector("#billing_duration").value = "0";
  		document.querySelector("#payment_condition").value = "0";
  		document.querySelector("#delivery_type_id").value = 1;
  		document.querySelector("#tax_type_id").value = 2 ;
  		document.querySelector("#delivery_time").value = "0";
  		//document.querySelector("#department_id").value = element.department_id ;
  		document.querySelector("#purchase_status_id").value = 1 ;
  		//document.querySelector("#user_id").value = element.user_id ;
  		//document.querySelector("#zone_id").value = element.zone_id ;
  		//document.querySelector("#total").value = element.total ;
  		//document.querySelector("#remark").value = element.remark ;
  		//document.querySelector("#vat_percent").value = element.vat_percent;

		}); //END AJAX

		//document.querySelector("#btn-close-order").click();

	}

	document.addEventListener("DOMContentLoaded", function(event) {
		//console.log("555");
		//AJAX
		$('#customerModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-customer-modal') ){
				$.ajax({
	          url: "{{ url('/') }}/api/customer",
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						//console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							//console.log(element,index);
							var row = [
								element.customer_code,
								element.company_name,
								element.contact_name,
								"<button type='button' " +
										"class='btn btn-success btn-sm'" +
										"onClick='select_item("+element.customer_id+",`"+element.contact_name+"`,`"+element.customer_code+"`)' "
										+">เลือก</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);

						$('#table-customer-modal').DataTable({
							data: dataSet,
  						deferRender : true,
							columns: [
									{ title: "รหัส" },
									{ title: "บริษัท" },
									{ title: "ผู้ติดต่อ" },
									{ title: "#" },
							]
						});
					}); //END AJAX
			}
		}); // END MODAL EVENT
	});//END ADD EVENT LISTENER
</script>
