<?php
include_once("../databaseClass.php");
class checklistAmenment{

    function newAmendment($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("INSERT INTO ChecklistAmendment VALUES (?,?,?);");
        $query->bind_param("iis",$checklistID,$amendmendNo,date("Y-m-d H:i:s"));

        
    }
    function getLatestAmmendment($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT MAX(amendmentNo) FROM checklistamendment WHERE amendmentNo = ?");
        $query->bind_param("i",$checklistID);
        $query->execute();
        if($query->num_rows > 0 && $query->errno = 0)
        {
            $result = $query->get_result();
            
        }
        else
        {
            //no value/bad query
            
            return 0;  
        }

        
    }
}
$a = new checklistAmenment();
$a->getLatestAmmendment(1);

?>