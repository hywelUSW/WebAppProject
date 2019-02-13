<?php
//remove user session and redirect them to the home page
require_once("../php/initalise.php");
unset($_SESSION['user']);
header("Location:". $root);
die();
?>