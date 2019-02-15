<?php
require_once('userClass.php');
$User = new user();
If($User->userVerify($_POST['email'],$_POST['password']))
{
    header("Location:". $root);
    die();
}
else {
    header("Location:". $root."login/");
    die();
}

?>