<?php
require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getLoadingList(44);

if($result)
{
    $row = $result->fetch_assoc();
    print_r($row);
}
?>