<form method="POST" action="<?=$root?>php/drone/newDrone.php">
    <input type="text" name="DroneName" placeholder="name" required>
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
    <input type="text" name="OperatingWeather" placeholder="Operating Weather" required>
    <hr>
    <h4>Battery Specifications</h4>
    <input type="text" name="Chemistry" placeholder="Battery Chemistry" required>
    <br><br>
    <input type="number" name="BatteryWeight" placeholder="Weight (g)" required>
    <br><br>
    <input type="number" name="PowerOutput" placeholder="Power output (mAh)" required>
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
    <br><br>
    <button type="submit">Add Drone</button>
</form>