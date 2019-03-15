<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
if(!isset($_GET['checklistID']))
{
    header("Location: ".$root."checklist/");
}
require_once($root."php/drone/droneClass.php");
$drone = new drone();
$rDrone = $drone->getDroneList($_SESSION['user']);
if($rDrone->num_rows > 0)
{
    while($dDrone = $rDrone->fetch_assoc())
    {
      $droneList[] = [$dDrone['DroneID'],$dDrone['DroneName']];
        if($_POST['drone'] == $dDrone['DroneID'])
        {   //check that user owns the drone
            $UserOwnsDrone = true;
        }
       
    }
}
else 
{
    $noDrone = true;
}



//get Checklist Data
require_once($root."php/checklist/checklistClass.php");
$checklist = new checklist();
$rChecklist = $checklist->getChecklistOverview($_GET['checklistID']);

if($rChecklist->num_rows > 0)
{
    $checklistData = $rChecklist->fetch_assoc();
    if($checklistData['UserID'] != $_SESSION['user'])
    {
        header("Location:".$root."checklist/");
        die();
    }
}
else {
    header("Location:".$root."checklist/");
    die();
}
//deal with form submition
if(array_filter($_POST) && isset($_SESSION['user']))
{
    if(!$noData)
    {
        foreach($_POST as $val)
        {
            if(empty($val))
            {
                $noVal = true;
            }
        }
        if(!$noVal)
        {
            if($checklist->updateChecklist($_POST['DroneID'],$_POST['ChecklistName'],$_POST['PlannedDate'],$_POST['Descr'],$_GET['checklistID']))
            {
                
                $msg = "Checklist updated!";
            }
            else 
            {
                $msg = "Could not update checklist!";    
            }
        }
        else{
            $msg = "please complete the form!";
        }
        $checklistData = $_POST;
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
            <h2>Update Checklist</h2>
            <?php
            if($noData)
            {
                $msg = "Please enter all details";
            }
            else 
            { ?>
                <form action="" method="post">
                    <p><?=$msg?></p>
                    <input type="text" name="ChecklistName" placeholder="Checklist Name"  maxLength="40" value="<?=$checklistData['ChecklistName']?>" required>
                    <br><br>
                    <label>Drone ID </label><select name="DroneID" value="3" style="font-size:20px">
                
                    <?php
                        foreach($droneList as $optDrone)
                        {
                            if($optDrone[0] == $checklistData['DroneID'])
                            {
                                $selected = "selected";
                            }
                           echo "<option value='".$optDrone[0]."' ".$selected.">".$optDrone[1]."</option>";
                           $selected = null;
                        }
                        
                    ?>
                    </select>
                    <br><br>
                    <input type="date" name="PlannedDate" placeholder="Flight Date" value="<?=$checklistData['PlannedDate']?>" required>
                    <br><br>
                    <textarea name="Descr" placeholder="Description.." rows="5" cols="50"  maxLength="300" required><?=$checklistData['Descr']?></textarea>
                    <br><br>
                    <button class="btnMain" type="submit">Update Checklist</button>
                    </form>
                    <hr>
                    <section>
                        <h3>Delete Checklist</h3>
                        <p>To delete a checklist, please use the form below. Warning: This is irreversable!</p>
                        <form action="deleteChecklist.php" method="POST">
                            <input type="password" name="password" placeholder="Password">
                            <input type="hidden" name="checklistID" value="<?=$_GET['checklistID']?>">
                            <br><br>
                            <button class="btnMain">Delete Checklist</button>
                        </form>
                    </section>

            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>