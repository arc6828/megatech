<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i> รหัสลูกค้า
 </button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ลูกค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-hover text-center" id="table-customer-modal" style="width:100%"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <div id="outer-form-container" style="display:none;">
      <script>
          document.addEventListener('DOMContentLoaded', function(event) {
          $.ajax({
                  url: "{{ url('/') }}/api/customer",
                  type: "GET",
                  dataType: "json",
                  success: function(res) {
                      var dataSet = [];
                      res.forEach(function(element,index) {
                
                          dataSet.push([
                              element.customer_id,
                              element.company_name,
                              "<button type='button' id='select' class='btn btn-warning btn-sm' onclick='select_customer("+element.customer_id+")' >เลือก </button>"
                          ]);

                      });
                      console.log(dataSet);

                      $('#table-customer-modal').DataTable({
                          data: dataSet,
                          columns: [
                          { title: "รหัสลูกค้า" },
                          { title: "ชื่อบริษัท"},
                          { title: "action" },
                          ]
                      });

                  }
              });

          });
          function select_customer(id) {
                  $('#customer_id').val(id);
                  $('#exampleModal').modal('hide');
          };
      </script>
  </div>
