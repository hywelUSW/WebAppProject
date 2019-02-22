<?php
 require_once("/students/15080900/projectapp/php/initalise.php");
 //redirect to home page
if(!isset($_SESSION['user']))
{
    header("Location:". $root);
    die();
}
//update details
if(isset($_POST['password']))
{
require_once("php/updateDetails.php");
}
//delete account
if(isset($_POST['passwordDelete']))
{
require_once("php/deleteUser.php");
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
        <?php
        if($userDeleted)
        {
            echo "<h3 class='Msg'>Account has been deleted!</h3>";
        }
        else
        {?>
            <h3>Account details</h3>
            <ul>
                <li>Name: <?=$userDetails['Name']?></li>
                <li>Email: <?=$userDetails['Email']?></li>
            </ul>
            <hr>
            <section>
            <h4>Update Details</h4>
            <p>Enter new details here to update them</p>
            <form action="" method="POST">
                    <input type="text" name="email" placeholder="Email" value="<?=$userDetails['Email']?>" required>
                    <br><br>
                    <input type="text" name="name" placeholder="Name" value="<?=$userDetails['Name']?>" required>
                    <br><br>
                    <input type="password" name="NewPassword" placeholder="New password">
                    <br><br>
                    <input type="password" name="password" placeholder="Current Password (required)" required>
                    <p id="ErrMsg"><?=$Msg?>&nbsp;</p>
                    <button type="submit">Update Details</button>
            </form>
            </section>
            <hr>
            <section>
                <h4>Delete Account</h4>
                <p>Use this to delete your account and any data. This is Irreversable!</p>
                <form action="" method="POST">
                    <input type="hidden" name="email" value="<?=$userDetails['Email']?>">
                    <input type="password" name="passwordDelete" placeholder="Password" required>
                    <br><br>
                    <button type="submit">Delete account</button>
                </form>
            </section>
        <?php } ?>
        </main>
    </body>
    <footer>

    </footer>
</html>
<script src="<?=$root?>js/master.js"></script>