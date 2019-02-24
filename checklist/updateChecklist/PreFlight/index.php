<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getPreFlight($_GET['checklistID']);
//check user owns checklist
if($result['userID'] != $_SESSION['user'])
{
   header("location: ".$root."checklist/");
   die();
}
if(array_filter($_POST) && isset($_SESSION['user']))
{
    if($checklist->updatePreFlight($_GET['checklistID'],$_POST['WeatherCheck'],$_POST['SiteSurveyed'],$_POST['RPASSService'],$_POST['TakeOffAreaEstablished'],$_POST['AssistantBriefed'],$_POST['ContollerConnects'],$_POST['RPADamageCheck'],$_POST['BatteryCompartment'],$_POST['RPAMotors'],$_POST['CheckPropellers'],$_POST['CheckCamera'],$_POST['DronePowered'],$_POST['DroneHomeLocked'],$_POST['Calibrated'],$_POST['CheckGroundStation'],$_POST['VideoCheck'],$_POST['TakeOffAreaClear'],$_POST['TakeOffClearence'],$_POST['AirspaceClear'],$_POST['FitToFly']))
    {

    }
    else
    {
        $errMsg = "";
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
            <h2>Pre-Flight</h2>
            
            <form method='post'>
                <input type="text" name="WeatherCheck" placeholder="Weather Checked" value="<?=$result['WeatherCheck']?>"><button type="button" id="getWeather">Get Weather</button>
                <br><br>
                <input type='hidden' name='SiteSurveyed' value='0'>
                <label>Site Surveyed</label><input type="checkbox" name="SiteSurveyed" <?=$checklist->ischecked($result["SiteSurveyed"])?>>
                <br><br>
                <input type='hidden' name='RPASSService' value='0'>
                <label>RPASS Service</label><input type="checkbox" name="RPASSService" <?=$checklist->ischecked($result["RPASSService"])?>>
                <br><br>
                <input type='hidden' name='TakeOffAreaEstablished' value='0'>
                <label>Take Off Area Established</label><input type="checkbox" name="TakeOffAreaEstablished" <?=$checklist->ischecked($result["TakeOffAreaEstablished"])?>>
                <br><br>
                <input type='hidden' name='AssistantBriefed' value='0'>
                <label>Assistant Briefed(if applicable)</label><input type="checkbox" name="AssistantBriefed" <?=$checklist->ischecked($result["AssistantBriefed"])?>>
                <br><br>
                <input type='hidden' name='ContollerConnects' value='0'>
                <label>Controller Wroks & Connects to Drone</label><input type="checkbox" name="ContollerConnects" <?=$checklist->ischecked($result["ContollerConnects"])?>>
                <br><br>
                <input type='hidden' name='RPADamageCheck' value='0'>
                <label>Drone Checked for Damage</label><input type="checkbox" name="RPADamageCheck" <?=$checklist->ischecked($result["RPADamageCheck"])?>>
                <br><br>
                <input type='hidden' name='BatteryCompartment' value='0'>
                <label>Battery Checked and fitted </label><input type="checkbox" name="BatteryCompartment" <?=$checklist->ischecked($result["BatteryCompartment"])?>>
                <br><br>
                <input type='hidden' name='RPAMotors' value='0'>
                <label>RPA Motors are Functional</label><input type="checkbox" name="RPAMotors" <?=$checklist->ischecked($result["RPAMotors"])?>>
                <br><br>
                <input type='hidden' name='CheckPropellers' value='0'>
                <label>Propellers are Free of Damage</label><input type="checkbox" name="CheckPropellers" <?=$checklist->ischecked($result["CheckPropellers"])?>>
                <br><br>
                <input type='hidden' name='CheckCamera' value='0'>
                <label>Camera is Functional</label><input type="checkbox" name="CheckCamera" <?=$checklist->ischecked($result["CheckCamera"])?>>
                <br><br>
                <input type='hidden' name='DronePowered' value='0'>
                <label>Drone Powers On</label><input type="checkbox" name="DronePowered" <?=$checklist->ischecked($result["DronePowered"])?>>
                <br><br>
                <input type='hidden' name='DroneHomeLocked' value='0'>
                <label>Home Location is Locked</label><input type="checkbox" name="DroneHomeLocked" <?=$checklist->ischecked($result["DroneHomeLocked"])?>>
                <br><br>
                <input type='hidden' name='Calibrated' value='0'>
                <label>Drone Compass is Calibrated</label><input type="checkbox" name="Calibrated" <?=$checklist->ischecked($result["Calibrated"])?>>
                <br><br>
                <input type='hidden' name='CheckGroundStation' value='0'>
                <label>Ground station receives video</label><input type="checkbox" name="CheckGroundStation" <?=$checklist->ischecked($result["CheckGroundStation"])?>>
                <br><br>
                <input type='hidden' name='VideoCheck' value='0'>
                <label>Camera is Recording Correctly</label><input type="checkbox" name="VideoCheck" <?=$checklist->ischecked($result["VideoCheck"])?>>
                <br><br>
                <input type='hidden' name='TakeOffAreaClear' value='0'>
                <label>Take Off Area is Clear</label><input type="checkbox" name="TakeOffAreaClear" <?=$checklist->ischecked($result["TakeOffAreaClear"])?>>
                <br><br>
                <input type='hidden' name='TakeOffClearence' value='0'>
                <label>Take Off Clearence Given</label><input type="checkbox" name="TakeOffClearence" <?=$checklist->ischecked($result["TakeOffClearence"])?>>
                <br><br>
                <input type='hidden' name='AirspaceClear' value='0'>
                <label>Airspace is Clear</label><input type="checkbox" name="AirspaceClear" <?=$checklist->ischecked($result["AirspaceClear"])?>>
                <br><br>
                <input type='hidden' name='FitToFly' value='0'>
                <label>Fit to Fly Documents Signed</label><input type="checkbox" name="FitToFly" <?=$checklist->ischecked($result["FitToFly"])?>>
                <br><br>
                <button type="submit">Update</button>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button type="button">Cancel</button></a>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>