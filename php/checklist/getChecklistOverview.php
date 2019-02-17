<?php
require_once("/students/15080900/projectapp/php/initalise.php");
require_once($root."php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getChecklistOverview(1);
if($result)
{
    $result = $result->fetch_assoc();
    if($result['UserID'] != $_SESSION['user'])
    {
       header("Location:".$root."checklist/");
       die();
    }
}
else{
    $noData = true; 
}

?>