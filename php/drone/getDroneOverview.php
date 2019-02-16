<?php
    require_once("droneClass.php");
    $drone = new drone();
    $result = $drone->getDroneOVerview($_GET['DroneID']);
    if($result)
    {
        return $result;
    }
    else
    {
        return false;
    }

?>