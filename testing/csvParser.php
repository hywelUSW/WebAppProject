<?php
$test = array_map('str_getcsv', file('csv/loadinglist.csv'));// str_getcsv("book1.csv",",");
echo "<form method='post'>";

foreach($test as $row)
{
    switch($row[2])
    {
        case "text":
            echo '<input type="'.$row[2].'" name="'.$row[1].'" placeholder="'.$row[0].'" >';
            break;
        case "checkbox":
            echo '<label>'.$row[0].'</label><input type="'.$row[2].'" name="'.$row[1].'" <'. htmlspecialchars('?').'=$checklist->ischecked($result["'.$row[1].'"])?>'.'>'; 
            break;
        default:
            break;
   
    }
    echo "\r\n";
    echo "<br><br>";
    echo "\r\n";
    /*
    <input type="<?=$row[2]?>" name="<?=$row[1]?>" placeholder="<?=$row[0]?>" required>
    <br>
    <?php*/
}
echo "</form>";
?>