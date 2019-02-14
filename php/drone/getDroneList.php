<?php
    require_once("droneClass.php");
    $drone = new drone();
    $result = $drone->getDroneList(2);
    if($result)
    {
        foreach($result as $row)
        {
            //print row results here
        }
    }
    else
    {
        echo "falsee";
    }


?>