<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
 if(isset($_POST['email']) && isset($_POST['message']))
 {
    if(mail($webMasterEmail,"My subject",$_POST['message']))
    {
        "<p>Message Sent Successfully</p>";
    }
    else {
        $msg = "<p>Failed to send message(Due to server restrictions)</p>";
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
        <section>
            <h3>About</h3>
            <p>
            This app is used to help proffesional drone users manage their drone data. from this website. you can
            <ul>
                <li>Create checklists</li>
                <li>Manage drones</li>
                <li>Keep track of batteries</li>
            </ul>
            
            
            </p>
        </section>
        <hr>
        <section id="contact">
            <h2>Contact us</h2>
            <p>If you need to contact us, use the form below</p>
            <?=$msg?>
            <form method="POST">
                <input type="email" name="email" placeholder="Email address">
                <br><br>
                <textarea name="message" cols="40" rows="5" placeholder="message..."></textarea>
                <br><br>
                <button class="btnMain" type="submit">Send</button>
            </form>
        </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>