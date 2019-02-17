<script>

function checkID(input) {
    if(input.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)
        sum += parseFloat(input.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(input.charAt(12)))
        return false;
    return true;
}
function onChangeCitizenID(obj) {
	var input = obj.value.replace(/-/g,"");
	console.log("INPUT : ",input);
    if(!checkID(input))
        alert('รหัสประชาชนไม่ถูกต้อง');
    else
        alert('รหัสประชาชนถูกต้อง');
}
</script>


<div>
<iframe src="https://e.issuu.com/anonymous-embed.html?u=chavalit.kow&d=6.________________________8________" width="944" height="500" frameborder="0" allowfullscreen="true"></iframe>
</div>
<input type="tel" id="citizen_id" name="citizen_id"
	class="form-control"
	placeholder="x-xxxx-xxxxx-xx-x"
	data-masked-input="9-9999-99999-99-9"
	onchange="onChangeCitizenID(this)"
	 />
