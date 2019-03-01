<?php
/*
$dir = "uploaded/";
$file = $dir.basename($_FILES["test"]["name"]);
print_r($_FILES['test']);
echo $imageFileType;

if(move_uploaded_file($_FILES["test"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["test"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}
*/
print_r($_POST);
?>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="test">
<br><br>
<input id="time" type="datetime-local" name="time"><button onclick="test()" type="button">Time</button>
<div>
<h4>Operating conditions</h4>
<label>Thunderstorm</label><input type="checkbox" name="weather[]" value="Thunderstorm"><br>
<label>Light rain</label><input type="checkbox" name="weather[]" value="drizzle"><br>
<label>rain</label><input type="checkbox" name="weather[]" value="rain"><br>
<label>snow</label><input type="checkbox" name="weather[]" value="snow"><br>
<label>fog</label><input type="checkbox" name="weather[]" value="atmosphere"><br>
<label>clear</label><input type="checkbox" name="weather[]" value="clear"><br>
<label>cloudy</label><input type="checkbox" name="weather[]" value="cloudy"><br>
<div>
<button type="submit">upload</button>
</form>
<script>
function test(){
    var x = document.getElementById("time");
    var date = new date("Y-m-d\TH:i");
    alert(date);
}
    
</script>