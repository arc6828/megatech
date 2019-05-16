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
			//console.log(id);
					$('#customer_id').val(id);
					$('#company_name').val(name);
					$('#customer_code').text(code);
					$('#customerModal').modal('hide');

          //set search

          $('#table-customer-modal').DataTable().search(code).draw();
					onChangeCustomer();
	}
	document.addEventListener("DOMContentLoaded", function(event) {
		//console.log("Cumtomer 555");
		//AJAX
		$('#customerModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-customer-modal') ){
        var user_id = "{{ Auth::id() }}"
				$.ajax({
	          url: "{{ url('/') }}/api/customer?user_id="+user_id,
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
								//element.contact_name,
								"<button type='button' " +
										"class='btn btn-warning btn-sm'" +
										"onClick='select_item("+element.customer_id+",`"+element.company_name+"`,`"+element.customer_code+"`)' "
										+">เลือก</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);

						$('#table-customer-modal').DataTable({
							data: dataSet,
							columns: [
									{ title: "รหัส" },
									{ title: "บริษัท" },
									//{ title: "ผู้ติดต่อ" },
									{ title: "#" },
							]
						});
            $('#table-customer-modal').DataTable().search($("#customer_code").text()).draw();
					}); //END AJAX

			}
		}); // END MODAL EVENT
	});//END ADD EVENT LISTENER
</script>