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

    //
    //INSERT QUERIES
    //
    function insertDroneMainData($userID,$droneName)
    {
        echo "test";
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
    function addCharacteristics($droneID,$flightModes,$maxOpSpeed,$launchType,$maxFlightTime)
    {
        $query = "INSERT INTO dronecharacteristics VALUES (?,?,?,?,?)";
        $params = array("isisi",&$droneID,&$flightModes,&$maxOpSpeed,&$launchType,&$maxFlightTime);
        $db = new database();
        $query = $db->exQ($query,$params);
        print_r($query);
        if($query->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function addEnvLimits($droneID,$maxHeight,$maxRadius,$maxWind,$TempRangeMin,$tempRangeMax,$opWeather)
    {
        $query = "INSERT INTO environmentlimits VALUES (?,?,?,?,?,?,?)";
        $params = array("iiiiiis",&$droneID,&$maxHeight,&$maxRadius,&$maxWind,&$TempRangeMin,&$tempRangeMax,&$opWeather);
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

    function addBatterySpecs($droneID,$weight,$chem,$output)
    {
        $query = "INSERT INTO batteryspec VALUES (?,?,?,?)";
        $params = array("iisi",$droneID,$weight,$chem,$output);
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




}

?>