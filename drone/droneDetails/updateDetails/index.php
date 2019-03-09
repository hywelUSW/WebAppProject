<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
  //check that drone is set
  if($_GET['DroneID'] == null)
  {
     header("Location:".$root."drone/");
      die();
  }
  require_once($root."php/drone/droneclass.php");
  $drone = new drone();
  $getResult = $drone->getFullDetails($_GET['DroneID'],$_SESSION['user']);
  if($getResult->num_rows > 0)
  {
    $droneData = $getResult->fetch_assoc();
    //check ownership
    if($droneData['UserID'] != $_SESSION['user'])
    {
        $badUser = true;
    }
  }
  else {
      $noData = true;
  }
if(array_filter($_POST) && isset($_SESSION['user']))
{
    if(!badUser || !$noData)
    {
        $drone->updateMainData($_GET['DroneID'],$_POST['DroneName']);
        $drone->updateDesegnation($_GET['DroneID'],$_POST['ModelName'],$_POST['Manufacturer'],$_POST['DroneType']);
        $drone->updateCharacteristics($_GET['DroneID'],$_POST['FlightTypes'],$_POST['MaxOperatingSpeed'],$_POST['LaunchType'],$_POST['MaxFlightTime']);
        $drone->updateEnvLimits($_GET['DroneID'],$_POST['MaxHeight'],$_POST['MaxRadius'],$_POST['MaxWind'],$_POST['TempRangeMin'],$_POST['TempRangeMax'],$_POST['OperatingWeather']);
        $drone->updateTechSpecs($_GET['DroneID'],$_POST['Height'],$_POST['Width'],$_POST['Length'],$_POST['Weight'],$_POST['MaxTakeOffWeight'],$_POST['MotorType'],$_POST['MotorSpeed'],$_POST['ControlDataLink'],$_POST['VideoDataLink'],$_POST['FlightController']);
        $drone->updateRPSDetails($_GET['DroneID'],$_POST['DataLink'],$_POST['VideoLink'],$_POST['AntennaType']);
        $drone->updatePayload($_GET['DroneID'],$_POST['PayloadName'],$_POST['MinTemp'],$_POST['MaxTemp']);
        //replace values
        $droneData = $_POST;
        $msg = "Checklist updated";
        $weather = explode(",",$_POST['OperatingWeather']);   
        
    }
}
$weather = explode(",",$droneData['OperatingWeather']);

?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            <h2>Update Drone Details</h2>
            <?php
            if($badUser || $noData)
            {
                echo "<h3 class='msgMain'>Unable to get data!</h3>";
            }else {
                
            ?>
            <form method="POST"  enctype="multipart/form-data">
                    <input type="text" name="DroneName" placeholder="name" required>
                    <!--<br><br>
                    <input type="file" name="DroneImage">-->
                    <hr>
                    <h4>Drone Designation</h4>
                    <input type="text" name="ModelName" placeholder="Model Name" required>
                    <br><br>
                    <input type="text" name="Manufacturer" placeholder="Manufacturer" required>
                    <br><br>
                    <input type="text" name="DroneType" placeholder="Drone Type" required>
                    <hr>
                    <h4>Flight Characteristics</h4>
                    <input type="text" name="FlightModes" placeholder="Flight Modes" required>
                    <br><br>
                    <input type="number" name="MaxOperatingSpeed" placeholder="Max Speed(m/s)" required>
                    <br><br>
                    <input type="text" name="LaunchType" placeholder="Launch Type" required>
                    <br><br>
                    <input type="number" name="maxFlightTime" placeholder="Flight Time(mins)" required>
                    <hr>
                    <h4>Airframe Specifications</h4>
                    <input type="number" name="MaxHeight" placeholder="Max Ceiling Height(m)" required>
                    <br><br>
                    <input type="number" name="MaxRadius" placeholder="Operating Radius(m)" required>
                    <br><br>
                    <input type="number" name="MaxWind" placeholder="Max Surface Wind(m/s)" required>
                    <br><br>
                    <input type="number" name="TempRangeMin" placeholder="Min Operating Temperature(°C)" required>
                    <br><br>
                    <input type="number" name="TempRangeMax" placeholder="Max Operating Temperature(°C)" required>
                    <hr>
                    <div>
                        <h4>Operating conditions</h4>
                        <label>Thunderstorm</label><input type="checkbox" name="OperatingWeather[]" value="Thunderstorm"><hr>
                        <label>Light rain</label><input type="checkbox" name="OperatingWeather[]" value="Drizzle"><hr>
                        <label>Rain</label><input type="checkbox" name="OperatingWeather[]" value="Rain"><hr>
                        <label>Snow</label><input type="checkbox" name="OperatingWeather[]" value="Snow"><hr>
                        <label>Fog</label><input type="checkbox" name="OperatingWeather[]" value="Atmosphere"><hr>
                        <label>Clear</label><input type="checkbox" name="OperatingWeather[]" value="Clear"><hr>
                        <label>Cloudy</label><input type="checkbox" name="OperatingWeather[]" value="Cloudy"><br>
                    </div>
                    <br>
                    <hr>
                    <h4>Technical Specifications</h4>
                    <input type="Number" name="Height" placeholder="Height(mm)" required>
                    <br><br>
                    <input type="number" name="Width" placeholder="Width(mm)" required>
                    <br><br>
                    <input type="number" name="Length" placeholder="Length(mm)" required>
                    <br><br>
                    <input type="number" name="Weight" placeholder="Weight(g)" required>
                    <br><br>
                    <input type="number" name="MaxTakeOffWeight" placeholder="Max Take Off Weight(g)" required>
                    <br><br>
                    <input type="number" name="MotorType" placeholder="Motor Type" required>
                    <br><br>
                    <input type="number" name="MotorSpeed" placeholder="Motor Speed(RPM)" required>
                    <br><br>
                    <input type="text" name="ControlDataLink" placeholder="Control Data Link" required>
                    <br><br>
                    <input type="text" name="VideoDataLink" placeholder="Video Data Link" required>
                    <br><br>
                    <input type="text" name="FlightController" placeholder="Flight Controller" required>
                    <hr>
                    <h4>Remote Pilot Station Specifications</h4>
                    <input type="text" name="DataLink" placeholder="Data Link" required>
                    <br><br>
                    <input type="text" name="VideoLink" placeholder="Video Link" required>
                    <br><br>
                    <input type="text" name="AntennaType" placeholder="Antenna Type" required>
                    <hr>
                    <h4>Payload Details</h4>
                    <input type="text" name="PayloadName" placeholder="Payload Name" required>
                    <br><br>
                    <input type="number" name="PayloadMinTemp" placeholder="Minimum Temperature(°C)" required>
                    <br><br>
                    <input type="number" name="PayloadMaxTemp" placeholder="Maxiumum Tempeature(°C)" required>
                    <p><?=$errMsg?></p>
                    <br>
                    <button class="btnMain" type="submit">update Drone</button><br><br>
                    <a href="../"><button class="btnMain" type="button">Cancel</button></a>
                </form>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>