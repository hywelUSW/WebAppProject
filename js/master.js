var isDesktop = false;
$("document").ready(function() {
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        isDesktop = true;
        $("#btnMain").css("display","none");
        $("#mainMenu").css("display","block");
        $("#mainMenu").css("width","185px");
        $("main").css("margin-left","235px");
    }
    $("body").css("display","block");
});


function toggleMenu(selectedMenu,otherMenu){
    //disable other menu if active
    if($(otherMenu).css("display") != "none"){
        if(!isDesktop){
            $(otherMenu).animate({width:'toggle'},350);
        }
    }
    $(selectedMenu).animate({width:'toggle'},350);
}
$("#btnMain").click(function(){
    toggleMenu("#mainMenu","#userMenu");
   
});
$("#btnUser").click(function(){
    toggleMenu("#userMenu","#mainMenu");
});
$("main").click(function(e){
    //disable other menu if active
    if($("#mainMenu").css("display") != "none" && !isDesktop)
    {
        $("#mainMenu").animate({width:'toggle'},350);
    }
    //disable other menu if active
    if($("#userMenu").css("display") != "none")
    {
        $("#userMenu").animate({width:'toggle'},350);
    }
    
});

//popup dialog
$("#loginLink").click(function(){
    $("#userMenu").animate({width:'toggle'},350);
    $(".popup").fadeToggle();
});

$(".popup").click(function(e){
    if(e.target == this)
    {
        $(".popup").fadeToggle();
    }
});

