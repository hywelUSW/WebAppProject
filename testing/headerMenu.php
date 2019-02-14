<?php
session_start();
$_SESSION['user'] = "jeff";


class Menu {
    function getMainMenu(){
        if(isset($_SESSION['user']))
        {
            
        }
    }
 function getUserMenu(){
    if(isset($_SESSION['user']))
        {
            ?>
            <div id="userMenu">
                this is the user
        </div>
            <?php
        }
 }
}
$a = new menu();
$a->getUserMenu;
?>