<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 require_once("php/addNewDrone.php");
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
            <h3>Add new Drone</h3>
            <?php
            if($droneAdded)
            {
                echo "<h3 class='msg'>Drone Added!</h3>";
            }
            else
            { ?>
            <section>
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
                    <input type="number" name="MaxOperatingSpeed" placeholder="Maximum Operating Speed (m/s)" required>
                    <br><br>
                    <input type="text" name="LaunchType" placeholder="Launch Type" required>
                    <br><br>
                    <input type="number" name="maxFlightTime" placeholder="Maximum Flight Time (mins)" required>
                    <hr>
                    <h4>Airframe Specifications</h4>
                    <input type="number" name="MaxHeight" placeholder="Maximum Ceiling Height (m)" required>
                    <br><br>
                    <input type="number" name="MaxRadius" placeholder="Maximum Operating Radius (m)" required>
                    <br><br>
                    <input type="number" name="MaxWind" placeholder="Maximum Take Off  Wind (m/s)" required>
                    <br><br>
                    <input type="number" name="TempRangeMin" placeholder="Minumum Operating Temperature (°C)" required>
                    <br><br>
                    <input type="number" name="TempRangeMax" placeholder="Maximum Operating Temperature (°C)" required>
                    <br><br>
                   <!-- <input type="text" name="OperatingWeather" placeholder="Operating Weather" required>-->
                    <div>
                        <h4>Operating conditions</h4>
                        <label>Thunderstorm</label><input type="checkbox" name="OperatingWeather[]" value="Thunderstorm"><br>
                        <label>Light rain</label><input type="checkbox" name="OperatingWeather[]" value="drizzle"><br>
                        <label>rain</label><input type="checkbox" name="OperatingWeather[]" value="rain"><br>
                        <label>snow</label><input type="checkbox" name="OperatingWeather[]" value="snow"><br>
                        <label>fog</label><input type="checkbox" name="OperatingWeather[]" value="atmosphere"><br>
                        <label>clear</label><input type="checkbox" name="OperatingWeather[]" value="clear"><br>
                        <label>cloudy</label><input type="checkbox" name="OperatingWeather[]" value="cloudy"><br>
                    </div>
                    <hr>
                    <h4>Technical Specifications</h4>
                    <input type="Number" name="Height" placeholder="Height (mm)" required>
                    <br><br>
                    <input type="number" name="Width" placeholder="Width (mm)" required>
                    <br><br>
                    <input type="number" name="Length" placeholder="Length (mm)" required>
                    <br><br>
                    <input type="number" name="Weight" placeholder="Weight (g)" required>
                    <br><br>
                    <input type="number" name="MaxTakeOffWeight" placeholder="Maximum Take Off Weight (g)" required>
                    <br><br>
                    <input type="number" name="MotorType" placeholder="Motor Type" required>
                    <br><br>
                    <input type="number" name="MotorSpeed" placeholder="Motor Speed (RPM)" required>
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
                    <input type="number" name="PayloadMinTemp" placeholder="Minimum Temperature (°C)" required>
                    <br><br>
                    <input type="number" name="PayloadMaxTemp" placeholder="Maxiumum Tempeature (°C)" required>
                    <p><?=$errMsg?></p>
                    <button class="btnMain" type="submit">Add Drone</button>
                </form>
            <section>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>