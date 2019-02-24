<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 { //check if user is logged in
     header("Location:".$root."login/");
     die();
 }
 //echck that drone is set
 if($_GET['checklistID'] == null)
 {
    header("Location:".$root."checklist/");
     die();
 }
 
 require_once($root."php/checklist/getChecklistOverview.php");

?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);
        ?>
        <main>
            
            <section>
                <?php
                    if($Nodata)
                    {
                        ?>
                        <h2>Drone Details</h2>
                        <h3 id="message">Checklist does not exist!</h3>
                        <?php
                    }else{
                        ?>
                        <summary>
                            <h3><?=$result['ChecklistName']?></h3>
                        </summary>
                        <div id="overview">
                        <ul>
                            <li>Planned Date: <?=$result['PlannedDate']?></li>
                            <li>Description: <?=$result['Descr']?></li>
                        </ul>
                        </div>
                        <div class="btnWrapper">
                            <a href="<?=$root."checklist/updatechecklist/loadinglist?checklistID=".$_GET['checklistID']?>"> <button class="btnMain">Loading List</button></a>
                            <br><br>
                            <a href="<?=$root."checklist/updatechecklist/PreFlight?checklistID=".$_GET['checklistID']?>"> <button class="btnMain">Pre-Flight</button></a>
                            <br><br>
                            <a href="<?=$root."checklist/updatechecklist/PostTakeOff?checklistID=".$_GET['checklistID']?>"> <button class="btnMain">Post-Take Off</button></a>
                            <br><br>
                            <a href="<?=$root."checklist/updatechecklist/PreLanding?checklistID=".$_GET['checklistID']?>"> <button class="btnMain">Pre-Landing</button></a>
                            <br><br>
                            <a href="<?=$root."checklist/updatechecklist/PostLanding?checklistID=".$_GET['checklistID']?>"> <button class="btnMain">Post-Landing</button></a>
                            <hr>
                            <a href=""> <button class="btnMain">Download(PDF)</button></a>
                        </div>
                        <?php
                    }
                ?>
            </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>