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
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM Drone WHERE DroneID = ?");
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
        
        
        $query = "INSERT INTO drone (DroneName,UserID) VALUES (?,?)";
        $types = "si";
        $params = array("si",&$droneName,&$userID);
        $db = new database();
        $conn = $db->exQ($query,$types,$params);
        echo "<br>";
        print_r($conn);
        
        /*
        $query = $conn->prepare("INSERT INTO drone (DroneName,UserID) VALUES (?,?)");
        $query->bind_param("si",$droneName,$userID);
        $query->execute();
        if($query->affected_rows >0)
        {
           return $query->insert_id;
        }
        else
        {
            return false;
        }*/
        
    }
/*
    function addDesegnation($DroneID,$modelName,$manufacturer,$droneType)
    {
        $db = new database();
        $conn = $db->dbConnect();
    }*/




}

?>