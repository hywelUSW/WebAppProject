<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getPostTakeOff($_GET['checklistID']);
//check user owns checklist
if($result['userID'] != $_SESSION['user'])
{
   header("location: ".$root."checklist/");
   die();
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
            <h2>Pre-Flight</h2>
            <form method='post'>
                <input type='hidden' name='BothControlSticksInner' value='0'>
                <label>Drone Starts at Idle Speed</label><input type="checkbox" name="BothControlSticksInner" <?=$checklist->ischecked($result["BothControlSticksInner"])?>>
                <br><br>
                <input type='hidden' name='ControllerResponds' value='0'>
                <label>Drone Responds to Controller Input</label><input type="checkbox" name="ControllerResponds" <?=$checklist->ischecked($result["ControllerResponds"])?>>
                <br><br>
                <input type='hidden' name='RPAStable' value='0'>
                <label>Drone Stable at 3m</label><input type="checkbox" name="RPAStable" <?=$checklist->ischecked($result["RPAStable"])?>>
                <br><br>
                <label>Take off Time</label><input type="datetime-local" name="TakeOffTime">
                <br><br>
                <input type='hidden' name='CameraCheck' value='0'>
                <label>Camera functioning correctly</label><input type="checkbox" name="CameraCheck" <?=$checklist->ischecked($result["CameraCheck"])?>>
                <br><br>
                <button type="submit">Update</button>
                <a href="checklist/checklistdetails/?checklistID="><button>Cancel</button></a>
            </form>
            
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>