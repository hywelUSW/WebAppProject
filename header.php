<header>
    <!--Header bar-->
    <section>
        <div id="btnMain" class="btnMenu">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        <h3 class="mainHeading">Drone Checklist</h3>
        
       
        <div id="btnUser" class="btnMenu">
            <i class="far fa-user fa-2x"></i>
        </div>
        
    </section>
        <menu id="mainMenu">
        <ul>
        <li><a href="<?=$root?>">Home</a></li>
            <?php
            if(isset($_SESSION['user']))
            {
                ?>
                <li><a href="<?=$root."checklist/"?>">Checklist</a></li>
                <li><a href="<?=$root."drone/"?>">Drone</a></li>
    
                <?php
            }
            ?>
            <li><a href="<?=$root."about/"?>">About</a></li>
        </ul>
        </menu>
        <menu id="userMenu">
        <div>
            <p>Welcome, <?php 
            require($root."php/user/getUsername.php");
                ?>
             </p>
        </div>
        <hr>
        <?php
        if(isset($_SESSION['user']))
        {
        ?>
                <ul>
                <li><a href="<?=$root."account/"?>">Account details</a></li>
                <li><a href="<?=$root."account/logout.php"?>">Logout</a></li>
                </ul>
        <?php
        }
        else 
        {?>
            <ul>
            <li><a href="<?=$root."account/logout.php"?>">Logout</a></li>
            </ul>
               
            
        <?php
        }
        ?>
        </menu>
</header>