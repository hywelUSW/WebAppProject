<?php
//
//logs out user by nullifying the user session, 
//then redirects them to the home page
//
require_once("/students/15080900/projectapp/php/initalise.php");
unset($_SESSION['user']);
header("Location:". $root);
die();
?>