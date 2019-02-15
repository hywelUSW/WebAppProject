<?php
    require_once("droneClass.php");
    $drone = new drone();
    $result = $drone->getDroneOVerview($_GET['droneID']);
    if($result)
    {

    }
    else
    {
        //drone detaisl
    }

?>