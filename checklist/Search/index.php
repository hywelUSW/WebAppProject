<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 $noResult = false;
 if(!isset($_SESSION['user']))
 {
     header("Location:".$root."login/");
     die();
 }
 if(!isset($_GET['q']))
 {
     $noResult = true;
     
 }
 else 
 {
    include_once($root."php/checklist/checklistClass.php");
    $checklist = new checklist();
    $result = $checklist->searchChecklists($_SESSION['user'],$_GET['q']);
    if($result->num_rows < 1)
    {    
        $noResult = true;
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
            <h2>Search - <?=$_GET['q']?> (<?php 
            echo $result->num_rows;
            if($result->num_rows == 1)
                echo " result";
            else {
                echo " results";
            }
            ?>)</h2>
            <form action="search/" method="GET">
                <input type="text" name="q" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </form>
            <br>
           <?php
            if($noResult)
            {
                echo '<h2 class="msg">No Results Found!</h2>';
            }
            else 
            { 
                echo "<section>";
                while($row = $result->fetch_assoc())
                {
                ?>
                <div class="Checklists">           
                    <h4><a href="<?="checklistDetails?checklistID=".$row['ChecklistID']?>"><?=$row['ChecklistName']?></a></h4>
                    <a href="<?=$root."checklist/Download?checklistID=".$row['ChecklistID']?>"><i class="fas fa-download fa-lg"></i></a>
                </div>
                <hr>
                <?php
                }
                echo "</section>";

            } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>