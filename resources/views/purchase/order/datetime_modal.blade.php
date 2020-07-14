<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#datetimeModal">กำหนดเอง</button>
<!-- Modal -->
<div class="modal fade" id="datetimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="datetimeModalLabel">กำหนดวันที่ใหม่</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="datetime_custom" name="datetime_custom" value="" type="date" class="form-control formcontrol-sm" 
            onchange="onChangeDate(this);">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function onChangeDate(e)
{
    //var m = moment().set({'year': 2013, 'month': 3, 'date' : 8});
    
    var d = new Date(e.value);
    console.log({'year': d.getFullYear(), 'month': d.getMonth(), 'date' : d.getDate()});
    var m = moment().set({'year': d.getFullYear(), 'month': d.getMonth(), 'date' : d.getDate()});
    var str_time = m.format('DD MMM YYYY - HH:mm:ss');  //console.log(str_time);
    var dateControl = document.querySelector('#datetime').value = str_time;  //dateControl.value = '2017-06-01T08:30';
    $('#datetimeModal').modal('hide')
}
</script>