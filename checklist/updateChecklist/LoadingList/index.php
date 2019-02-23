<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getLoadingList($_GET['checklistID']);
//check user owns checklist
if($result['userID'] != $_SESSION['user'])
{
   header("location: ".$root."checklist/");
   die();
}
print_r($_POST);
?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            <h2>Loading List</h2>
            
            <form method='post'>
                <input type="text" name="WeatherCheck" placeholder="Weather Check" >
                <br><br>
                <input type='hidden' name='OpsManual' value='0'>
                <label>Operations Manual</label><input type="checkbox" name="OpsManual" <?=$checklist->ischecked($result["OpsManual"])?>>
                <br><br>
                <input type='hidden' name='Maps' value='0'>
                <label>Maps</label><input type="checkbox" name="Maps" <?=$checklist->ischecked($result["Maps"])?>>
                <br><br>
                <input type='hidden' name='TaskInfo' value='0'>
                <label>Task Information</label><input type="checkbox" name="TaskInfo" <?=$checklist->ischecked($result["TaskInfo"])?>>
                <br><br>
                <input type='hidden' name='SafetyEquiment' value='0'>
                <label>Safety Equipment</label><input type="checkbox" name="SafetyEquiment" <?=$checklist->ischecked($result["SafetyEquiment"])?>>
                <br><br>
                <input type='hidden' name='LiPoBag' value='0'>
                <label>LiPo Bag</label><input type="checkbox" name="LiPoBag" <?=$checklist->ischecked($result["LiPoBag"])?>>
                <br><br>
                <input type='hidden' name='Controller' value='0'>
                <label>Controller</label><input type="checkbox" name="Controller" <?=$checklist->ischecked($result["Controller"])?>>
                <br><br>
                <input type='hidden' name='EquipmentCharged' value='0'>
                <label>Equipment Charged</label><input type="checkbox" name="EquipmentCharged" <?=$checklist->ischecked($result["EquipmentCharged"])?>>
                <br><br>
                <input type='hidden' name='Camera' value='0'>
                <label>Camera</label><input type="checkbox" name="Camera" <?=$checklist->ischecked($result["Camera"])?>>
                <br><br>
                <input type='hidden' name='RPAPlatform' value='0'>
                <label>RPA Platform</label><input type="checkbox" name="RPAPlatform" <?=$checklist->ischecked($result["RPAPlatform"])?>>
                <br><br>
                <input type='hidden' name='Propellers' value='0'>
                <label>Drone Propellers</label><input type="checkbox" name="Propellers" <?=$checklist->ischecked($result["Propellers"])?>>
                <br><br>
                <input type='hidden' name='CarryingCase' value='0'>
                <label>Carrying Case</label><input type="checkbox" name="CarryingCase" <?=$checklist->ischecked($result["CarryingCase"])?>>
                <br><br>
                <input type='hidden' name='PermissionGranted' value='0'>
                <label>Area Permission Granted</label><input type="checkbox" name="PermissionGranted" <?=$checklist->ischecked($result["PermissionGranted"])?>>
                <br><br>
                <button type="submit">Update</button>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button>Cancel</button></a>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>