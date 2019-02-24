<?php
$test = array_map('str_getcsv', file('csv/postlanding.csv'));// str_getcsv("preLanding.csv",",");
echo "<form method='post'>";
echo "\r\n";
foreach($test as $row)
{
   /* switch($row[2])
    {
        case "text":
            echo '<input type="'.$row[2].'" name="'.$row[1].'" placeholder="'.$row[0].'" >';
            break;
        case "checkbox":
            echo "<input type='hidden' name='".$row[1]."' value='0'>";
            echo "\r\n";
            echo '<label>'.$row[0].'</label><input type="'.$row[2].'" name="'.$row[1].'" <'. htmlspecialchars('?').'=$checklist->ischecked($result["'.$row[1].'"])?>'.'>'; 
            break;
        case "datetime":
            echo "<label>".$row[0]."<label><input type='".$row[2]."' name='".$row[1]."'>";
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
    echo "$".$row[1].",";
}
?>
<button type="submit">Update</button>
<a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button>Cancel</button></a>
</form>