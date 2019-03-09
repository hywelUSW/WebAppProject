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
        $result = $checklist->getPreFlight($_GET['checklistID']);
        
        $msg = "Checklist updated!";
    }
    else
    {
        $msg = "could not update checklist!";
    }
}
$weather = explode(",",$result['WeatherCheck']);
print_R($result);
if($weather == null)
{
    $weather = ["",0,0];
}
?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <?php include_once("php/getDroneEnvDetails.php"); ?>
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            <h2>Pre-Flight</h2>
            <p><?=$msg?></p>
            <form method='post'>
                <input type="hidden" name="WeatherCheck" placeholder="Weather Checked" value="<?=$result['WeatherCheck']?>"><button type="button" id="getWeather">Get Weather</button>
                <div id="weather">
                    <ul id="weatherInfo">
                        <li id="weatherCond">Weather: <?=$weather[0]?></li>
                        <li id="Temp">Temperature: <?=$weather[1]?>°C</li>
                        <li id="windSpeed">Wind Speed: <?=$weather[2]?> M/S</li>
                    </ul>
                </div>
                <hr>
                <input type='hidden' name='SiteSurveyed' value='0'>
                <label>Site Surveyed</label><input type="checkbox" name="SiteSurveyed" value='1' <?=$checklist->ischecked($result["SiteSurveyed"])?>>
                <hr>
                <input type='hidden' name='RPASSService' value='0'>
                <label>RPASS Service</label><input type="checkbox" name="RPASSService" value='1' <?=$checklist->ischecked($result["RPASSService"])?>>
                <hr>
                <input type='hidden' name='TakeOffAreaEstablished' value='0'>
                <label>Take Off Area Established</label><input type="checkbox" name="TakeOffAreaEstablished" value='1' <?=$checklist->ischecked($result["TakeOffAreaEstablished"])?>>
                <hr>
                <input type='hidden' name='AssistantBriefed' value='0'>
                <label>Assistant Briefed(if applicable)</label><input type="checkbox" name="AssistantBriefed" value='1' <?=$checklist->ischecked($result["AssistantBriefed"])?>>
                <hr>
                <input type='hidden' name='ControllerConnects' value='0'>
                <label>Controller Works & Connects to Drone</label><input type="checkbox" name="ControllerConnects" value='1' <?=$checklist->ischecked($result["ControllerConnects"])?>>
                <hr>
                <input type='hidden' name='RPADamageCheck' value='0'>
                <label>Drone Checked for Damage</label><input type="checkbox" name="RPADamageCheck" value='1' <?=$checklist->ischecked($result["RPADamageCheck"])?>>
                <hr>
                <input type='hidden' name='BatteryCompartment' value='0'>
                <label>Battery Checked and fitted </label><input type="checkbox" name="BatteryCompartment" value='1' <?=$checklist->ischecked($result["BatteryCompartment"])?>>
                <hr>
                <input type='hidden' name='RPAMotors' value='0'>
                <label>RPA Motors are Functional</label><input type="checkbox" name="RPAMotors" value='1' <?=$checklist->ischecked($result["RPAMotors"])?>>
                <hr>
                <input type='hidden' name='CheckPropellers' value='0'>
                <label>Propellers are Free of Damage</label><input type="checkbox" name="CheckPropellers" value='1' <?=$checklist->ischecked($result["CheckPropellers"])?>>
                <hr>
                <input type='hidden' name='CheckCamera' value='0'>
                <label>Camera is Functional</label><input type="checkbox" name="CheckCamera" value='1' <?=$checklist->ischecked($result["CheckCamera"])?>>
                <hr>
                <input type='hidden' name='DronePowered' value='0'>
                <label>Drone Powers On</label><input type="checkbox" name="DronePowered" value='1' <?=$checklist->ischecked($result["DronePowered"])?>>
                <hr>
                <input type='hidden' name='DroneHomeLocked' value='0'>
                <label>Home Location is Locked</label><input type="checkbox" name="DroneHomeLocked" value='1' <?=$checklist->ischecked($result["DroneHomeLocked"])?>>
                <hr>
                <input type='hidden' name='Calibrated' value='0'>
                <label>Drone Compass is Calibrated</label><input type="checkbox" name="Calibrated" value='1' <?=$checklist->ischecked($result["Calibrated"])?>>
                <hr>
                <input type='hidden' name='CheckGroundStation' value='0'>
                <label>Ground station receives video</label><input type="checkbox" name="CheckGroundStation" value='1' <?=$checklist->ischecked($result["CheckGroundStation"])?>>
                <hr>
                <input type='hidden' name='VideoCheck' value='0'>
                <label>Camera is Recording Correctly</label><input type="checkbox" name="VideoCheck" value='1' <?=$checklist->ischecked($result["VideoCheck"])?>>
                <hr>
                <input type='hidden' name='TakeOffAreaClear' value='0'>
                <label>Take Off Area is Clear</label><input type="checkbox" name="TakeOffAreaClear" value='1' <?=$checklist->ischecked($result["TakeOffAreaClear"])?>>
                <hr>
                <input type='hidden' name='TakeOffClearence' value='0'>
                <label>Take Off Clearence Given</label><input type="checkbox" name="TakeOffClearence" value='1' <?=$checklist->ischecked($result["TakeOffClearence"])?>>
                <hr>
                <input type='hidden' name='AirspaceClear' value='0'>
                <label>Airspace is Clear</label><input type="checkbox" name="AirspaceClear" value='1' <?=$checklist->ischecked($result["AirspaceClear"])?>>
                <hr>
                <input type='hidden' name='FitToFly' value='0'>
                <label>Fit to Fly Documents Signed</label><input type="checkbox" name="FitToFly" value='1' <?=$checklist->ischecked($result["FitToFly"])?>>
                <br><br><br>
                <div class="btnWrapper">
                <button class="btnMain" type="submit">Update</button><br><br>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button  class="btnMain" type="button">Cancel</button></a>
                </div>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>
<script src="js/script.js"></script>