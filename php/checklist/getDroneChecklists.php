<?php
require_once("checklistClass.php");
$checklist = new checklist();
$result = $checklist->getDroneChecklists($_GET['DroneID']);


?>