<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 require_once("php/getFormDetails.php");
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
            <h3></h3>
            
            <form method="post" action="">
                <input type='text' name='WeatherCheck' placeholder='Weather Check'>
                <br><br>
                <label>Operations Manual</label><input type='checkbox' name='OpsManual'>
                <br><br>
                <label>Maps</label><input type='checkbox' name='Maps'>
                <br><br>
                <label>Task Information</label><input type='checkbox' name='TaskInfo'>
                <br><br>
                <label>Safety Equipment</label><input type='checkbox' name='SafetyEquiment'>
                <br><br>
                <label>LiPo Bag</label><input type='checkbox' name='LiPoBag'>
                <br><br>
                <label>Controller</label><input type='checkbox' name='Controller'>
                <br><br>
                <label>Equipment Charged</label><input type='checkbox' name='EquipmentCharged'>
                <br><br>
                <label>Camera</label><input type='checkbox' name='Camera'>
                <br><br>
                <label>RPA Platform</label><input type='checkbox' name='RPAPlatform'>
                <br><br>
                <label>Drone Propellers</label><input type='checkbox' name='Propellers'>
                <br><br>
                <label>Carrying Case</label><input type='checkbox' name='CarryingCase'>
                <br><br>
                <label>Area Permission Granted</label><input type='checkbox' name='PermissionGranted'>
                <br><br>
                <button type="submit">Update Loading List</button>
                <a href="<?=$root."checklist/checklistdetails?checklistID=".$_GET['checklistID']?>"><button>Cancel</button></a>
            </form>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>