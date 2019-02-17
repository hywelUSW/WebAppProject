<?php
include_once("../databaseClass.php");
class checklist{

    function newChecklist()
    {
        //check that date is correct
        if(date("Y-m-d") < $date)
        {
            $db = new database();
            $conn = $db->dbConnect();
    
            $query = $conn->prepare("INSERT INTO CHECKLIST VALUES (?,?,?,?,?");
            $query->bind_param("iisss",$userID,$droneID,$name,$date,$desc);
            $query->execute();
            if($query->affected_rows > 0)
            {

            }
            else
            {
                return false;
            }
        }
        else
        {
            //wrong date
            return false;
        }
        
    }
    function getUserChecklists($UserID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE UserID = ? ORDER BY PlannedDate");
        $query->bind_param("i",$UserID);
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
    function getDroneChecklists($droneID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE DroneID = ?");
        $query->bind_param("i",$ChecklistID);
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

    function getChecklistOverview($ChecklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE ChecklistID = ? LIMIT 1");
        $query->bind_param("i",$ChecklistID);
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
}


?>