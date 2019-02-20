<?php
include_once("userClass.php");
$user = new user();
//Verify values First!!
if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']))
{
    $user->newUser($_POST['email'],$_POST['name'],$_POST['password']);
}
?>