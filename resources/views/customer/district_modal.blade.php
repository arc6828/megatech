<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" id="btn-district" data-toggle="modal" data-target="#districtModal" data-id="1">
    <i class="fa fa-plus"></i> เลือก district
</button>
<input type="hidden" id="type_address"  value="true">

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
        <div class="form-group">
            <select class="form-control form-control-sm" id="input_province" onchange="showAmphoes()"></select>
        </div>
        <div class="form-group">
            <select class="form-control form-control-sm"  id="input_amphoe" onchange="showDistricts()"></select>
        </div>
        <div class="form-group">
            <select class="form-control form-control-sm"  id="input_district" onchange="showZipcode()"></select>
        </div>
        <div class="form-group">
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
        var type_address =  $("#type_address").val();
        if(type_address === "true") {
        $("#province").val($("#input_province option:selected").text());
        $("#district").val($("#input_amphoe option:selected").text());
        $("#sub_district").val($("#input_district option:selected").text());
        $("#zipcode").val($("#input_zipcode").val());
        }else{
        $("#delivery_province").val($("#input_province option:selected").text());
        $("#delivery_district").val($("#input_amphoe option:selected").text());
        $("#delivery_sub_district").val($("#input_district option:selected").text());
        $("#delivery_zipcode").val($("#input_zipcode").val());
        }
    })
    });
});

function showProvinces(){
    fetch("{{ url('/') }}/api/province")
        .then(response => response.json())
        .then(data => {
            console.log('Success Province :', data);
            $("#input_province").empty();
            data.forEach(function(item){
                $("#input_province").append(
                    $('<option></option>').attr("value", ""+item.province_code).html(""+item.province)
                );
            });            
            showAmphoes();
        });    
}
function showAmphoes(){
    //INPUT
    var province_code = $("#input_province").val();
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe")
        .then(response => response.json())
        .then(data => {
            console.log('Success Amphoe :', data);
            $("#input_amphoe").empty();
            data.forEach(function(item){
                $("#input_amphoe").append(
                    $('<option></option>').attr("value", ""+item.amphoe_code).html(""+item.amphoe)
                );
            });                        
            showDistricts();
        });     
}
function showDistricts(){
    //INPUT
    var province_code = $("#input_province").val();
    var amphoe_code = $("#input_amphoe").val();
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district")
        .then(response => response.json())
        .then(data => {
            console.log('Success District :', data);
            $("#input_district").empty();
            data.forEach(function(item){
                $("#input_district").append(
                    $('<option></option>').attr("value", ""+item.district_code).html(""+item.district)
                );
            });                        
            showZipcode();
        });         
}
function showZipcode(){
    //INPUT
    var province_code = $("#input_province").val();
    var amphoe_code = $("#input_amphoe").val();
    var district_code = $("#input_district").val();
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district/"+district_code)
        .then(response => response.json())
        .then(data => {
            console.log('Success Zip ocd:', data);
            $("#input_zipcode").empty();
            data.forEach(function(item){
                $("#input_zipcode").val(item.zipcode);
            });              
        });       
}
</script>
