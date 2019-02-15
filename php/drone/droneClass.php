<?php
session_start();
include_once("/students/15080900/projectapp/php/databaseClass.php");
class drone{


    function getDroneList($userID){
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT DroneID,DroneName from Drone WHERE UserID = ? ORDER BY DroneName");
        $query->bind_param("i",$userID);
        $query->execute();
        if($query->num_rows > 0)
        {
            $conn->close();
            return $result->fetch_assoc();
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
        $query->bind_param(i,$droneID);
        $query->execute();
        if($query->num_rows > 0)
        {
            $conn->close();
            return $result->fetch_assoc();
        }
        else
        {
            return false;    
        }
    }
}


?>