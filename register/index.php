<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
 if(isset($_SESSION['user']))
 {
    header("Location:". $root);
 }
?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=$root?>css/master.css">
        <meta name='viewport' content='width=device-width, initial-scale=0.9, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
            require_once($header);
        ?>
        <main>
            <h4>Register</h4>
            <p>To register enter your details below</p>
            <hr>
            <form action="../php/user/newUser.php" method="POST">
                <input type="text" name="email" placeholder="Email" required>
                <br><br>
                <input type="text" name="name" placeholder="Name" required>
                <br><br>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <br><br>
                <input type="password" name="passwordConfirm" placeholder="Confirm password" id="passwordConfirm" required>
                <br>
                <p id="RegMsg"><?=$errMsg?> </p>
                <br>
                <button type="submit" id="RegSubmit" disabled>Register</button>
            </form>

        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>/js/master.js"></script>
<script src="js/script.js"></script>