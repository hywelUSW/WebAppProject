<?php
    session_start();
    include_once("/students/15080900/projectapp/php/databaseClass.php");
    class user{
        //user register
        function newUser($email,$name,$password){
            $database = new database();
            $conn = $database->dbConnect();
            
            //prepared statement
            $query = $conn->prepare("INSERT INTO User (Email,Name,Password) VALUES (?,?,?)");
            $password = password_hash($password,PASSWORD_BCRYPT);
            $query->bind_param("sss",$email,$name,$password);
            if($query->execute())
            {
                //user account created
                $_SESSION['user'] = $query->insert_id;
                $conn->close();
                return true;
            }
            else
            {
                $conn->close();
                //couldnt be created(likley duplicate email)
                return false;
            }
        }

        //retreive the user details
        function getUserDetails($userID){
            $database = new database();
            $conn = $database->dbConnect();
             $query = $conn->prepare("SELECT * FROM user where UserID = ? LIMIT 1");
             $query->bind_param("i",$userID);
             $query->execute();
            
             $result = $query->get_result();
             if($result->num_rows > 0)
             {
                 $conn->close();
                return $result->fetch_assoc();
             }
             else 
             {
                $conn->close();
                 return null;
             }
        }

        //check if user details are correct
        function userVerify($Email,$Password){
            $database = new database();
            $conn = $database->dbConnect();
             $query = $conn->prepare("SELECT * FROM user where Email = ? LIMIT 1");
             $query->bind_param("s",$Email);
             $query->execute();
             $result = $query->get_result();
             if($result->num_rows > 0)
             {
                $result = $result->fetch_assoc();
                
                
                if(password_verify($Password,$result['Password']))
                {
                    //login successful
                    $_SESSION['user'] = $result['UserID'];
                    $conn->close();
                    return true;
                }
                else 
                {
                    //bad password
                    $conn->close();
                    return false;
                }
             }
            else
            {
                 //user doesnt exist
                 $conn->close();
                 return false;
             }
        }

        //update the user details
        function updateDetails($email,$name,$password,$newPassword)
        {
            $database = new database();
            $conn = $database->dbConnect();
            //check for password
            if($newPassword == null)
            {   //checks if new password was entered
                $newPassword = $password;
            }
            
            $newPassword = password_hash($newPassword,PASSWORD_BCRYPT);
            $query = $conn->prepare("UPDATE user SET email = ?, name = ?, password = ? WHERE email = ?");
            $query->bind_param("ssss",$email,$name,$newPassword,$email);
            $query->execute();
            if($query->affected_rows==1)
            {//Query successfull
                return true;
            }
            else {
                //Query unsuccessful
                return false;
            }
            
        }

        //Delete user and all their details
        function removeUser($UserID)
        {
            $query = $conn->prepare("DELETE FROM user WHERE UserID = ?");
            $query->bind_param("i",$UserID);
            $query->execute();
            if($query->affected_rows > 0)
            { //query successfull
                return true;
            }
            else{
                //query failed
                return false;
            }
            return false;
        }
            
}

?>