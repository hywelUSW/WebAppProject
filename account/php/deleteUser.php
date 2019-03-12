<?php
if(isset($_POST['passwordDelete']) && isset($_SESSION['user']))
{
    include_once($root."php/user/userClass.php");
    $user = new user();
    if($user->verifyPassword($_SESSION['user'],$_POST['passwordDelete']))
    { 
         if($user->removeUser($_POST['email']))
         {
             session_unset($_SESSION['user']);
             $userDeleted = true;
         }
         else 
         {
           
           //could not delete the user feild
           $errMsg = "<p>There was an error removing the account!</p>";
         }

    }
    else 
    {
        //authenication failed
        $errMsg = "<p>Incorrect password!</p>";
    }
}
else
{
    $errMsg = "<p>Please complete the form!</p>";
}

?>