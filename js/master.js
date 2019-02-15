$("#btnMain").click(function(){
    toggleMenu("#mainMenu","#userMenu");
   
});
$("#btnUser").click(function(){
    toggleMenu("#userMenu","#mainMenu");
});
function toggleMenu(selectedMenu,otherMenu){
    //disable other menu if active
    if($(otherMenu).css("display") != "none")
    {
        $(otherMenu).animate({width:'toggle'},350);
    }
    $(selectedMenu).animate({width:'toggle'},350);
}
$("main").click(function(e){
    //disable other menu if active
    
    if($("#mainMenu").css("display") != "none")
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