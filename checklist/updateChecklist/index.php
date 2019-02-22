<?php
require_once("/students/15080900/projectapp/php/");
if(isset($_GET['DroneID']))
{
    header("location: " . $root."checklist/checklistDetails?DroneID=".$_GET['DroneID']);
    die();
}
else
{
    header("location: " . $root. "checklist/");
    die();
}
?>