<?php
 include_once("/students/15080900/projectapp/php/initalise.php");
 require_once($root."php/user/userClass.php");
 $User = new user();
If($User->userVerify($_POST['email'],$_POST['password']))
{
    header("Location:". $root);
    die();
}
else {
    $errmsg = '<p class="ErrMsg">Invalid login details!</p>';
}
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
            <p>Not a user? <a href="<?=$root?>register/">Register here</a></p>
            <form action="<?=$root?>login/" method="post">
                <input name="email" placeholder="email" required>
                <br><br>
                <input name="password" type="password" placeholder="password" required>
                <?=$errmsg?><br>
                <button type="submit" >Log in</button> 
            </form>
            </section>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>


<!--sepeare login -->
