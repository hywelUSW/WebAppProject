<?php
    require_once("droneClass.php");
   $drone = new drone();
   $result = $drone->getDroneList(16);
   print_r($result);
   if($result)
   {
       echo "true";
   }
   else{
       echo "false";
   }
?>