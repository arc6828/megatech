<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i> รหัสผังบัญชี
      </button> --}}
      
      <!-- Modal -->
      {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
        <div class="modal-dialog" role="document" id="dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">บัญชี</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover text-center" id="table-account-modal" style="width:100%"></table>
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
                        url: "{{ url('/') }}/api/account",
                        type: "GET",
                        dataType: "json",
                        success: function(res) {
                            console.log(res);
                            var dataSet = [];
                            res.forEach(function(element,index) {
                                console.log("element",element,"index",index);
                                dataSet.push([
                                    element.id_account,
                                    element.note_account,
                                    "<button type='button' id='select' class='btn btn-warning btn-sm' onclick='select_values("+element.id_account+",`"+element.note_account+"`)' >เลือก </button>"
                                ]);
                                
                            });
                            console.log(dataSet);

                            $('#table-account-modal').DataTable({
                                data: dataSet,
                                columns: [
                                { title: "รหัสผังบัญชี" },
                                { title: "รายละเอียด"},
                                { title: "action" },
                                ]
                            });

                        }
                    });
                
                });
                function select_values(id , name) {
                        $('#account_id').val(id);
                        $('#exampleModal').modal('hide');
                };
            </script>
        </div>