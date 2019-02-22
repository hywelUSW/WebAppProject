<?php
//get list of drones owned by the user
$root ="/students/15080900/projectapp/";
require_once($root."php/drone/droneClass.php");
$drone = new drone();
$result = $drone->getDroneList($_SESSION['user']);
$test = $result->fetch_assoc();
print_r($test);
?>