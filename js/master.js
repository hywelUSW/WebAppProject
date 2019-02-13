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

function toggleLogin(){
    $("#login").fadeToggle();
}