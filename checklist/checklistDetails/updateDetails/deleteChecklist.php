<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 if(isset($POST['password'])&& isset($_POST['checklistID']))
 {
     header("location: " . $root);
 }
 require_once($root."php/checklist/checklistClass.php");


 require_once($root."php/user/userClass.php");
$user = new user();
$userDetails = $user->getUserDetails($_SESSION['user']);

if($user->userVerify($userDetails['Email'],$_POST['password']))
{
    $checklist = new checklist();
    $rChecklist = $checklist ->getChecklistOverview($_POST['checklistID']);
    if($rChecklist->num_rows > 0)
    {
        $data = $rChecklist->fetch_assoc();
        if($data['UserID'] == $_SESSION['user'])
        {
            if($checklist->deleteChecklist($_POST['checklistID']))
            {
                $msg = "Checklist Deleted!";
            }
            else {
                $msg = "Unable to Remove Checklist!";
            }
        }
        else 
        {
            $msg = "No Checklist Found!";
        }
    }
    else 
    {
        $msg = "No Checklist Found!";
    }

}
else 
{
    $msg = "Incorrect Password!";
}
?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            <h2 class="msgMain"><?=$msg?></h2>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>