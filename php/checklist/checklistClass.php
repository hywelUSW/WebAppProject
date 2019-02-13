<?php
include_once("../databaseClass.php");
class checklist{

    function newChecklist()
    {
        $db = new database($userID,$droneID,$name,$desc);
        $conn = $db->dbConnect();
        $query = $conn->prepare("INSERT INTO CHECKLIST VALUES (?,?,?,?,?");
        $query->bind_param("iisss",$userID,$droneID,$name,date("Y-m-d H:i:s"),$desc);
        $query->execute();
        if($query->affected_rows > 0)
        {
            
        }
    }
}


?>