<?php
if(isset($_POST['password']) && isset($_SESSION['user']))
{
    include_once($root."php/user/userClass.php");
    $user = new user();
    if($user->userVerify($_POST['email'],$_POST['password']))
    { 
         if($user->removeUser($_POST['email']))
         {
             session_unset($_SESSION['user']);
         }
         else 
         {
           //
           //could not delete the user feild
           //  
         }

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