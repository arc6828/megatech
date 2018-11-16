<div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">พนักงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-hover text-center" id="table-user-modal" style="width:100%"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>


  <div id="outer-form-container" style="display:none;">
      <script>
          document.addEventListener('DOMContentLoaded', function(event) {
              console.log('Test');

          $.ajax({
                  url: "{{ url('/') }}/api/user",
                  type: "GET",
                  dataType: "json",
                  success: function(res) {
                      console.log(res);
                      var dataSet = [];
                      res.forEach(function(element,index) {
                          console.log("element",element.id,"index",index);
                          dataSet.push([
                              element.id,
                              element.name,
                              "<button type='button' id='select' class='btn btn-warning btn-sm' onclick='select_user("+element.id+")' >เลือก </button>"
                          ]);
                          
                      });
                      console.log(dataSet);

                      $('#table-user-modal').DataTable({
                          data: dataSet,
                          columns: [
                          { title: "รหัสพนักงาน" },
                          { title: "ชื่อพนักงาน"},
                          { title: "action" },
                          ]
                      });

                  }
              });
          
          });
          function select_user(id) {
              console.log(id);
                  $('#user_id').val(id);
                  $('#exampleModal2').modal('hide');
          };
      </script>
  </div>