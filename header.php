<header>
    <!--Header bar-->
    <nav>
        <div id="btnMain" class="btnMenu">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        <h1 class="mainHeading">Drone Checklist</h1>
        <div id="btnUser" class="btnMenu">
            <i class="far fa-user fa-2x"></i>
        </div>
    </nav>
        <menu id="mainMenu">
        <ul>
            <li><a href="<?=$root?>">Home</a></li>
            <hr>
            <?php
            if(isset($_SESSION['user']))
            {
                ?>
                <li><a href="<?=$root."checklists/"?>">Checklist</a></li>
                <hr>
                <li><a href="<?=$root."drone/"?>">Drone</a></li>
    
                <?php
            }
            ?>
            <hr>
            <li><a href="<?=$root."about/"?>">About</a></li>
        </ul>
        </menu>
        <menu id="userMenu">
        <ul>
                <li><a href="<?=$root."account/"?>">Account Details</a></li>
                <hr>
                <li><a href="<?=$root."account/logout.php"?>"><i class="fas fa-sign-out-alt fa-lg"></i>Logout</a></li>
        </ul>
       
        </menu>
        <section class="popup">
            <div class="popupDialog">
            <h3>Login</h3>
            <p>Not a user? <a href="<?=$root?>register">Register here</a></p>
            <form action="<?=$root?>login/" method="post">
                <input name="email" placeholder="email" required>
                <br><br>
                <input name="password" type="password" placeholder="password" required>
                <br><br>
                <button type="submit" class="btnMain">Log in</button> 
            </form>
            </div>
        </section>
</header>