<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 require_once($root."php/drone/droneClass.php");
 //check login
 if(!isset($_SESSION['user']))
 {
    header("location:".$root);
    die();
 }
 
$drone = new drone();
if(array_filter($_POST) && isset($_SESSION['user']))
{   
    $droneData = array_filter($_POST);
    
    $droneID = $drone->insertDroneMainData($_SESSION['user'],$droneData['DroneName']);
    if($droneID)
    {
        //insert drone designation
        if($drone->addDesegnation($droneID,$droneData['ModelName'],$droneData['Manufacturer'],$droneData['DroneType']))
        {   //insert drone characteristics
            if($drone->addCharacteristics($droneID,$droneData['FlightModes'],$droneData['MaxOperatingSpeed'],$droneData['LaunchType'],$droneData['maxFlightTime']))
            {   //insert environmental limits
                
                if($drone->addEnvLimits($droneID,$droneData['MaxHeight'],$droneData['MaxRadius'],$droneData['MaxWind'],$droneData['TempRangeMin'],$droneData['TempRangeMax'],$droneData['OperatingWeather']))
                {  //insert tech specs
                    if($drone->addTechSpecs($droneID,$droneData['Height'],$droneData['Width'],$droneData['Length'],$droneData['Weight'],$droneData['MaxTakeOffWeight'],$droneData['MotorType'],$droneData['MotorSpeed'],$droneData['ControlDataLink'],$droneData['VideoDataLink'],$droneData['FlightController']))
                    {   //insert remote pilot station details
                        if($drone->addRPSDetails($droneID,$droneData['DataLink'],$droneData['VideoLink'],$droneData['AntennaType']))
                        {   //insert payload
                            if($drone->addPayloadDetails($droneID,$droneData['PayloadName'],$droneData['PayloadMinTemp'],$droneData['PayloadMaxTemp']))
                            {
                            $droneAdded = true;
                            }
                        }
                    }
                }

            }

        }
        //delete records if a partial faliure occoured
        if(!droneAdded)
        {
            if($droneID)
            {
                $drone->deleteDrone($droneID);
            }
            $errMsg = "There was an error adding the drone!";
        }
    }
    else {
        $errMsg = "There was an error adding the drone!";
    }
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
            <h3>Add new Drone</h3>
            <?php
            if($droneAdded)
            {
                echo "<h3 class='msg'>Drone Added! <a href='$root/drone/droneDetails?DroneID=$droneID'>Click here</a> to view the drone details</h3>";
            }
            else
            { ?>
            <section>
            <p><?=$errMsg?></p>
            
                <form method="POST"  enctype="multipart/form-data">
                <input type="text" name="DroneName"  maxLength="40" placeholder="name" value="<?=$_POST['DroneName']?>" required>
                    
                    <hr>
                    <h4>Drone Designation</h4>
                    <input type="text" name="ModelName"  maxLength="40" placeholder="Model Name" value="<?=$_POST['ModelName']?>" required>
                    <br><br>
                    <input type="text" name="Manufacturer"  maxLength="40" placeholder="Manufacturer" value="<?=$_POST['Manufacturer']?>" required>
                    <br><br>
                    <input type="text" name="DroneType"   maxLength="40"placeholder="Drone Type" value="<?=$_POST['DroneType']?>" required>
                    <hr>
                    <h4>Flight Characteristics</h4>
                    <input type="text" name="FlightModes"  maxLength="40" placeholder="Operating Modes" value="<?=$_POST['FlightModes']?>" required>
                    <br><br>
                    <input type="number" name="MaxOperatingSpeed" placeholder="Max Speed(m/s)" value="<?=$_POST['MaxOperatingSpeed']?>" required>
                    <br><br>
                    <input type="text" name="LaunchType"  maxLength="40" placeholder="Launch Type" value="<?=$_POST['LaunchType']?>" required>
                    <br><br>
                    <input type="number" name="maxFlightTime" placeholder="Flight Time(mins)" value="<?=$_POST['maxFlightTime']?>" required>
                    <hr>
                    <h4>Airframe Specifications</h4>
                    <input type="number" name="MaxHeight" placeholder="Max Ceiling Height(m)" value="<?=$_POST['MaxHeight']?>" required>
                    <br><br>
                    <input type="number" name="MaxRadius" placeholder="Operating Radius(m)" value="<?=$_POST['MaxRadius']?>" required>
                    <br><br>
                    <input type="number" name="MaxWind" placeholder="Max Surface Wind(m/s)" value="<?=$_POST['MaxWind']?>" required>
                    <br><br>
                    <input type="number" name="TempRangeMin" placeholder="Min Operating Temperature(°C)" value="<?=$_POST['TempRangeMin']?>" required>
                    <br><br>
                    <input type="number" name="TempRangeMax" placeholder="Max Operating Temperature(°C)" value="<?=$_POST['TempRangeMax']?>" required>
                    <hr>
                    <div>
                        <h4>Operating conditions</h4>
                        <label>Thunderstorm</label><input type="checkbox" name="OperatingWeather[]" value="Thunderstorm" <?=$drone->isWeatherChecked("Thunderstorm",$_POST['OperatingWeather'])?>  ><hr>
                        <label>Light rain</label><input type="checkbox" name="OperatingWeather[]" value="Drizzle" <?=$drone->isWeatherChecked("Drizzle",$_POST['OperatingWeather'])?>  ><hr>
                        <label>Rain</label><input type="checkbox" name="OperatingWeather[]" value="Rain" <?=$drone->isWeatherChecked("Rain",$_POST['OperatingWeather'])?>  ><hr>
                        <label>Snow</label><input type="checkbox" name="OperatingWeather[]" value="Snow" <?=$drone->isWeatherChecked("Snow",$_POST['OperatingWeather'])?>   ><hr>
                        <label>Fog</label><input type="checkbox" name="OperatingWeather[]" value="Atmosphere" <?=$drone->isWeatherChecked("Atmosphere",$_POST['OperatingWeather'])?>   >><hr>
                        <label>Clear</label><input type="checkbox" name="OperatingWeather[]" value="Clear" <?=$drone->isWeatherChecked("Clear",$_POST['OperatingWeather'])?>  ><hr>
                        <label>Cloudy</label><input type="checkbox" name="OperatingWeather[]" value="Cloudy" <?=$drone->isWeatherChecked("Cloudy",$_POST['OperatingWeather'])?>   ><br>
                    </div>
                    <br>
                    <hr>
                    <h4>Technical Specifications</h4>
                    <input type="Number" name="Height" placeholder="Height(mm)" value="<?=$_POST['Height']?>" required>
                    <br><br>
                    <input type="number" name="Width" placeholder="Width(mm)" value="<?=$_POST['Width']?>" required>
                    <br><br>
                    <input type="number" name="Length" placeholder="Length(mm)" value="<?=$_POST['Length']?>" required>
                    <br><br>
                    <input type="number" name="Weight" placeholder="Weight(g)" value="<?=$_POST['Weight']?>" required>
                    <br><br>
                    <input type="number" name="MaxTakeOffWeight" placeholder="Max Take Off Weight(g)" value="<?=$_POST['MaxTakeOffWeight']?>"  required>
                    <br><br>
                    <input type="text" name="MotorType" placeholder="Motor Type" value="<?=$_POST['MotorType']?>" required>
                    <br><br>
                    <input type="number" name="MotorSpeed" placeholder="Motor Speed(KV)" value="<?=$_POST['MotorSpeed']?>" required>
                    <br><br>
                    <input type="text" name="ControlDataLink"  maxLength="40" placeholder="Control Data Link" value="<?=$_POST['ControlDataLink']?>" required>
                    <br><br>
                    <input type="text" name="VideoDataLink"  maxLength="40" placeholder="Video Data Link" value="<?=$_POST['VideoDataLink']?>" required>
                    <br><br>
                    <input type="text" name="FlightController"  maxLength="40" placeholder="Flight Controller" value="<?=$_POST['FlightController']?>" required>
                    <hr>
                    <h4>Remote Pilot Station Specifications</h4>
                    <input type="text" name="DataLink"  maxLength="40" placeholder="Data Link" value="<?=$_POST['DataLink']?>" required>
                    <br><br>
                    <input type="text" name="VideoLink"  maxLength="40" placeholder="Video Link" value="<?=$_POST['VideoLink']?>" required>
                    <br><br>
                    <input type="text" name="AntennaType"  maxLength="40" placeholder="Antenna Type" value="<?=$_POST['AntennaType']?>" required>
                    <hr>
                    <h4>Payload Details (Optional)</h4>
                    <input type="text" name="PayloadName"  maxLength="40" placeholder="Payload Name" value="<?=$_POST['PayloadName']?>" >
                    <br><br>
                    <input type="number" name="PayloadMinTemp" placeholder="Minimum Temperature(°C)" value="<?=$_POST['PayloadMinTemp']?>" >
                    <br><br>
                    <input type="number" name="PayloadMaxTemp" placeholder="Maxiumum Tempeature(°C)" value="<?=$_POST['PayloadMaxTemp']?>" >
                    
                    <br><br>
                    <button class="btnMain" type="submit">Add Drone</button><br><br>
                    <a href="../"><button class="btnMain" type="button">Cancel</button></a>
                </form>
                
            <section>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>*/
