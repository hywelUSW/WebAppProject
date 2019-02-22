<?php
require_once("/students/15080900/projectapp/php/initalise.php");
require_once("checklistClass.php");
$checklist = new checklist();
$result = $checklist->getDroneChecklists($_GET['DroneID']);
if($result)
{
    while($row = $result->fetch_assoc())
    {
        ?>
            <a href="<?=$root."checklist/checklistDetails?checklistID=".$row['ChecklistID']?>"><?=$row['Name']?></a>
            <hr>
        <?php
    }
}else
{
    echo "<p>No checklists</p>";
}
?>