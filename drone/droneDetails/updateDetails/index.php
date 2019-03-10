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
        $weather = $_POST['OperatingWeather'];
       
       
        
    }
}
//check that weather isnt already an array from post values
if(!isset($weather))
{
    $weather = explode(",",$droneData['OperatingWeather']);
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
            <p><?=$msg?></p>
            <form method="POST"  enctype="multipart/form-data">
                    <input type="text" name="DroneName" placeholder="name" value="<?=$droneData['DroneName']?>" required>
                    <!--<br><br>
                    <input type="file" name="DroneImage">-->
                    <hr>
                    <h4>Drone Designation</h4>
                    
                    <input type="text" name="ModelName" maxLength="40" placeholder="Model Name" value="<?=$droneData['ModelName']?>" required>
                    <br><br>
                    <input type="text" name="Manufacturer" maxLength="40" placeholder="Manufacturer" value="<?=$droneData['Manufacturer']?>" required>
                    <br><br>
                    <input type="text" name="DroneType" maxLength="40" placeholder="Drone Type" value="<?=$droneData['DroneType']?>" required>
                    <hr>
                    <h4>Flight Characteristics</h4>
                    <input type="text" name="FlightTypes" maxLength="40" placeholder="Flight Modes" value="<?=$droneData['FlightTypes']?>" required>
                    <br><br>
                    <input type="number" name="MaxOperatingSpeed"  placeholder="Max Speed(m/s)"value="<?=$droneData['MaxOperatingSpeed']?>"  required>
                    <br><br>
                    <input type="text" name="LaunchType" maxLength="40" placeholder="Launch Type" value="<?=$droneData['LaunchType']?>" required>
                    <br><br>
                    <input type="number" name="MaxFlightTime" placeholder="Flight Time(mins)" value="<?=$droneData['MaxFlightTime']?>" required>
                    <hr>
                    <h4>Airframe Specifications</h4>
                    <input type="number" name="MaxHeight"  placeholder="Max Ceiling Height(m)" value="<?=$droneData['MaxHeight']?>"  required>
                    <br><br>
                    <input type="number" name="MaxRadius"  placeholder="Operating Radius(m)" value="<?=$droneData['MaxRadius']?>" required>
                    <br><br>
                    <input type="number" name="MaxWind"   placeholder="Max Surface Wind(m/s)" value="<?=$droneData['MaxWind']?>"  required>
                    <br><br>
                    <input type="number" name="TempRangeMin" placeholder="Min Operating Temperature(°C)" value="<?=$droneData['TempRangeMin']?>"  required>
                    <br><br>
                    <input type="number" name="TempRangeMax" placeholder="Max Operating Temperature(°C)" value="<?=$droneData['TempRangeMax']?>" required>
                    <hr>
                    <div>
                        <h4>Operating conditions</h4>
                        <label>Thunderstorm</label><input type="checkbox" name="OperatingWeather[]" value="Thunderstorm" <?=$drone->isWeatherChecked("Thunderstorm",$weather)?>><hr>
                        <label>Light rain</label><input type="checkbox" name="OperatingWeather[]" value="Drizzle" <?=$drone->isWeatherChecked("Drizzle",$weather)?>><hr>
                        <label>Rain</label><input type="checkbox" name="OperatingWeather[]" value="Rain" <?=$drone->isWeatherChecked("Rain",$weather)?> ><hr>
                        <label>Snow</label><input type="checkbox" name="OperatingWeather[]" value="Snow"<?=$drone->isWeatherChecked("Snow",$weather)?>><hr>
                        <label>Fog</label><input type="checkbox" name="OperatingWeather[]" value="Atmosphere" <?=$drone->isWeatherChecked("Atmosphere",$weather)?>><hr>
                        <label>Clear</label><input type="checkbox" name="OperatingWeather[]" value="Clear" <?=$drone->isWeatherChecked("Clear",$weather)?>><hr>
                        <label>Cloudy</label><input type="checkbox" name="OperatingWeather[]" value="Cloudy" <?=$drone->isWeatherChecked("Cloudy",$weather)?>><br>
                    </div>
                    <br>
                    <hr>
                    <h4>Technical Specifications</h4>
                    <input type="Number" name="Height" placeholder="Height(mm)" value="<?=$droneData['Height']?>" required>
                    <br><br>
                    <input type="number" name="Width" placeholder="Width(mm)" value="<?=$droneData['Width']?>" required>
                    <br><br>
                    <input type="number" name="Length" placeholder="Length(mm)" value="<?=$droneData['Length']?>" required>
                    <br><br>
                    <input type="number" name="Weight" placeholder="Weight(g)" value="<?=$droneData['Weight']?>" required>
                    <br><br>
                    <input type="number" name="MaxTakeOffWeight" placeholder="Max Take Off Weight(g)" value="<?=$droneData['MaxTakeOffWeight']?>" required>
                    <br><br>
                    <input type="number" name="MotorType" placeholder="Motor Type" value="<?=$droneData['MotorType']?>" required>
                    <br><br>
                    <input type="number" name="MotorSpeed" placeholder="Motor Speed(RPM)" value="<?=$droneData['MotorSpeed']?>" required>
                    <br><br>
                    <input type="text" name="ControlDataLink" maxLength="40" placeholder="Control Data Link" value="<?=$droneData['ControlDataLink']?>" required>
                    <br><br>
                    <input type="text" name="VideoDataLink" maxLength="40" placeholder="Video Data Link" value="<?=$droneData['VideoDataLink']?>" required>
                    <br><br>
                    <input type="text" name="FlightController" maxLength="40" placeholder="Flight Controller" value="<?=$droneData['FlightController']?>" required>
                    <hr>
                    <h4>Remote Pilot Station Specifications</h4>
                    <input type="text" name="DataLink" maxLength="40" placeholder="Data Link" value="<?=$droneData['DataLink']?>" required>
                    <br><br>
                    <input type="text" name="VideoLink" maxLength="40" placeholder="Video Link" value="<?=$droneData['VideoLink']?>" required>
                    <br><br>
                    <input type="text" name="AntennaType" maxLength="40" placeholder="Antenna Type" value="<?=$droneData['AntennaType']?>" required>
                    <hr>
                    <h4>Payload Details</h4>
                    <input type="text" name="PayloadName" maxLength="40" placeholder="Payload Name" value="<?=$droneData['PayloadName']?>" required>
                    <br><br>
                    <input type="number" name="MinTemp" placeholder="Minimum Temperature(°C)" value="<?=$droneData['MinTemp']?>" required>
                    <br><br>
                    <input type="number" name="MaxTemp" placeholder="Maxiumum Tempeature(°C)" value="<?=$droneData['MaxTemp']?>" required>
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