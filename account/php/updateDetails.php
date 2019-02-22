<?php
//
//Updates the users account details
//
if(isset($_POST['email'],$_POST['name'],$_POST['password']))
{
    include_once("userClass.php");
    $user = new user();
    if($user->userVerify($_POST['email'],$_POST['password']))
    { 
        //details updated
         $user->updateDetails($_POST['email'],$_POST['name'],$_POST['password'],$_POST['NewPassword']);
         $Msg = '<p class="SuccMsg">password incorrect!</p>';  
    }
    else 
    {
        //authenication failed
        $Msg = '<p class="ErrMsg">password incorrect!</p>';   
    }
}
else
{
    //no values entered
    $Msg = '<p class="ErrMsg"> Please complete the from!</p>';
}

?>