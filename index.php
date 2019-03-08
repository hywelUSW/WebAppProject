<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
?>
<html>
    <head>
        <title>App project</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/master.css">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        
    </head>
    <body>
        <?php
            require_once($header);
        ?>
        <main>
        <h2>Home</h2>
        <summary>
            This web application is designed to help professional drone pilots create and maintain checklists.
            As well as this, you can also store drone data and keep track of battery usage.
        </summary>
        <section>
        <?php
        if(isset($_SESSION['user']))
        { ?>
            
        <?php }
        else {
            ?><p>to create checklists, please create an account <a href="register/">Here</a></p><?php
        }?>
        </section>
        </main>
    </body>
    <footer>

    </footer>
</html>

<script src="js/master.js"></script>