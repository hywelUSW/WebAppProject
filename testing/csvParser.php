<?php
$test = array_map('str_getcsv', file('book1.csv'));// str_getcsv("book1.csv",",");
echo "<form>";

foreach($test as $row)
{
    echo 'isset($_POST["'.$row[1].'"]) && ';
    /*
    <input type="<?=$row[2]?>" name="<?=$row[1]?>" placeholder="<?=$row[0]?>" required>
    <br>
    <?php*/
}
echo "</form>";
?>