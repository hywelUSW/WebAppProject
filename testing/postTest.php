<?php
print_r($_POST);
//check that all values are set
if(array_filter($_POST) && isset($_SESSION['user']))
{
    
}
else{
    echo "false";
}
?>
<form action="" method="POST">
<input type="text" name="frm1">
<input type="text" name="frm2">
<button type="submit">Submit</button>
</form>