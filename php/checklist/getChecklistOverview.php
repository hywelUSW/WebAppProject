<?php
require_once("checklistClass.php");
$checklist = new checklist();

$result = $checklist->getChecklistOverview($_GET['checklistID']);
if($result)
{

}
else{
   $noData = true; 
}

?>