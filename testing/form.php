<?php
if($_FILES)
{
    echo "hello!";
    $name = $_FILES['filename']['name'];
    echo $name;
    echo $_FILES['filename']['type'];
    $ext = "txt";
    if(move_uploaded_file($_FILES['filename']['tmp_name'],"/students/15080900/testtest.txt"))
    {
    echo "yes";
    }
    else {
        echo "no";
    }
}

?>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="filename">


<button type="submit">upload</button>
</form>
<script>
function test(){
    var x = document.getElementById("time");
    var date = new date("Y-m-d\TH:i");
    alert(date);
}
    
</script>