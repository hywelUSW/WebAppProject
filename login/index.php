<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
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
            <h3>Login</h3>
            <section>
            <p>Not a user? <a href="<?=$root."login/"?>">Register here</a></p>
            <form action="../php/user/login.php" method="post">
                <input name="email" type="email" required>
                <br><br>
                <input name="password" type="password" required>
                <br><br>
                <input type="submit"> 
            </form>
            </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>


<!--sepeare login -->
