<header>
    <section>
        <div id="btnMain" class="btnMenu">
        <i class="fas fa-bars fa-2x"></i>
        </div>
        <h3 class="mainHeading">Drone Checklist</h3>
        <?php
        //check that user is logged in
        if(isset($_SESSION['user']))
        {
        ?>
            <div id="btnUser" class="btnMenu">
            <i class="far fa-user fa-2x"></i>
            </div>
        <?php
        }
        ?>
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
        <?php
        if(isset($_SESSION['user']))
        {
        ?>
            <menu id="userMenu">
            <a>Hello</a>
            </menu>
        <?php
        }
        ?>
</header>