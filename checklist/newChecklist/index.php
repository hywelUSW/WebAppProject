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
else
{
    while($row = $result->fetch_assoc())
    {
        
        $droneList[] = [$row['DroneID'],$row['DroneName']];
        if($_POST['drone'] == $row['DroneID'])
        {   //check that user owns the drone
            $UserOwnsDrone = true;
        }
    }
}
   //form submitted
    if(array_filter($_POST) && isset($_SESSION['user']))
    {
        foreach($_POST as $val)
        {
            if(empty($val))
            {
                $noVal = true;
            }
        }
        if(!noVal)
        {
        //check date
            if($_POST['date'] >= date("Y-m-d"))
            {
                if($_POST['drone'] != 0 && $UserOwnsDrone)
                {
                    require_once($root."php/checklist/checklistClass.php");
                    $checklist = new checklist();
                    $result = $checklist->newChecklist($_SESSION['user'],$_POST['drone'],$_POST['name'],$_POST['date'],$_POST['Descr']);
                }
                else {//Drone isnt owned by user
                    $errMsg = "invalid drone selected!";
                }
            }
            else {//making checklist after date
            $errMsg = "Please check the selected date!";
            }
        }
        else {
            $errMsg = "Please complete the form";
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
        if(is_int($result))
        {
         echo "<h3 class='msg'>Checklist created! <a href='$root/checklist/checklistDetails/?checklistID=$result'>Click here</a> to go to checklist</h3>";   
            
        }
        else
        {?>
            <h2>Create New Checklist</h2>
            <section>
                <?php
                if($noDrones)
                {
                    echo "<h3 class='msg'>You need to add a drone before creating a checklist! <a href='$root/drone/newdrone/'>Click here</a> to add a drone!</h3>";
                }
                else
                {
                ?>
                <form method="post" action="">
                    <input type="text" name="name" maxLength="40" placeholder="Checklist Name" value="<?=$_POST['name']?>" required>
                    <br><br>
                    <label>Drone </label><select name="drone" style="font-size:20px">
                
                    <?php
                        foreach($droneList as $optDrone)
                        {
                            
                           echo "<option value='".$optDrone[0]."'>".$optDrone[1]."</option>";
                        }
                        
                    ?>
                    </select>
                    <br><br>
                    <label>Planned Flight Date </label><input type="date" name="date" placeholder="Flight Date" value="<?=$_POST['date']?>" required>
                    <br><br>
                    <textarea name="Descr" placeholder="Description.."  maxLength="300" rows="5" cols="50" value="<?=$_POST['Descr']?>" required></textarea>
                    <p><?=$errMsg?></p>
                    <button class="btnMain" type="submit">Add Checklist</button>
                </form>
                <?php
                }
                ?>
            </section>
            <?php
        }
        ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>