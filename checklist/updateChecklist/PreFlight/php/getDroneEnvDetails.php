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
    $result = $drone->getFullDetails($row['DroneID'],$_SESSION['user']);
    $envDetails = array(
        maxWind => $result['MaxWind'],
        minTemp => $result['TempRangeMin'],
        maxTemp => $result['TempRangeMax'],
        operatingWeather => $result['OperatingWeather'],
        payloadMinTemp => $result['MinTemp'],
        payloadMaxTemp =>$result['MaxTemp']);
    echo("<script> var DroneEnvDetails =". json_encode($envDetails).";</script>");
}
?>