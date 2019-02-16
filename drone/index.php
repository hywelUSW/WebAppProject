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
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
        //get header file
            require_once($header);  
        ?>
        <main>
            <h3>Drone List</h3>
            <a href="<?=$root?>drone/newDrone">Add new drone</a>
            <section id="droneList">
            <?php
                require_once($root."php/drone/droneClass.php");
                $drone = new drone();
                $result = $drone->getDroneList($_SESSION['user']);
                
                if($result)
                {
                    foreach($result as $row)
                    {
                        //print row results here
                        echo "no";
                    }
                }
                else
                {
                    ?>
                    <h4 id="msg" align="center">No drones added!</h4>
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