<?php

//old
require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getLoadingList($_GET['userID']);
?>