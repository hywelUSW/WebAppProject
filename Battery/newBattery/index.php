<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 if(array_filter($_POST) && isset($_SESSION['user']))
 {
     require_once($root."php/battery/batteryclass.php");
     foreach($_POST as $val)
     {
         if(empty($val))
         {
             $noVal = true;
         }
     }
     if(!$noVal)
     {
        $battery = new battery();
        if($battery->newBattery($_SESSION['user'],$_POST['Name'],$_POST['ModelNo'],$_POST['SerialNo'],$_POST['Weight'],$_POST['Chemistey'],$_POST['powerOutput']))
        {
            $querysuccess = true;
        }
        else 
        {
            $errMsg = "There was an error adding the battery";
        }
    }
    else{
        $errMsg = "please complete the form!";
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
            <h2>New Battery</h2>
            <?php
            if($querysuccess)
            {
                echo "<h3 class='msg'>Battery created! <a href='$root/battery/'>Click here</a> to go to the Battery</h3>";   

            }
            else {
            ?>    
            
            <form method="POST">
                <input type="text" name="Name"  maxLength="40" placeholder="name" required>
                <br><br>
                <input type="text" name="ModelNo"  maxLength="20" placeholder="name" required>
                <br><br>
                <input type="text" name="SerialNo"  maxLength="20" placeholder="name" required>
                <br><br>
                <input type="number" name="Weight" placeholder="Weight(g)" required>
                <br><br>
                <input type="text" name="Chemistry"  maxLength="20" placeholder="Chemistry" required>
                <br><br>
                <input type="number" name="powerOutput" placeholder="Power output(mAh)" required>
                <p><?=$errMsg?></p>
                <button class="btnMain">Add Battery</button>
            </form>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>