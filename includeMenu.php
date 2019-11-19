<link href="cssFiles/menuCSS.css" rel="stylesheet">   

<div class="user">
        <a class="btn1 btn1-home" href="index.php" style="position: absolute; left: 30;"><img src="images/homeIcon.png"></a> 
        <a href="viewBookings.php" class="btn1-bookings" style="position: absolute; left: 130;"><img src="images/eventIcon.png">&ensp;My Bookings</a>
        <!--        <a href="reset-password.php" class="btn btn-warning" style="position: absolute; right: 120; top: 228;">Reset My Password</a>-->

        <div class="dropdown pull-right" style="cursor:pointer; position: absolute; right: 30;">
        <!--<li class=" style btn btn-home" style="position: absolute; right: 30; display:inline-block; vertical-align:middle;"><a href='#calendar'><img src="images/icon.png" style="bottom:50px;">                <b><?php echo "<em style='font-size:22px;'>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b><i class='fa fa-caret-down'></i></a>-->
            <button class="btn1 btn1-home dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown" style="background-color:seagreen; ">
                <img src="images/icon.png" style="bottom:50px;">&ensp;<b>
                    <?php echo "<span style='font-size:22px;'>" . htmlspecialchars($_SESSION["username"]) . "</span>"; ?>
                </b>&ensp;
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="reset-password.php">Change Password</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
</div>

