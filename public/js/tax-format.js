function checkID(input) {
    if(input.length != 13) {
        alert('รหัส 13 หลักไม่ถูกต้อง'); console.log("wrong");return false;}
    for(i=0, sum=0; i < 12; i++){
        sum += parseFloat(input.charAt(i))*(13-i);
    }
    
    //console.log("CHECKED : ", (11-sum%11)%10 , parseFloat(input.charAt(12)));
    if((11-sum%11)%10!=parseFloat(input.charAt(12))){     
        //wrong   
        console.log("wrong");
        
        alert('รหัส 13 หลักไม่ถูกต้อง');
        return false;

    }
    
        //right
        console.log("right");
    return true;
}
function onChangeCitizenID(obj) {
    //var input = obj.value.replace(/-/g,"");
    var input = obj.value;
	console.log("INPUT : ",input);
    if(!checkID(input)){
      $(".tax-format")[0].focus();
    }
}

document.addEventListener("DOMContentLoaded", function(event) {
    console.log("555");
    //$(".tax-format").attr('placeholder','x-xxxx-xxxxx-xx-x');
    //$(".tax-format").attr('data-masked-input','9-9999-99999-99-9');
    $(".tax-format").change(function(){
      onChangeCitizenID(this);
    });
});

//<input type="tel" id="citizen_id" name="citizen_id"
//	class="form-control"
//	placeholder="x-xxxx-xxxxx-xx-x"
//	data-masked-input="9-9999-99999-99-9"
//	onchange="onChangeCitizenID(this)"
//	 />
