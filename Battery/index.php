<?php

 include_once("/students/15080900/projectapp/php/initalise.php");
 require_once($root."php/battery/batteryClass.php");
 
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
            <h2>Batteries</h2>
            <div class="btnWrapper">
                <a href="newBattery/"><button class="btnMain">New Battery</button></a>
            </div>
            <section>
                <?php
                   
                    $battery = new battery();
                    $result = $battery->getBatteryList($_SESSION['user']);
                    
                    if($result->num_rows < 1)
                    {
                        echo "<p class='msg'>No Batteries added!</p>";

                    }else {
                        while($row = $result->fetch_assoc())
                        {
                            ?>
                            <h4><a href="<?="BatteryDetails?batteryID=".$row['batteryID']?>"><?=$row['Name']?></a></h4>
                            <hr>
                            <?php
                        }
                    }
                ?>
            </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>