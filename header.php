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
                <li><a href="<?=$root?>"><i class="fas fa-home"></i>&nbsp;Home</a></li>
                <hr>
                <?php
                if(isset($_SESSION['user']))
                {
                    ?>
                    <li><a href="<?=$root."checklists/"?>"><i class="fas fa-tasks"></i>&nbsp;Checklist</a></li>
                    <hr>
                    <li><a href="<?=$root."drone/"?>"><i class="fas fa-helicopter"></i>&nbsp;Drone</a></li>
                    <hr>
                    <?php
                }
                ?>
                
                <li><a href="<?=$root."about/"?>"><i class="fas fa-info-circle"></i>&nbsp;About</a></li>
            </ul>
        </menu>
        <menu id="userMenu">
        <div id="userInfo">
                <?php 
                    if($userDetailsAvailable)
                    {
                        ?>
                        <i class="far fa-user-circle fa-3x"></i>
                        <p>Welcome, <?=$userDetails['Name']?></p>
                        <p><?=$userDetails['Email']?></p>
                        <?php
                    }
                    else {
                        echo "<p>Welcome, Guest<p>";
                    }
                    ?>
                
        <hr>
        </div>
            <?php
            if(isset($_SESSION['user']))
            {
            ?>
                    <ul>
                    <li><a href="<?=$root."account/"?>"><i class="fas fa-cogs"></i>&nbsp;Account details</a></li>
                    <hr>
                    <li><a href="<?=$root."account/logout.php"?>"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                    </ul>
            <?php
            }
            else 
            {?>
                <ul>
                <li><a href="#" class="loginLink" id="loginLink"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a></li>
                <hr>
                <li><a href="<?=$root."register/"?>" class="loginLink"><i class="fas fa-user-plus"></i>&nbsp;register</a></li>
                </ul>
                
                
            <?php
            }
            ?>
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