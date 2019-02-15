$("#RegSubmit").click(function(){
    if($("#password").val() != $("#passwordConfirm").val())
    {
        $("#RegMsg").text("Password does not match");
        event.preventDefault();
    }
});

