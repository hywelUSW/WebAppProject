<?php

require_once("checklistClass.php");
$checklist = new checklist();
$result = $checklist->getUserChecklists($_SESSION['user']);
if($result)
{
    
    while($row = $result->fetch_assoc())
    {
        ?>
        <div class="Checklists">           
            <h4><a href="<?="checklistDetails?checklistID=".$row['ChecklistID']?>"><?=$row['Name']?></a></h4>
                <a href="download?checklistID=<?=$row['ChecklistID']?>"><i class="fas fa-download fa-lg"></i></a>
        </div>
        <hr>
        <?php
    }
}
else
{
    ?>
    <h4 id="msg" style="text-align:center;">No checklists added!</h4>
    <?php
}
?>