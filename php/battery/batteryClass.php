<?php
include_once("/students/15080900/projectapp/php/databaseClass.php");
class battery{
    
    function getBatteryList($userID)
    {
        $db = new database();
        $conn =$db->dbConnect();
        $query = $conn->prepare("SELECT * FROM battery WHERE UserID = ?");
        $query->bind_param("i",$userID);
        $query->execute();
        //print_R($query);
        return $query->get_result();
    }

    function newBattery($userID,$name,$modelNo,$serialNo,$weight,$chemistry,$powerOutput)
    {
        $query = "INSERT INTO battery (UserID,Name,ModelNo,SerialNo,Weight,Chemistry,PowerOutput) VALUES (?,?,?,?,?,?,?)";
        $params = array("isssisi",$userID,$name,$modelNo,$serialNo,$weight,$chemistry,$powerOutput);
        $db = new database();
        $result = $db->exQ($query,$params);
        print_r($result);
        if($result->affected_rows > 0)
        {
            return true;
        }
        return false;
    }
    function getBatteryDetails($batteryID)
    {
        $db = new database();
        $conn =$db->dbConnect();
        $query = $conn->prepare("SELECT * FROM battery WHERE batteryID = ? LIMIT 1");
        $query->bind_param("i",$batteryID);
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
    
    function getBatteryCharges($batteryID)
    {
        $db = new database();
        $conn =$db->dbConnect();
        $query = $conn->prepare("SELECT * FROM batterycharges WHERE batteryID = ? ORDER BY chargeDate DESC");
        $query->bind_param("i",$batteryID);
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
    function addCharge($batteryID,$userID)
    {   //verify user
        if($this->getBatteryList($userID))
        {
            $chargeNo = $this->getLatestCycle($batteryID) + 1;
            
            $query = "INSERT INTO batterycharges (BatteryID,chargeNo,chargeDate) VALUES (?,?,?)";
            $params = array("iis",$batteryID,$chargeNo,date("Y-m-d H:i:s"));
            $db = new database();
            $result = $db->exQ($query,$params);
            if($query->affected_rows > 0)
            {
                return true;
            }
        }
    }
    function getLatestCycle($batteryID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT MAX(chargeNo) as chargeNo FROM batterycharges WHERE batteryID = ?");
        $query->bind_param("i",$batteryID);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        if($row['chargeNo'])
        {
            return $row['chargeNo'];

        }
        else
        {//return 0 if not available
            return 0;
        }
    }

}

?>