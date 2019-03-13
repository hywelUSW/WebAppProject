<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
 if(isset($_SESSION['user']))
 {
    header("Location:". $root);
    die();
 }
 include_once($root."user/userClass.php");
 $user = new user();
 //Verify values
 if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']))
 {
     if(!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password']))
     {
         if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
         {
            if($user->newUser($_POST['email'],$_POST['name'],$_POST['password']))
            {
                $hasRegistered = true;
                
            }
            else
            {
                $errMsg = "<p>Email already in use!<p>";
            }
        }
        else {
            $errMsg = "<p>Invalid Email!</p>";
        }

     }
     else {
         $errMsg = "<p>Please complete the form!</p>";
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
            require_once($header);
        ?>
        <main>
            <h2>Register</h2>
            <?php
            if($hasRegistered)
            {
                echo "<h4 class='Msg'>Thank you for registering, <a href='".$root."'>Click here</a> to return home</h4>";
            }
            else
            {
            ?>
            <p>To register enter your details below</p>
            <hr>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="Email" maxlength="40" required>
                <br><br>
                <input type="text" name="name" placeholder="Name" maxlength="40" required>
                <br><br>
                <input type="password" name="password" placeholder="Password" id="password" maxlength="40" required>
                <br><br>
                <input type="password" name="passwordConfirm" placeholder="Confirm password" id="passwordConfirm" maxlength="40" required>
                <br>
                <p id="RegMsg"><?=$errMsg?> </p>
                <br>
                <button type="submit" id="RegSubmit" class="btnMain">Register</button>
            </form>
            <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>/js/master.js"></script>
<script src="js/script.js"></script>