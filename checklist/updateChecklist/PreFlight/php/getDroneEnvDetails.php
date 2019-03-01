<?php
require_once("/students/15080900/projectapp/php/initalise.php");
require_once($root."php/drone/droneclass.php");
require_once($root."php/checklist/checklistclass.php");
$drone= new drone();
$checklist = new checklist();
$droneID = $checklist->getChecklistOverview($_GET['checklistID'],$_SESSION['user']);
$result = $drone->getFullDetails(1,$_SESSION['user']);
$envDetails = array(
    maxWind => $result['MaxWind'],
    minTemp => $result['TempRangeMin'],
    maxTemp => $result['TempRangeMax'],
    operatingWeather => $result['OperatingWeather'],
    payloadMinTemp => $result['MinTemp'],
    payloadMaxTemp =>$result['MaxTemp']);
print_r($envDetails);

?>