 $(document).ready(function(){
    $("#save").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_customer]:checked').val()
        
        //put name into textbox named result
        $("#id_customer").val(name);
        $(this).prev().click();
    });
});