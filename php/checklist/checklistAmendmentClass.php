<?php
include_once("../databaseClass.php");
class checklistAmenment{

    //create an ammendment
    function newAmendment($checklistID)
    {
        $db = new database();
        //get latest ammendment No
        $amendmendNo = $this->getLatestAmmendment($checklistID);
        $query = "INSERT INTO ChecklistAmendment VALUES (?,?,?)";
        $params = array("iis",$checklistID,($amendmendNo+1),date("Y-m-d H:i"));
        $result = $db->exQ($query,$params);
        return $result;
        
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
            return $row['amendNo'];

        }
        else
        {//return 0 if not available
            return 0;
        }
    }

    //get all amendments belonging to a checklist
    function selectChecklistAmendments($checklistID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * from checklistAmendment WHERE checklistID = ?");
        $query->bind_param("i",$checklistID);
        $query->execute();
        $result = $query->get_result();
        return $result;
    }
}

$a = new checklistAmenment();
$a->selectChecklistAmendments(3);
//$b = $a->getLatestAmmendment(3);
echo $b;

?>