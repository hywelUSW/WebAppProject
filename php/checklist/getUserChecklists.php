<?php

require_once("checklistClass.php");
$checklist = new checklist();
$result = $checklist->getUserChecklists(16);
if($result)
{
    
    while($row = $result->fetch_assoc())
    {
        ?>
        <div class="Checklists">           
            <h4><a href="<?="checklist?checklistID=".$row['ChecklistID']?>"><?=$row['Name']?></a></h4>
                <a href="download?checklistID=<?=$row['ChecklistID']?>">Download</a>
        </div>
        <hr>
        <?php
    }
}
else
{
    ?>
    <h4 id="msg" style="text-align:center;">No drones added!</h4>
    <?php
}
?>