<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 if(!isset($_GET['batteryID']))
 {
     header("location:".$root."Battery/");
     die();
 }
 require_once($root."php/battery/batteryclass.php");
 $battery = new battery();
 $result = $battery->getBatteryDetails($_GET['batteryID']);
 if($result->num_rows > 0)
 {
    $data = $result->fetch_assoc();
    if($data['UserID'] == $_SESSION['user'])
    {
        if(isset($_POST['addCharge']))
        {
            $battery->addCharge($_GET['batteryID'],$_SESSION['user']);
        }
        $dataAvailable = true;
    }
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
            <?php
            if(!$dataAvailable)
            {
                echo "<h3 class='msg'>Battery not available</h3>";   
            }else {
                # code...
            ?>
            <h2><?=$data['Name']?></h2>
            <section>
            <ul>
                <li>Model No: <?=$data['ModelNo']?></li>
                <li>Serial No: <?=$data['SerialNo']?></li>
                <li>Weight: <?=$data['Weight']?> g</li>
                <li>Chemistry: <?=$data['Chemistry']?></li>
                <li>Power output: <?=$data['PowerOutput']?> mAh</li>
            </ul>
            </section>
            <section>
            <h3>Charge Cycles</h3>
            <form method="POST">
            <div class="btnWrapper">
            <input type="hidden" name="addCharge" value="1">
                <button class="btnMain">Add charge</button>
            </div>
            </form>
            <br><br>
            <?php
               $result =  $battery->getBatteryCharges($_GET['batteryID']);
               if($result)
               {
                   ?>
                   <br>
                   <table>
                    <tr>
                    <th>Charge No.</th>
                    <th>Date</th>
                    <tr>
                    <?php
                    while($row = $result->fetch_assoc())
                    {
                           echo "<tr>";
                           echo "<td>".$row['ChargeNo']."</td>";
                           echo "<td>".$row['chargeDate']."</td>";
                           echo"</tr>\r\n";
                    }
                    echo "</table>";

                }
            ?>
            
            </section>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>