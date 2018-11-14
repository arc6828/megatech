<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#customerModal">
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
					<table class="table table-hover text-center" id="table-customer-modal" style="width:100%"></table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="outer-form-container" style="display:none;">
	<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			console.log("555");
      $.ajax({
          url: "{{ url('/') }}/api/customer",
          type: "GET",
          dataType : "json",
          success: function(result){
            console.log(result);
            var dataSet = [];
            result.forEach(function(element,index) {
              console.log(element,index);
              dataSet.push([
                element.customer_id,
                element.customer_name,
                element.company_name,
                "<button type='button' class='btn btn-warning btn-sm'>เลือก</button>",
              ]);
            });
            console.log(dataSet);

      			$('#table-customer-modal').DataTable({
              data: dataSet,
              columns: [
                  { title: "รหัสลูกหนี้" },
                  { title: "ชื่อลูกหนี้" },
                  { title: "บริษัท" },
                  { title: "#" },
              ]
            });

          }
      });

		});
	</script>
</div>
