<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getPostLanding($_GET['checklistID']);
//check user owns checklist
if($result['userID'] != $_SESSION['user'])
{
   header("location: ".$root."checklist/");
   die();
}
if(array_filter($_POST) && isset($_SESSION['user']))
{
    //print_r($_POST);
    if($checklist->updatePostLanding($_GET['checklistID'],$_POST['PowerDownRPA'],$_POST['RemoveRPABattery'],$_POST['RPABatteryOnCharge'],$_POST['RPADamagedCheck'],$_POST['PropellerCheck'],$_POST['LandingGearCheck'],$_POST['RecordFlightDetails'],$_POST['CameraDataDownloaded'],$_POST['ControllerOff'],$_POST['EquipmentPacked'],$_POST['AreaChecked']))
    {
        $result = $checklist->getPostLanding($_GET['checklistID']);
        $msg = "CHecklist updated!";
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
            <h2>Post-Landing</h2>
            <p><?=$msg?></p>
            <form method='post'>
                <input type='hidden' name='PowerDownRPA' value='0'>
                <label>Drone Powered Down</label><input type="checkbox" name="PowerDownRPA" value='1' <?=$checklist->ischecked($result["PowerDownRPA"])?>>
                <hr>
                <input type='hidden' name='ControllerOff' value='0'>
                <label>Controller Powered Down</label><input type="checkbox" name="ControllerOff" value='1' <?=$checklist->ischecked($result["ControllerOff"])?>>
                <hr>
                <input type='hidden' name='RemoveRPABattery' value='0'>
                <label>Batteries Removed</label><input type="checkbox" name="RemoveRPABattery" value='1' <?=$checklist->ischecked($result["RemoveRPABattery"])?>>
                <hr>
                <input type='hidden' name='RPADamagedCheck' value='0'>
                <label>Drone Checked for Damage</label><input type="checkbox" name="RPADamagedCheck" value='1' <?=$checklist->ischecked($result["RPADamagedCheck"])?>>
                <hr>
                <input type='hidden' name='PropellerCheck' value='0'>
                <label>Propellers Checked for Damage</label><input type="checkbox" name="PropellerCheck" value='1' <?=$checklist->ischecked($result["PropellerCheck"])?>>
                <hr>
                <input type='hidden' name='LandingGearCheck' value='0'>
                <label>Landing Gear Checked for Damage</label><input type="checkbox" name="LandingGearCheck" value='1' <?=$checklist->ischecked($result["LandingGearCheck"])?>>
                <hr>
                <input type='hidden' name='RecordFlightDetails' value='0'>
                <label>Flight Details Recorded</label><input type="checkbox" name="RecordFlightDetails" value='1' <?=$checklist->ischecked($result["RecordFlightDetails"])?>>
                <hr>
                <input type='hidden' name='EquipmentPacked' value='0'>
                <label>Equipment Packed</label><input type="checkbox" name="EquipmentPacked" value='1' <?=$checklist->ischecked($result["EquipmentPacked"])?>>
                <hr>
                <input type='hidden' name='AreaChecked' value='0'>
                <label>Area Checked</label><input type="checkbox" name="AreaChecked" value='1' <?=$checklist->ischecked($result["AreaChecked"])?>>
                <hr>
                <input type='hidden' name='RPABatteryOnCharge' value='0'>
                <label>Batteries on Charge</label><input type="checkbox" name="RPABatteryOnCharge" value='1' <?=$checklist->ischecked($result["RPABatteryOnCharge"])?>>
                <hr>
                <input type='hidden' name='CameraDataDownloaded' value='0'>
                <label>Camera Data Downloaded</label><input type="checkbox" name="CameraDataDownloaded" value='1' <?=$checklist->ischecked($result["CameraDataDownloaded"])?>>
                <br><br><br>
                <div class="btnWrapper">
                    <button class="btnMain" type="submit">Update</button><br><br>
                    <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button class="btnMain" type="button">Cancel</button></a>
                </div>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>