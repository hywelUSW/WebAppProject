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
       
    
}


?>