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
        echo $userDetails['Name'];
    }
    else
    {
        //user logged in but no database connection
        echo "User";
    }
}
else
{
    //guest user
    echo "guest";
}


?>