<?php
class database{

    function dbConnect(){
        //connection variables
        require("dbCredentials.php");
        $conn = new mysqli($server,$username,$password,$database);
        if($conn->connect_error){
            die("Unable to connect to Database!");
        }
       return $conn;
    }
    
    function test(){
        $x = $this->dbConnect();
        print_r($x);
    }
    function exQ($query,$params)
    {
        $conn = $this->dbConnect();
        $query = $conn->prepare($query);
        call_user_func_array(array($query, 'bind_param'), $params);
        $query->execute();
        if($query->affected_rows > 0)
        {
           return $query;
        }
        else
        {
            return false;
        }

    }
    
}


?>