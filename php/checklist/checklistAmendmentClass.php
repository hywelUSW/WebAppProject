<?php
include_once("../databaseClass.php");
class checklistAmenment{

    function newAmendment($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $amendmendNo = getLatestAmmendment($checklistID);
        $query = $conn->prepare("INSERT INTO ChecklistAmendment VALUES (?,?,?);");
        $query->bind_param("iis",$checklistID,$amendmendNo,date("Y-m-d H:i:s"));

        
    }
    function getLatestAmmendment($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT MAX(amendmentNo) as amendNo FROM checklistAmendment WHERE checklistID = ?");
        $query->bind_param("i",$checklistID);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        if($row['amendNo'])
        {
            return $row['ammendNo'] + 1;

        }
        else
        {
            return 1;
        }

        
    }
}
$a = new checklistAmenment();
$a->getLatestAmmendment(3);

?>