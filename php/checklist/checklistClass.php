<?php
include_once("../databaseClass.php");
class checklist{

    function newChecklist()
    {
        $db = new database();
        $conn = $db->dbConnect();

        $query = $conn->prepare("INSERT INTO CHECKLIST VALUES (?,?,?,?,?");
        $query->bind_param("iisss",$userID,$droneID,$name,date("Y-m-d H:i:s"),$desc);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0)
        {
            
        }
    }
    function getUserChecklists($UserID)
    {
        $db = new database();
        $conn = $db->dbConnect();
        $query = $conn->prepare("SELECT * FROM checklist WHERE UserID = ? ORDEY BY dateCreated");
        $query->bind_para("i",$UserID);
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