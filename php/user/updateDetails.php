<?php
if(isset($_POST['email'],$_POST['name'],$_POST['password']))
{
    include_once("userClass.php");
    $user = new user();
    if($user->userVerify($_POST['email'],$_POST['password']))
    { 
         $user->updateDetails($_POST['email'],$_POST['name'],$_POST['password'],$_POST['NewPassword']);
    }
    else 
    {
        //authenication failed    
    }
}
else
{
    echo("no values entered");
    //no values entered
}

?>