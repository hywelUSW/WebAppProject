<?php
//
//
//not used by any pages, jsut template code
    require_once("droneClass.php");
   $drone = new drone();
   $result = $drone->getDroneList($_SESSION['user']);
   if($result)
   {
       return $result;
   }
   else
   {
    return false;    
   }
?>