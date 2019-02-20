<?php
include_once("userClass.php");
$user = new user();
//Verify values First!!
$user->newUser($_POST['email'],$_POST['name'],$_POST['password']);

?>