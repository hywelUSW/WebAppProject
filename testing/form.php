<?php
if(array_filter($_POST))
{
  print_r(array_filter($_POST));
}
?>
<form action="" method="POST" enctype="multipart/form-data">
<input type="text" name="test">
<input type="text" name ="test2">


<button type="submit">upload</button>
</form>
<script>
function test(){
    var x = document.getElementById("time");
    var date = new date("Y-m-d\TH:i");
    alert(date);
}
    
</script>