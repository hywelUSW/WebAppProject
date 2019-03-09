<?php
require_once("/students/15080900/projectapp/php/");
if(isset($_GET['checklistID']))
{
    header("location: " . $root."checklist/checklistDetails?checklistID=".$_GET['checklistID']);
    die();
}
else
{
    header("location: ../");
    die();
}
?>