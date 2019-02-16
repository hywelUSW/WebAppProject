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
        $query->bind_param(i,$droneID);
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
    function getDroneHeaders(){
        
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("show columns from drone");
        $query->execute();
        
        $result = $query->get_result();
        print_r($result);
        while($row = $result->fetch_assoc())
        {
            print_r($row);
            echo "<br>";
        }
        
    }
}

?>