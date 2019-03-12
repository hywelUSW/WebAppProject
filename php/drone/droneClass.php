<?php
session_start();
include_once("/students/15080900/projectapp/php/databaseClass.php");
class drone{


    function getDroneList($userID){
        
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * from drone WHERE UserID = ? ORDER BY DroneName");
        $query->bind_param("i",$userID);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0)
        {
            return $result;
        }
        else
        {
            return false;    
        }
    }

    function GetDroneOverview($droneID){
        $stmt = "SELECT DroneName,ModelName,manufacturer,MaxFlightTime,maxoperatingspeed,userID FROM Drone ";
        $stmt .= "INNER JOIN dronecharacteristics ON drone.droneID = dronecharacteristics.droneID ";
        $stmt .= "INNER JOIN dronedesignation ON drone.droneID = dronedesignation.droneID  WHERE drone.DroneID = ?";
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare($stmt);
        $query->bind_param("i",$droneID);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0)
        {
            $conn->close();
            return $result->fetch_assoc();
        }
        else
        {
            return false;    
        }
    }
    function getFullDetails($droneID,$userID){
        $stmt = "SELECT * FROM Drone ";
        $stmt .= "INNER JOIN dronedesignation ON drone.droneID = dronedesignation.droneID ";
        $stmt .= "INNER JOIN dronecharacteristics ON drone.droneID = dronecharacteristics.droneID ";
        $stmt .= "INNER JOIN environmentlimits ON drone.droneID = environmentlimits.droneID ";
        $stmt .= "INNER JOIN  payload ON drone.droneID = payload.droneID ";
        $stmt .= "INNER JOIN  techspecs ON drone.droneID = techspecs.droneID ";
        $stmt .= "INNER JOIN rpsspecs ON drone.droneID = rpsspecs.droneID ";
        $stmt .= "WHERE drone.DroneID = ? AND userID = ? LIMIT 1";
        
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare($stmt);
        $query->bind_param("ii",$droneID,$userID);
        $query->execute();
        return $query->get_result();
        
    }

    //
    //Main Data
    //
    function insertDroneMainData($userID,$droneName)
    {
        $query = "INSERT INTO drone (DroneName,UserID) VALUES (?,?)";
        $params = array("si",&$droneName,&$userID);
        
        $db = new database();
        
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        { 
            return $query->insert_id;
        }
        else
        {
            return false;
        }
        
    }
    function updateMainData($droneID,$DroneName)
    {
        $query = "UPDATE DRONE SET DroneName = ? WHERE DroneID = ?";
        $params = array("si",&$DroneName,&$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }

    }
    //
    //Designation
    //
    function addDesegnation($droneID,$modelName,$manufacturer,$droneType)
    {
        
        $query = "INSERT INTO dronedesignation VALUES (?,?,?,?)";
        $params = array("isss",&$droneID,&$modelName,&$manufacturer,&$droneType);
       
        $db = new database();
        
        $query = $db->exQ($query,$params);
        
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updateDesegnation($droneID,$modelName,$manufacturer,$droneType)
    {
        $query = "UPDATE dronedesignation SET modelname = ?,manufacturer = ?, dronetype = ? WHERE droneID = ? ";
        $params = array("sssi",$modelName,$manufacturer,$droneType,$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
    }
    //
    //Characteristics
    //
    function addCharacteristics($droneID,$flightModes,$maxOpSpeed,$launchType,$maxFlightTime)
    {
        $query = "INSERT INTO dronecharacteristics VALUES (?,?,?,?,?)";
        $params = array("isisi",&$droneID,&$flightModes,&$maxOpSpeed,&$launchType,&$maxFlightTime);
        $db = new database();
        $query = $db->exQ($query,$params);
        
        if($query->affected_rows > 0)
        {
            return true;
        }
        
        else
        {
            return false;
        }
    }
    function updateCharacteristics($droneID,$flightModes,$maxOpSpeed,$launchType,$maxFlightTime)
    {
        $query = "UPDATE dronecharacteristics SET FlightTypes = ?, maxOperatingSpeed = ?, LaunchType = ?, MaxFlightTime = ? WHERE droneID = ?";
        $params = array("sisii",$flightModes,$maxOpSpeed,$launchType,$maxFlightTime,$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
        
    }
    //
    //Environment Limits
    //
    function addEnvLimits($droneID,$maxHeight,$maxRadius,$maxWind,$TempRangeMin,$tempRangeMax,$opWeather)
    {
       $weather = implode(",",$opWeather);
        $query = "INSERT INTO environmentlimits VALUES (?,?,?,?,?,?,?)";
        $params = array("iiiiiis",&$droneID,&$maxHeight,&$maxRadius,&$maxWind,&$TempRangeMin,&$tempRangeMax,&$weather);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
  
    function updateEnvLimits($droneID,$maxHeight,$maxRadius,$maxWind,$tempRangeMin,$tempRangeMax,$opWeather)
    {
        //clear previous weather types
        //$this->clearWeatherTypes($droneID);
        
        $opWeather = implode(",",$opWeather);
        
        $query = "UPDATE environmentlimits SET MaxHeight = ?, MaxRadius = ?,MaxWind = ? ,TempRangeMin = ?, TempRangeMax = ?, OperatingWeather = ? WHERE DroneID = ?";
        $params = array("iiiiisi",&$maxHeight,&$maxRadius,&$maxWind,&$tempRangeMin,&$tempRangeMax,&$opWeather,&$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
    }
    
    //
    //Technical specifications
    //
    function addTechSpecs($droneID,$height,$width,$length,$weight,$maxTakeOffWeight,$motorType,$motorSpeed,$CDL,$VDL,$FC)
    {
        $query = "INSERT INTO techspecs VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $params = array("iiiiiisisss",$droneID,$height,$width,$length,$weight,$maxTakeOffWeight,$motorType,$motorSpeed,$CDL,$VDL,$FC);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updateTechSpecs($droneID,$height,$width,$length,$weight,$maxTakeOffWeight,$motorType,$motorSpeed,$CDL,$VDL,$FC)
    {
        $query = "UPDATE techspecs SET height = ?, width = ?, length = ?, Weight = ?, MaxTakeOffWeight = ?, ";
        $query .=  "MotorType = ?, MotorSpeed = ?, ControlDataLink = ?, VideoDataLink = ?, FlightController = ? WHERE DroneID = ?";
        $params = array("iiiiisisssi",$height,$width,$length,$weight,$maxTakeOffWeight,$motorType,$motorSpeed,$CDL,$VDL,$FC,$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
    }
    //
    //RPS Details
    //
    function addRPSDetails($droneID,$DL,$VL,$AntennaType)
    {
        $query = "INSERT INTO rpsspecs VALUES (?,?,?,?)";
        $params = array("isss",$droneID,$DL,$VL,$AntennaType);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updateRPSDetails($droneID,$DL,$VL,$AntennaType)
    {
        $query = "UPDATE rpsspecs SET DataLink = ?, VideoLink = ?, AntennaType = ? WHERE droneID = ?";
        $params = array("sssi",$DL,$VL,$AntennaType,$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
    }
    //
    //payload
    //
    function addPayloadDetails($droneID,$name,$minTemp,$maxTemp)
    {
        $query = "INSERT INTO payload VALUES (?,?,?,?)";
        $params = array("isss",$droneID,$name,$minTemp,$maxTemp);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function updatePayload($droneID,$name,$minTemp,$maxTemp)
    {
        $query = "UPDATE payload SET PayloadName = ?,MinTemp = ?,MaxTemp = ? WHERE DroneID = ?";
        $params = array("siii",$name,$minTemp,$maxTemp,$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else if($query->errno == 0)
        {
            return true;
        }
    }
    function isWeatherChecked($cond,$weather)
    {
        for($i = 0;$i < sizeof($weather);$i++)
        {
            if($cond == $weather[$i])
            {
                return "checked";
            }
        }
        
    }

    function deleteDrone($droneID)
    {
        $query = "DELETE FROM Drone WHERE droneID = ?";
        $params = array("i",$droneID);
        $db = new database();
        $query = $db->exQ($query,$params);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }

}

?>