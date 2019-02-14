<?php
echo "hello world!";
require_once('userClass.php');
$User = new user();
If($User->userVerify($_POST['email'],$_POST['password']))
{
    
    echo("correct Details");
}
else {
    echo("Incorrect details");
}

?>