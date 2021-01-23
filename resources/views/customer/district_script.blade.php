<script>
var elements = {
    "address" : {
        "province" : "#province",
        "district" : "#district",
        "sub_district" : "#sub_district",
        "zipcode" : "#zipcode"
    }, 
    "delivery_address" : {
        "province" : "#delivery_province",
        "district" : "#delivery_district",
        "sub_district" : "#delivery_sub_district",
        "zipcode" : "#delivery_zipcode"
    }, 
};
document.addEventListener("DOMContentLoaded", function(event) {
    var customer_address = null;
    var customer_delivery_address = null;

    
    @if(isset($customer))
        customer_address = {
            "province" : "{{ $row->province }}",
            "district" : "{{ $row->district }}",
            "sub_district" : "{{ $row->sub_district }}",
            "zipcode" : "{{ $row->zipcode }}",
        };
        customer_delivery_address = {
            "province" : "{{ $row->delivery_province }}",
            "district" : "{{ $row->delivery_district }}",
            "sub_district" : "{{ $row->delivery_sub_district }}",
            "zipcode" : "{{ $row->delivery_zipcode }}",
        };        
    @endif
    showProvinces("address", customer_address);
    showProvinces("delivery_address", customer_delivery_address);
    
});

function showProvinces(key, customer_address){
    //console.log("URL : ",  "{{ url('/') }}/api/province");
    fetch("{{ url('/') }}/api/province")
        .then(response => response.json())
        .then(data => {
            //console.log('Success Province :', data);
            $(elements[key].province).empty();
            $(elements[key].province).append(
                $('<option></option>').attr("value", "").html("ไม่ระบุ")
            );
            data.forEach(function(item){
                $(elements[key].province).append(
                    $('<option></option>').attr("value", ""+item.province).html(""+item.province)
                );
            });            
            if(customer_address){
                $(elements[key].province).val(customer_address.province);
            }
            showAmphoes(key,customer_address);
        });    
}
function showAmphoes(key, customer_address){
    //INPUT
    var province_code = $(elements[key].province).val();
    
    //console.log("URL : ",  "{{ url('/') }}/api/province/"+province_code+"/amphoe");
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe")
        .then(response => response.json())
        .then(data => {
            //console.log('Success Amphoe :', data);
            $(elements[key].district).empty();            
            $(elements[key].province).append(
                $('<option></option>').attr("value", "").html("ไม่ระบุ")
            );
            data.forEach(function(item){
                $(elements[key].district).append(
                    $('<option></option>').attr("value", ""+item.amphoe).html(""+item.amphoe)
                );
            });                        
            if(customer_address){
                $(elements[key].district).val(customer_address.district);
            }
            showDistricts(key, customer_address);
        });     
}
function showDistricts(key, customer_address){
    //INPUT
    var province_code = $(elements[key].province).val();
    var amphoe_code = $(elements[key].district).val();
    
    //console.log("URL : ",  "{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district");
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district")
        .then(response => response.json())
        .then(data => {
            //console.log('Success District :', data);
            $(elements[key].sub_district).empty();
            $(elements[key].province).append(
                $('<option></option>').attr("value", "").html("ไม่ระบุ")
            );
            data.forEach(function(item){
                $(elements[key].sub_district).append(
                    $('<option></option>').attr("value", ""+item.district).html(""+item.district)
                );
            });                        
            
            if(customer_address){
                $(elements[key].sub_district).val(customer_address.sub_district);
            }
            showZipcode(key, customer_address);
        });         
}
function showZipcode(key, customer_address){
    //INPUT
    var province_code = $(elements[key].province).val();
    var amphoe_code = $(elements[key].district).val();
    var district_code = $(elements[key].sub_district).val();
    
    //console.log("URL : ",  "{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district/"+district_code);
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district/"+district_code)
        .then(response => response.json())
        .then(data => {
            //console.log('Success Zip ocd:', data);
            $(elements[key].zipcode).empty();
            data.forEach(function(item){
                $(elements[key].zipcode).val(item.zipcode);
            });              
            if(customer_address){
                $(elements[key].zipcode).val(customer_address.zipcode);
            }
        });       
}
</script>
