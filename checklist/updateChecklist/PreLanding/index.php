<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 require_once("/students/15080900/projectapp/php/checklist/checklistClass.php");
$checklist = new checklist();
$result = $checklist->getPreLanding($_GET['checklistID']);
//check user owns checklist
if($result['userID'] != $_SESSION['user'])
{
   header("location: ".$root."checklist/");
   die();
}

if(array_filter($_POST) && isset($_SESSION['user']))
{
   
    if($checklist->updatePreLanding($_GET['checklistID'],$_POST['LandingAreaClear'],$_POST['ManualAutoLand'],$_POST['LandingTimeRecorded']))
    {
        
        $result = $checklist->getPreLanding($_GET['checklistID']);
        $msg = "Checklist updated!";
    }
    else
    {
        $msg = "There was an error updaing the checklist!";
    }
}
//parse date to usable format
$landingTime = date("Y-m-d\TH:i:s",strtotime($result['LandingTimeRecorded']));
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
            <h2>Pre-Landing</h2>
            <p><?=$msg?></p>
            <form method='post'>
                <input type='hidden' name='LandingAreaClear' value='0'>
                <label>Landing Area Clear</label><input type="checkbox" name="LandingAreaClear" value='1' <?=$checklist->ischecked($result["LandingAreaClear"])?>>
                <hr>
                <input type='hidden' name='ManualAutoLand' value='0'>
                <label>Landing Mode Selected</label><input type="checkbox" name="ManualAutoLand" value='1' <?=$checklist->ischecked($result["ManualAutoLand"])?>>
                <hr>
                <label>Landing Time Recorded</label>
                    <div id="timeDate">
                        <input type='datetime-local' name='LandingTimeRecorded' value="<?=$landingTime?>">
                        <button type="button" id="getLandingTime">Get Landing Time</button>
                        <br><br>
                    </div>
                <br><br><br>
                <div class="btnWrapper">
                <button class="btnMain" type="submit">Update</button><br><br>
                <a href="<?=$root."checklist/checklistdetails/?checklistID=".$_GET['checklistID']?>"><button class="btnMain" type="button">Cancel</button></a>
                </div>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>
<script src="js/script.js"></script>