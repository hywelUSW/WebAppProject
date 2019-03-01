<?php
require_once("/students/15080900/projectapp/php/initalise.php");
require_once($root."php/drone/droneclass.php");
require_once($root."php/checklist/checklistclass.php");
$drone= new drone();
$checklist = new checklist();
//get DroneID
$checklistDetails = $checklist->getChecklistOverview($_GET['checklistID']);

if($checklistDetails->num_rows > 0)
{
    $row = $checklistDetails->fetch_assoc();
    $$droneResult = $drone->getFullDetails($row['DroneID'],$_SESSION['user']);
    $envDetails = array(
        maxWind => $$droneResult['MaxWind'],
        minTemp => $$droneResult['TempRangeMin'],
        maxTemp => $$droneResult['TempRangeMax'],
        operatingWeather => $$droneResult['OperatingWeather'],
        payloadMinTemp => $$droneResult['MinTemp'],
        payloadMaxTemp =>$$droneResult['MaxTemp']);
    echo("<script> var DroneEnvDetails =". json_encode($envDetails).";</script>");
}
?>