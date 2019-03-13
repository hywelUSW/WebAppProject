<?php
require_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
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
            <h2>Drone List</h2>
            <div class="btnWrapper">
                <a href="<?=$root?>drone/newDrone">
                    <button class="btnMain">Add new drone</button>
                </a>
            </div>
            <section id="droneList">
            <?php
                require_once($root."php/drone/droneClass.php");
                $drone = new drone();
                $result = $drone->getDroneList($_SESSION['user']);
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {?>
                        <div class="droneList">
                            <h4><a href="<?="droneDetails?DroneID=".$row['DroneID']?>"><?=$row['DroneName']?></a></h4>
                        </div>
                        <hr>
            <?php   }   
                }
                else
                {
                    ?>
                    <h3 class="msg" style="text-align:center;">No drones added!</h3>
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