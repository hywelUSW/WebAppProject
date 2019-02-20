<?php
require("/students/15080900/projectapp/php/initalise.php");
require_once("droneClass.php");
//check that all feilds are set and user is logged in
//if(array_filter($_POST) && isset($_SESSION['user']))
if(1==1)
{
    echo "test";
    $drone = new drone();
   // $droneID = $drone->AddDrone($_SESSION['user'],$_POST['DroneName']);
    $droneID = $drone->insertDroneMainData(16,"test");
    /*if($droneID)
    {
        $drone->addDesegnation($droneID,$_POST['ModelName'],$_POST['Manufacturer'],$_POST['DroneType']);
    }
    else
    {

    }*/

}
else
{
    echo "false";
}

?>