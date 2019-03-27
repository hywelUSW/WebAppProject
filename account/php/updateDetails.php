<?php
//
//Updates the users account details
//
if(isset($_POST['email'],$_POST['name'],$_POST['password']))
{
    include_once("userClass.php");
    $user = new user();
    if($user->verifyPassword($_SESSION['user'],$_POST['password']))
    { //details updated
         if($user->updateDetails($_POST['email'],$_POST['name'],$_POST['password'],$_POST['NewPassword']))
         {
             $Msg = "Account updated!";

         }
         else
         {
             $Msg = "There was an error updating your account!";
         }
         
    }
    else 
    { //authenication failed
        $Msg = 'password incorrect!';   
    }
}
else
{//no values entered
    $Msg = 'Please complete the from!';
}

?>