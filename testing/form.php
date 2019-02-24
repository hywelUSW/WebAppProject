<?php
print_r($_POST);
$test =  strtotime($_POST['time']);
echo date("Y-m-d H:m",$test);
?>
<form action="" method="POST">
<input type="datetime-local" name="time">
<input type="datetime-local" value="2017-06-01 08:30">
<button type="submit">sbu</button>
</form>