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
        return $query->get_result();
        
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
    //
    //update
    //
    function updateChecklist($droneID,$checklistName,$plannedDate,$descr,$checklistID)
    {
       
        $query = "UPDATE Checklist SET DroneID = ?, Checklistname = ?, PlannedDate = ?, Descr = ? WHERE ChecklistID = ?";
        $params = array("isssi",$droneID,$checklistName,$plannedDate,$descr,$checklistID);
        echo $descr;
        $db = new database();
        $result = $db->exQ($query,$params);
        
        if($result->affected_rows > 0)
        {
            return true;
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

    function updateLoadingList($checklistID,$opsManual,$maps,$TaskInfo,$safetyEquipment,$lipoBag,$controller,$equpmentCharged,$camera,$rpaPlatform,$propellers,$carryingCase,$permissionGranted)
    {
        $query = "UPDATE loadinglist SET  OpsManual = ?, Maps = ?, TaskInfo = ?, SafetyEquipment = ?,";
        $query .=  " LiPoBag = ?, Controller = ?,EquipmentCharged = ?,Camera = ?, RPAPlatform = ?, Propellers = ?,";
        $query .= " CarryingCase = ?, PermissionGranted = ? WHERE checklistID = ?";
        $params = array("siiiiiiiiiiiii",$WeatherCheck,$opsManual,$maps,$TaskInfo,$safetyEquipment,$lipoBag,$controller,$equpmentCharged,$camera,$rpaPlatform,$propellers,$carryingCase,$permissionGranted,$checklistID);
        $db = new database();
        
        $result = $db->exQ($query,$params);
        if($result->affected_rows > 0)
        {
            include_once("checklistAmendmentClass.php");
            $chkAmmend = new checklistAmenment(); 
            $chkAmmend->newAmendment($checklistID);
            return true;
        }else
        {
            return false;
        }
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

    function updatePreFlight($checklistID,$WeatherCheck,$SiteSurveyed,$RPASSService,$TakeOffAreaEstablished,$AssistantBriefed,$ContollerConnects,$RPADamageCheck,$BatteryCompartment,$RPAMotors,$CheckPropellers,$CheckCamera,$DronePowered,$DroneHomeLocked,$Calibrated,$CheckGroundStation,$VideoCheck,$TakeOffAreaClear,$TakeOffClearence,$AirspaceClear,$FitToFly)
    {
        
        $query = "UPDATE preflight SET WeatherCheck = ?, sitesurveyed = ?, rpassService =?, takeOffAreaEstablished = ?,AssistantBriefed = ?,";
        $query .= "ControllerConnects = ?,RPADamageCheck = ?,BatteryCompartment = ?,RPAMotors = ?,CheckPropellers = ?,";
        $query .= "CheckCamera = ?,DronePowered = ?,DroneHomeLocked = ?,Calibrated = ?,CheckGroundStation = ?,";
        $query .= "VideoCheck = ?,TakeOffAreaClear = ?,TakeOffClearence = ?,AirspaceClear = ?,FitToFly = ? WHERE ChecklistID = ?";
        $params = array("siiiiiiiiiiiiiiiiiiii",$WeatherCheck,$SiteSurveyed,$RPASSService,$TakeOffAreaEstablished,$AssistantBriefed,$ContollerConnects,$RPADamageCheck,$BatteryCompartment,$RPAMotors,$CheckPropellers,$CheckCamera,$DronePowered,$DroneHomeLocked,$Calibrated,$CheckGroundStation,$VideoCheck,$TakeOffAreaClear,$TakeOffClearence,$AirspaceClear,$FitToFly,$checklistID);
        $db = new database();
        
        $result = $db->exQ($query,$params);
        if($result->affected_rows > 0)
        {
            include_once("checklistAmendmentClass.php");
            $chkAmmend = new checklistAmenment(); 
            $chkAmmend->newAmendment($checklistID);
            return true;
        }else
        {
            return false;
        }
    }
    //
    //post take-off
    //
    function getPostTakeOff($checklistID)
    {
        $stmt = "SELECT posttakeoff.*,userID FROM posttakeoff ";
        $stmt .= "INNER JOIN checklist ON posttakeoff.checklistID = checklist.checklistID ";
        $stmt .= "WHERE posttakeoff.ChecklistID = ? LIMIT 1";
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
    function updatePostTakeOff($checklistID,$ControlSticksInner,$controllerResponds,$RPAStable,$takeOffTime,$cameraCheck)
    {
        //makes time value usable
        $tempDate = strtotime($takeOffTime);
        $takeOffTime = Date("Y-m-d H:m",$tempDate);
        echo $takeOffTime;
        $query = "UPDATE posttakeoff SET BothControlSticksInner = ?, ControllerResponds = ?,";
        $query .= " RPAStable = ?,TakeOffTime = ?,CameraCheck = ? WHERE checklistID = ?";
        $params = array("iiisii",$ControlSticksInner,$controllerResponds,$RPAStable,$takeOffTime,$cameraCheck,$checklistID);
        $db = new database();
        
        $result = $db->exQ($query,$params);
        
        if($result->affected_rows > 0)
        {
            include_once("checklistAmendmentClass.php");
            $chkAmmend = new checklistAmenment(); 
            $chkAmmend->newAmendment($checklistID);
            return true;
        }else
        {
            return false;
        }
    }
    //
    //pre landing
    //
    function getPreLanding($checklistID)
    {
        $stmt = "SELECT prelanding.*,userID FROM prelanding ";
        $stmt .= "INNER JOIN checklist ON prelanding.checklistID = checklist.checklistID ";
        $stmt .= "WHERE prelanding.ChecklistID = ? LIMIT 1";
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

    function updatePreLanding($checklistID,$landingAreaClear,$landType,$landingTime)
    {
        //makes time value usable
        $tempDate = strtotime($landingTime);
        $landingTime = Date("Y-m-d H:m",$tempDate);
        $query = "UPDATE prelanding SET LandingAreaClear = ?, ManualAutoLand = ?,";
        $query .= " LandingTimeRecorded = ? WHERE ChecklistID = ?";
        $params = array("iisi",$landingAreaClear,$landType,$landingTime,$checklistID);
        $db = new database();
        $result = $db->exQ($query,$params);
        if($result->affected_rows > 0)
        {
            include_once("checklistAmendmentClass.php");
            $chkAmmend = new checklistAmenment(); 
            $chkAmmend->newAmendment($checklistID);
            return true;
        }else
        {
            return false;
        }
    }
    //
    //post landing
    //
    function getPostLanding($checklistID)
    {
        $stmt = "SELECT postlanding.*,userID FROM postlanding ";
        $stmt .= "INNER JOIN checklist ON postlanding.checklistID = checklist.checklistID ";
        $stmt .= "WHERE postlanding.ChecklistID = ? LIMIT 1";
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

    function updatePostLanding($checklistID,$PowerDownRPA,$RemoveRPABattery,$RPABatteryOnCharge,$RPADamagedCheck,$PropellerCheck,$LandingGearCheck,$RecordFlightDetails,$CameraDataDownloaded,$ControllerOff,$EquipmentPacked,$AreaChecked)
    {
        $query = "UPDATE postlanding SET PowerDownRPA = ?, RemoveRPABattery = ?, RPABatteryOnCharge = ?, RPADamagedCheck = ?, ";
        $query .= "PropellerCheck = ?, LandingGearCheck = ?, RecordFlightDetails = ?, CameraDataDownloaded = ?, ";
        $query .= "ControllerOff = ?, EquipmentPacked = ?, AreaChecked = ? WHERE checklistID = ?";
        $params = array("iiiiiiiiiiii",$PowerDownRPA,$RemoveRPABattery,$RPABatteryOnCharge,$RPADamagedCheck,$PropellerCheck,$LandingGearCheck,$RecordFlightDetails,$CameraDataDownloaded,$ControllerOff,$EquipmentPacked,$AreaChecked,$checklistID);
        $db = new database();
        echo "test";
        $result = $db->exQ($query,$params);
        echo "end";
        if($result->affected_rows > 0)
        {
            include_once("checklistAmendmentClass.php");
            $chkAmmend = new checklistAmenment(); 
            $chkAmmend->newAmendment($checklistID);
            return true;
        }else
        {
            return false;
        }
    }
}
?>