 $(document).ready(function(){
    $("#savecustomer").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_customer]:checked').val()
        
        //put name into textbox named result
        $("#id_customer").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#saveuser").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_user]:checked').val()
        
        //put name into textbox named result
        $("#id_user").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#savedepartment").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_department]:checked').val()
        
        //put name into textbox named result
        $("#id_department").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#saveaccount").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_account]:checked').val()
        
        //put name into textbox named result
        $("#id_account").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#savedeposit").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_deposit]:checked').val()
        
        //put name into textbox named result
        $("#id_deposit").val(name);
        $(this).prev().click();
    });
});
  $(document).ready(function(){
    $("#savejob").click(function(){
        //read name from textbox to variable name
        var name = $('input[name=id_job]:checked').val()
        
        //put name into textbox named result
        $("#id_job").val(name);
        $(this).prev().click();
    });
});