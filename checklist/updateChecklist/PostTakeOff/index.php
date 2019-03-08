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
if(array_filter($_POST) && isset($_SESSION['user']))
{
    
    if($checklist->updatePostTakeOff($_GET['checklistID'],$_POST['BothControlSticksInner'],$_POST['ControllerResponds'],$_POST['RPAStable'],$_POST['TakeOffTime'],$_POST['CameraCheck']))
    {
        $result = $checklist->getPostTakeOff($_GET['checklistID']);
        
    }
    else
    {
        
        $errMsg = "There was an error updaing the checklist!";
    }
}

//parse date to usable format
if(isset($result['TakeOffTime']))
{
    $takeoffTime = date("Y-m-d\TH:i:s",strtotime($result['TakeOffTime']));
}


?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://momentjs.com/downloads/moment.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            <h2>Post-Take Off</h2>
            <p><?=$errMsg?></p>
            <form method='post'>
                <input type='hidden' name='BothControlSticksInner' value='0'>
                <label>Drone Starts at Idle Speed</label><input type="checkbox" name="BothControlSticksInner" value='1' <?=$checklist->ischecked($result["BothControlSticksInner"])?>>
                <hr>
                <input type='hidden' name='ControllerResponds' value='0'>
                <label>Drone Responds to Controller Input</label><input type="checkbox" name="ControllerResponds" value='1' <?=$checklist->ischecked($result["ControllerResponds"])?>>
                <hr>
                <input type='hidden' name='RPAStable' value='0'>
                <label>Drone Stable at 3m</label><input type="checkbox" name="RPAStable" value='1' <?=$checklist->ischecked($result["RPAStable"])?>>
                <hr>
                
                <label>Take off Time</label>
                <div id="timeDate">
                <input type="datetime-local" name="TakeOffTime" value="<?=$takeoffTime?>">
                <button type="button" id="getTakeOffTime">Get Take Off Time</button><br><br>
</div>
                
                <hr>
                <input type='hidden' name='CameraCheck' value='0'>
                <label>Camera functioning correctly</label><input type="checkbox" name="CameraCheck" value='1' <?=$checklist->ischecked($result["CameraCheck"])?>>
                <br><br>
                <div class="btnWrapper">
                <button class="btnMain" type="submit">Update</button><br><br>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button  class="btnMain" type="button">Cancel</button></a>
                </div>
            </form>
            
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>
<script src="js/script.js"></script>