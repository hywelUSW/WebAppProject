<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
 //redirect to home page
if(!isset($_SESSION['user']))
{
    header("Location:". $root);
    die();
}
require_once($root."php/user/updateDetails.php");
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
            <h3>Account details</h3>
            <p> </p>
            <hr>
            <section>
            <form action="" method="POST">
                    <input type="text" name="email" placeholder="Email" value="<?=$userDetails['email']?>" required>
                    <br><br>
                    <input type="text" name="name" placeholder="Name" value="<?=$userDetails['name']?>" required>
                    <br><br>
                    <input type="password" name="NewPassword" placeholder="New password">
                    <br><br>
                    <input type="password" name="password" placeholder="Current Password (required)" required>
                    <br><?=$Msg?><br>
                    <button type="submit">Update Details</button>
            </form>
            </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>