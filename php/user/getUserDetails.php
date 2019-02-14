<?php
//
//used to get user's name for the login menu
//
require_once("/students/15080900/projectapp/php/user/userclass.php");
$user = new user();
if(isset($_SESSION['user']))
{
    
    $userDetails = $user->getUserDetails($_SESSION['user']);
    if($userDetails != null)
    {   //user details retrived
        $userDetailsAvailable = true;
    }
    else
    {
        //user logged in but no database connection
        $userDetailsAvailable = false;
        unset($_SESSION['user']);
    }
}
else
{
    //guest user
    $userDetailsAvailable = false;
    echo "guest";
}



?>