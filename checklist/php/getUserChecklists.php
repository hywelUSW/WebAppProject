<?php
require_once($root."php/checklist/checklistClass.php");
$checklist = new checklist();

$result = $checklist->getUserChecklists($_SESSION['user']);
if($result)
{
    while($row = $result->fetch_assoc())
    {
        ?>
        <div class="Checklists">           
            <h4><a href="<?="checklistDetails?checklistID=".$row['ChecklistID']?>"><?=$row['ChecklistName']?></a></h4>
                <a href="<?=$root."checklist/Download?checklistID=".$row['ChecklistID']?>"><i class="fas fa-download fa-lg"></i></a>
        </div>
        <hr>
        <?php
    }
}
else
{
    ?>
    <h3 class="msg" style="text-align:center;">No checklists added!</h3>
    <?php
}
?>