<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
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
$result = $drone->getFullDetails($_GET['DroneID'],$_SESSION['user']);

if($result->num_rows > 0)
 {  //user owns data
    $data = $result->fetch_assoc();
    print_R($data);
     if($data['UserID'] != $_SESSION['user'])
     {
        
        header("Location:".$root."drone/");
        die();
     }
     $rowHeaders = array_keys($data);
     
 }
 else
 {
     $Nodata = true;
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
            
            <?php
            if($noData)
            {
                echo "<h2 class='msgMain'>no drone found!</h2>";
            }
            else 
            {
              ?>
              <h2><?=$data['DroneName']?></h2>
            <ul>
            <?php 
                for($i = 0;$i < sizeof($data);$i++)
                {
                    echo "<li>".$rowHeaders[$i] .": ".$data[$rowHeaders[$i]] . " ";
                    switch($rowHeaders[$i])
                    {
                        case "MaxOperatingSpeed":
                        case "MaxWind":
                            echo "m/s";
                            break;
                        case "MaxFlightTime":
                            echo "minuites";
                            break;
                        case "MaxHeight":
                        case "MaxRadius":
                            echo "m";
                            break;
                        case "Height":
                        case "Width":
                        case "Length":
                            echo "mm";
                            break;
                        case "Weight":
                        case "MaxTakeOffWeight":
                            echo "g";
                            break;
                        case "TempRangeMax":
                        case "TempRangeMin":
                        case "MinTemp":
                        case "MaxTemp":
                            echo "°C";
                            break;
                        case "MotorSpeed":
                            echo "vh";
                            break;
                        default:
                            break;
                    }
                    echo "</li>\r\n";
                }
            
            } ?>
            </ul>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>