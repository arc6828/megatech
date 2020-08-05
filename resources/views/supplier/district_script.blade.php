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
    var supplier_address = null;
    var supplier_delivery_address = null;

    
    @if(isset($supplier))
        supplier_address = {
            "province" : "{{ $row->province }}",
            "district" : "{{ $row->district }}",
            "sub_district" : "{{ $row->sub_district }}",
            "zipcode" : "{{ $row->zipcode }}",
        };
        supplier_delivery_address = {
            "province" : "{{ $row->delivery_province }}",
            "district" : "{{ $row->delivery_district }}",
            "sub_district" : "{{ $row->delivery_sub_district }}",
            "zipcode" : "{{ $row->delivery_zipcode }}",
        };        
    @endif
    showProvinces("address", supplier_address);
    showProvinces("delivery_address", supplier_delivery_address);
    
});

function showProvinces(key, supplier_address){
    //console.log("URL : ",  "{{ url('/') }}/api/province");
    fetch("{{ url('/') }}/api/province")
        .then(response => response.json())
        .then(data => {
            //console.log('Success Province :', data);
            $(elements[key].province).empty();
            data.forEach(function(item){
                $(elements[key].province).append(
                    $('<option></option>').attr("value", ""+item.province).html(""+item.province)
                );
            });            
            if(supplier_address){
                $(elements[key].province).val(supplier_address.province);
            }
            showAmphoes(key,supplier_address);
        });    
}
function showAmphoes(key, supplier_address){
    //INPUT
    var province_code = $(elements[key].province).val();
    
    //console.log("URL : ",  "{{ url('/') }}/api/province/"+province_code+"/amphoe");
    //PARAMETERS
    fetch("{{ url('/') }}/api/province/"+province_code+"/amphoe")
        .then(response => response.json())
        .then(data => {
            //console.log('Success Amphoe :', data);
            $(elements[key].district).empty();
            data.forEach(function(item){
                $(elements[key].district).append(
                    $('<option></option>').attr("value", ""+item.amphoe).html(""+item.amphoe)
                );
            });                        
            if(supplier_address){
                $(elements[key].district).val(supplier_address.district);
            }
            showDistricts(key, supplier_address);
        });     
}
function showDistricts(key, supplier_address){
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
            data.forEach(function(item){
                $(elements[key].sub_district).append(
                    $('<option></option>').attr("value", ""+item.district).html(""+item.district)
                );
            });                        
            
            if(supplier_address){
                $(elements[key].sub_district).val(supplier_address.sub_district);
            }
            showZipcode(key, supplier_address);
        });         
}
function showZipcode(key, supplier_address){
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
            if(supplier_address){
                $(elements[key].zipcode).val(supplier_address.zipcode);
            }
        });       
}
</script>
