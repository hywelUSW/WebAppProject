<?php
include_once("/students/15080900/projectapp/php/databaseClass.php");
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
    function getChecklistOverview($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE ChecklistID = ? LIMIT 1");
        $query->bind_param("i",$checklistID);
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

    //Create new checklist and initalises the subtypes
    function newChecklist($userID,$droneID,$name,$date,$desc)
    {
        
        $db = new database();
        //check that date is correct
        if(date("Y-m-d") < $date)
        {
            $query = "INSERT INTO CHECKLIST (UserID,DroneID,ChecklistName,PlannedDate,Descr) VALUES (?,?,?,?,?)";
            $params = array("iisss",$userID,$droneID,$name,$date,$desc);
            $result = $db->exQ($query,$params);
            if($result->affected_rows > 0)
            {//insert subtypes
                $checklistID = $result->insert_id;
                $params = array("i",$checklistID);
                //LoadingList
                $query = "INSERT INTO loadinglist (ChecklistID) VALUES (?)";
                $result = $db->exQ($query,$params);
                if($result->affected_rows > 0)
                {//PreFlight
                    $query = "INSERT INTO preflight (ChecklistID) VALUES (?)";
                    $result = $db->exQ($query,$params);
                    if($result->affected_rows > 0)
                    {//post take off
                        $query = "INSERT INTO posttakeoff (ChecklistID) VALUES (?)";
                        $result = $db->exQ($query,$params);
                        if($result->affected_rows > 0)
                        {//pre landing
                            $query = "INSERT INTO prelanding (ChecklistID) VALUES (?)";
                            $result = $db->exQ($query,$params);
                            if($result->affected_rows > 0)
                            {//post landing
                                $query = "INSERT INTO postlanding (ChecklistID) VALUES (?)";
                                $result = $db->exQ($query,$params);
                                if($result->affected_rows > 0)
                                {
                                    //insert amendment
                                   include_once("checklistAmendmentClass.php");
                                   $chkAmmend = new checklistAmenment(); 
                                   $chkAmmend->newAmendment($checklistID);
                                   return $checklistID;
                                }
                            }
                        }
                    }
                }
            }
            if(!$inserted)
            {   //failed to insert subtype
                $this->deleteChecklist($checklistID);
                return "There was an error creating the checklist!";
            }
        }
        else
        {
            //wrong date
            return "Invalid date!";
        }
        
    }
    //Delete checklist
    function deleteChecklist($checklistID)
    {
        $query = "DELETE FROM checklist WHERE checklistID = ?";
        $params = array("i",$checklistID);
        $result = $db->exQ($query,$params);
    }
    //check if item needs to have checked attribute
    function isChecked($value)
    {
        
        if($value == 1)
        {
            return "checked";
        }
        else {
            return null;
        }
       
    }
    //
    //LoadingList
    //
    function getLoadingList($checklistID)
    {
        
        $stmt = "SELECT loadinglist.*,userID FROM loadinglist ";
        $stmt .= "INNER JOIN checklist ON loadinglist.checklistID = checklist.checklistID ";
        $stmt .= "WHERE loadinglist.ChecklistID = ? LIMIT 1";
       $db = new database();
       $conn = $db->dbConnect();
       $query = $conn->prepare($stmt);
       $query->bind_param("i",$checklistID);
       $query->execute();
       $result = $query->get_result();
       if($result->num_rows > 0)
       {
           return $result->fetch_assoc();
       }
       else
       {
           return false;
       }
    }

    function updateLoadingList($checklistID,$WeatherCheck,$opsManual,$maps,$TaskInfo,$safetyEquipment,$lipoBag,$controller,$equpmentCharged,$camera,$rpaPlatform,$propellers,$carryingCase,$permissionGranted)
    {
        $query = "UPDATE loadinglist SET weathercheck = ?, opsmanual = ?, maps = ?, taskinfo = ?, safetyequipment = ?,";
        $query .=  "lipobag = ?, controller = ?,equipmentcharged = ?,camera = ?, rpaplatform = ?, propellers = ?,";
        $query .= "carryingcase = ?, permissiongranted = ? WHERE checklist = ?";
        $params = array("siiiiiiiiiiiii",$WeatherCheck,$opsManual,$maps,$TaskInfo,$safetyEquipment,$lipoBag,$controller,$equpmentCharged,$camera,$rpaPlatform,$propellers,$carryingCase,$permissionGranted,$checklistID);
        $db = new database();
        $result = $db->exQ($query,$params);
        print_r($result);
    }
    //
    //pre-flight
    //
    function getPreFlight($checklistID)
    {
        $stmt = "SELECT preflight.*,userID FROM preflight ";
        $stmt .= "INNER JOIN checklist ON preflight.checklistID = checklist.checklistID ";
        $stmt .= "WHERE preflight.ChecklistID = ? LIMIT 1";
       $db = new database();
       $conn = $db->dbConnect();
       $query = $conn->prepare($stmt);
       $query->bind_param("i",$checklistID);
       $query->execute();
       $result = $query->get_result();
       if($result->num_rows > 0)
       {
           return $result->fetch_assoc();
       }
       else
       {
           return false;
       }
    }

    function updatePreFlight()
    {

    }
    //
    //post take-off
    //
    function getPostTakeOff($checklistID)
    {

    }
    function updatePostTakeOff()
    {

    }
    //
    //pre landing
    //
    function getPreLanding($checklistID)
    {

    }

    function updatePreLanding()
    {

    }
    //
    //post landing
    //
    function getPostLanding($checklistID)
    {

    }

    function updatePostLanding()
    {

    }
}
?>