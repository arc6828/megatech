class District {

  ajax(url, callback){
    $.ajax({
      "url" : url,
      "type" : "GET",
      "dataType" : "json",
    })
    .done(callback); //END AJAX
  }

  showProvinces(){
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
  showAmphoes(){
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
  showDistricts(){
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
  showZipcode(){
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


}
