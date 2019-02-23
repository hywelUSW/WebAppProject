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
    function exQ($queryString,$params)
    {
        $conn = $this->dbConnect();
        $query = $conn->prepare($queryString);
        call_user_func_array(array($query, 'bind_param'), $params);
        $query->execute();
        if($query->errno == 0)
        {
           $conn->close();
            return $query;
        }
        else
        {
            echo "false";
            return false;
        }

    }
    
}


?>