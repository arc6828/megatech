<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" id="btn-district" data-toggle="modal" data-target="#districtModal" data-id="1">
	<i class="fa fa-plus"></i> เลือก district
</button>

<!-- Modal -->
<div class="modal fade" id="districtModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เลือก district</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
        <div>
          <select class="form-control form-control-sm" id="input_province" onchange="showAmphoes()">
            <option value="">กรุณาเลือกจังหวัด</option>
          </select>
        </div>
        <div>
          <select class="form-control form-control-sm"  id="input_amphoe" onchange="showDistricts()">
            <option value="">กรุณาเลือกอำเภอ</option>
          </select>
        </div>
        <div>
          <select class="form-control form-control-sm"  id="input_district" onchange="showZipcode()">
            <option value="">กรุณาเลือกตำบล</option>
          </select>
        </div>
        <div>
          <input class="form-control form-control-sm"  id="input_zipcode" placeholder="รหัสไปรษณีย์" />
        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="district-ok">Ok</button>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
  showProvinces();
  $("#district-ok").click(function(){
    console.log("CLICK");
    $('#districtModal').modal('hide')
    $("#districtModal").on("hidden.bs.modal",function(e){
      if(true) {
        $("#province").val($("#input_province option:selected").text());
        $("#district").val($("#input_amphoe option:selected").text());
        $("#sub_district").val($("#input_district option:selected").text());
        $("#zipcode").val($("#input_zipcode").val());
      }
    })
  });
});

function ajax(url, callback){
  $.ajax({
    "url" : url,
    "type" : "GET",
    "dataType" : "json",
  })
  .done(callback); //END AJAX
}

function showProvinces(){
  //PARAMETERS
  var url = "{{ url('/') }}/api/province";
  var callback = function(result){
    $("#input_province").empty();
    for(var i=0; i<result.length; i++){
      $("#input_province").append(
        $('<option></option>')
          .attr("value", ""+result[i].province_code)
          .html(""+result[i].province)
      );
    }
    showAmphoes();
  };
  //CALL AJAX
  ajax(url,callback);
}
function showAmphoes(){
  //INPUT
  var province_code = $("#input_province").val();
  //PARAMETERS
  var url = "{{ url('/') }}/api/province/"+province_code+"/amphoe";
  var callback = function(result){
    //console.log(result);
    $("#input_amphoe").empty();
    for(var i=0; i<result.length; i++){
      $("#input_amphoe").append(
        $('<option></option>')
          .attr("value", ""+result[i].amphoe_code)
          .html(""+result[i].amphoe)
      );
    }
    showDistricts();
  };
  //CALL AJAX
  ajax(url,callback);
}
function showDistricts(){
  //INPUT
  var province_code = $("#input_province").val();
  var amphoe_code = $("#input_amphoe").val();
  //PARAMETERS
  var url = "{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
  var callback = function(result){
    //console.log(result);
    $("#input_district").empty();
    for(var i=0; i<result.length; i++){
      $("#input_district").append(
        $('<option></option>')
          .attr("value", ""+result[i].district_code)
          .html(""+result[i].district)
      );
    }
    showZipcode();
  };
  //CALL AJAX
  ajax(url,callback);
}
function showZipcode(){
  //INPUT
  var province_code = $("#input_province").val();
  var amphoe_code = $("#input_amphoe").val();
  var district_code = $("#input_district").val();
  //PARAMETERS
  var url = "{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district/"+district_code;
  var callback = function(result){
    //console.log(result);
    for(var i=0; i<result.length; i++){
      $("#input_zipcode").val(result[i].zipcode);
    }
  };
  //CALL AJAX
  ajax(url,callback);
}
</script>
