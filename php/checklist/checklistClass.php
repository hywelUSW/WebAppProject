<?php
include_once("../databaseClass.php");
class checklist{

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
    //get checklists peformed by a specific drone
    function getDroneChecklists($droneID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE DroneID = ?");
        $query->bind_param("i",$droneID);
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
    //Get details of specific checklist
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


    function newChecklist()
    {
        //check that date is correct
        if(date("Y-m-d") < $date)
        {
            $query = ("INSERT INTO CHECKLIST (UserID,DroneID,ChecklistName,PlannedDate,Descr) VALUES (?,?,?,?,?)");
            $params = array ("iisss",$userID,$droneID,$name,$date,$desc);
            $db = new database();
            $query = $db->exQ($query,$params);
            if($query->affected_rows > 0)
            {
                print_r($query);
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
}


?>