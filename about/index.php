<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
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
            require_once($header);
        ?>
        <main>
        <section>
            <h3>About</h3>
            <p>This app is used to help proffesional drone users send</p>
        </section>
        <hr>
        <section id="contact">
            <h2>Contact us</h2>
            <p>If you need to contact us, use the form below</p>
            <form method="POST">
                <input type="email" name="email" placeholder="Email address">
                <br><br>
                <textarea name="message" cols="40" rows="5" placeholder="message..."></textarea>
                <br>
                <button type="submit">Send</button>
            </form>
        </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>