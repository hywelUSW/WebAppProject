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
if(array_filter($_POST) && isset($_SESSION['user']))
{
    
    if($checklist->updateLoadingList($_GET['checklistID'],$_POST['OpsManual'],$_POST['Maps'],$_POST['TaskInfo'],$_POST['SafetyEquipment'],$_POST['LiPoBag'],$_POST['Controller'],$_POST['EqupmentCharged'],$_POST['Camera'],$_POST['RPAPlatform'],$_POST['Propellers'],$_POST['CarryingCase'],$_POST['PermissionGranted']))
    {
        $result = $checklist->getLoadingList($_GET['checklistID']);
    }
    else
    {
        $errMsg = "There was an error updaing the checklist!";
    }
}
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
            <p><?=$errMsg?></p>
            <form method='post'>
                <input type='hidden' name='OpsManual' value='0'>
                <label>Operations Manual</label><input type="checkbox" name="OpsManual" value='1'  <?=$checklist->ischecked($result["OpsManual"])?>>
                <hr>
                <input type='hidden' name='Maps' value='0'>
                <label>Maps</label><input type="checkbox" name="Maps" value='1' <?=$checklist->ischecked($result["Maps"])?>>
                <hr>
                <input type='hidden' name='TaskInfo' value='0'>
                <label>Task Information</label><input type="checkbox" name="TaskInfo" value='1' <?=$checklist->ischecked($result["TaskInfo"])?>>
                <hr>
                <input type='hidden' name='SafetyEquipment' value='0'>
                <label>Safety Equipment</label><input type="checkbox" name="SafetyEquipment" value='1' <?=$checklist->ischecked($result["SafetyEquipment"])?>>
                <hr>
                <input type='hidden' name='LiPoBag' value='0'>
                <label>LiPo Bag</label><input type="checkbox" name="LiPoBag" value='1' <?=$checklist->ischecked($result["LiPoBag"])?>>
                <hr>
                <input type='hidden' name='Controller' value='0'>
                <label>Controller</label><input type="checkbox" name="Controller" value='1' <?=$checklist->ischecked($result["Controller"])?>>
                <hr>
                <input type='hidden' name='EquipmentCharged' value='0'>
                <label>Equipment Charged</label><input type="checkbox" name="EquipmentCharged" value='1' <?=$checklist->ischecked($result["EquipmentCharged"])?>>
                <hr>
                <input type='hidden' name='Camera' value='0'>
                <label>Camera</label><input type="checkbox" name="Camera" value='1' <?=$checklist->ischecked($result["Camera"])?>>
                <hr>
                <input type='hidden' name='RPAPlatform' value='0'>
                <label>RPA Platform</label><input type="checkbox" name="RPAPlatform" value='1' <?=$checklist->ischecked($result["RPAPlatform"])?>>
                <hr>
                <input type='hidden' name='Propellers' value='0'>
                <label>Drone Propellers</label><input type="checkbox" name="Propellers" value='1' <?=$checklist->ischecked($result["Propellers"])?>>
                <hr>
                <input type='hidden' name='CarryingCase' value='0'>
                <label>Carrying Case</label><input type="checkbox" name="CarryingCase" value='1' <?=$checklist->ischecked($result["CarryingCase"])?>>
                <hr>
                <input type='hidden' name='PermissionGranted' value='0'>
                <label>Area Permission Granted</label><input type="checkbox" name="PermissionGranted" value='1' <?=$checklist->ischecked($result["PermissionGranted"])?>>
                <br><br><br>
                <div class="btnWrapper">
                <button  class="btnMain" type="submit">Update</button><br><br>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button class="btnMain" type="button">Cancel</button></a>
                </div>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>