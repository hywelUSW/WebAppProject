<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 
 if(!isset($_SESSION['user']))
 { //check if user is logged in
     header("Location:".$root."login/");
     die();
 }
 //check that drone is set
 if($_GET['DroneID'] == null)
 {
    header("Location:".$root."drone/");
     die();
 }
 
 require_once($root."php/drone/droneClass.php");
 $drone = new drone();
 $result = $drone->getDroneOverview($_GET['DroneID']);

 if($result)
 {  //user owns data
     if($result['userID'] != $_SESSION['user'])
     {
        header("Location:".$root."drone/");
        die();
     }
     
 }else
 {
     $Nodata = true;
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
                        <h3 id="message">Drone does not exist!</h3>
                        <?php
                    }else{
                        ?>
                        <summary>
                            <h2><?=$result['DroneName']?></h2>
                            
                        </summary>  
                        <hr>
                        <div id="basicDetails">
                            <h4>Basic Specifications</h4>
                            <a href="updateDetails/?DroneID=<?=$_GET['DroneID']?>"><button>Edit details</button></a>
                            <ul>
                                <li>Model Name: <?=$result['ModelName']?></li>
                                <li>Manufacturer: <?=$result['Manufacturer']?></li>
                                <li>Max Flight Time: <?=$result['MaxFlightTime']?> minutes</li>
                                <li>Max Operating Speed: <?=$result['maxoperatingspeed']?> m/s</li>
                            </ul>
                            <a href="fullSpec?DroneID=<?=$_GET['DroneID']?>">View full spec</a>
                        </div>              
                        <hr>
                        <div id="flightList">
                            <h4>Flights</h4>
                                <?php
                                echo'<div id="Checklists">';
                                include_once($root."php/checklist/getDroneChecklists.php");
                                echo  '</div>';
                            ?>
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