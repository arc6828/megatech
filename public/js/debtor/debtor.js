$(document).ready(function(){
    $("#save").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=account]:checked').val()
        
        //put name into textbox named result
        $("#account").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#save_user").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_user]:checked').val()
        
        //put name into textbox named result
        $("#id_user").val(name);
        $(this).prev().click();
    });
});