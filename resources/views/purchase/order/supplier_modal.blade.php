<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#supplierModal">
	<i class="fa fa-plus"></i> เลือกเจ้าหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เลือกเจ้าหนี้</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-supplier-modal" style="width:100%"></table>
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
					$('#supplier_id').val(id);
					$('#company_name').val(name);
					$('#supplier_code').text(code);
					$('#supplierModal').modal('hide');
					onChangeCustomer();
	}
	document.addEventListener("DOMContentLoaded", function(event) {
		//console.log("555");
		//AJAX
		$('#supplierModal').on('show.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-supplier-modal') ){
				$.ajax({
	          url: "{{ url('/') }}/api/supplier",
	          type: "GET",
	          dataType : "json",
	      }).done(function(result){
						//console.log(result);
						var dataSet = [];
						result.forEach(function(element,index) {
							//console.log(element,index);
							var row = [
								element.supplier_code,
								element.company_name,
								//element.contact_name,
								"<button type='button' " +
										"class='btn btn-warning btn-sm'" +
										"onClick='select_item("+element.supplier_id+",`"+element.company_name+"`,`"+element.supplier_code+"`)' "
										+">เลือก</button>",
							];
							dataSet.push(row);
						});
						//console.log(dataSet);

						$('#table-supplier-modal').DataTable({
							data: dataSet,
  						deferRender : true,
							columns: [
									{ title: "รหัส" },
									{ title: "บริษัท" },
									//{ title: "ผู้ติดต่อ" },
									{ title: "#" },
							]
						});
					}); //END AJAX
			}
		}); // END MODAL EVENT
	});//END ADD EVENT LISTENER
</script>
