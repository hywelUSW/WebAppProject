<?php

$dir = "uploaded/";
$file = $dir.basename($_FILES["test"]["name"]);
print_r($_FILES['test']);
echo $imageFileType;

if(move_uploaded_file($_FILES["test"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["test"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}


?>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="test">
<br><br>
<input id="time" type="datetime-local" name="time"><button onclick="test()" type="button">Time</button>

<button type="submit">upload</button>
</form>
<script>
function test(){
    var x = document.getElementById("time");
    var date = new date("Y-m-d\TH:i");
    alert(date);
}
    
</script>