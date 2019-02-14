<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
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
            require_once($root."header.php");
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
                <input type="password" name="password" placeholder="Password" required>
                <br><br>
                <input type="password" name="passwordConfirm" placeholder="Confirm password" required>
                <br><br>
                <button type="submit">Register</button>
            </form>

        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="../js/master.js"></script>