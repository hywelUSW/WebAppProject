<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 $noDrones = false;
//check user is logged in
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
    //get list of drones owned by the user
    require_once($root."php/drone/droneClass.php");
   $drone = new drone();
   $result = $drone->getDroneList($_SESSION['user']);
   if(!$result)
   {
     $noDrones = true; 
   }
   print_r($result);
   //form submitted
    if(array_filter($_POST) && isset($_SESSION['user']))
    {
        //check paramaters are good
        if($_POST['date'] >= date("Y-m-d") && $_GET['drone'] != 0)
        {
            require_once($root."php/checklist/checklistClass.php");
            $checklist = new checklist();
            $checklist->newChecklist($_SESSION['user'],$_POST['drone'],$_POST['date'],$_POST['descr']);
        }
        else
        {
            //making checklist after date
            
        }
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
            <h3>Create New Checklist</h3>
            <section>
                <?php
                if($noDrones)
                {
                    echo "<h3 id='msgMain'>You need to add a drone before creating a checklist! <a href=''>Click here</a> to add a drone!</h3>";
                }
                else
                {
                ?>
                <form method="post" action="">
                    <input type="text" name="name" placeholder="Checklist Name" required>
                    <br><br>
                    <select name="drone">
                        <option value="0">
                    <?php
                        while($row = $result->fetch_assoc())
                        {
                           echo "<option value='".$row['DroneID']."'>".$row['DroneName']."</option>";
                        }
                        
                    ?>
                    </select>
                    <input type="date" name="date" placeholder="Flight Date" required>
                    <br><br>
                    <textarea name="Descr" placeholder="Description.." rows="5" cols="50" required></textarea>
                    <br><br>
                    <button type="submit">Add Checklist</button>
                </form>
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